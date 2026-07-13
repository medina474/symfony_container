<?php

namespace App\MessageHandler;

use App\Job\JobExecutorRegistry;
use App\Message\JobMessage;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Psr\Container\ContainerInterface;
use App\Job\JobProcessorInterface;

#[AsMessageHandler]
class JobMessageHandler
{
    public function __construct(
        private JobRepository $repository,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
        #[AutowireLocator('app.job_processor', indexAttribute: 'key')]
        private ContainerInterface $processors,
    ) {
    }

    public function __invoke(JobMessage $message): void
    {
        $job = $this->repository->find($message->getId());

        if ($job === null) {
            $this->logger->warning('Job introuvable, message ignoré.', [
                'jobId' => $message->getId(),
            ]);

            return; // on acquitte le message : pas de retry, rien à traiter
        }
        
        $job->markProcessing();
        $this->em->flush();

        try {
            /** @var JobProcessorInterface $processor */
            $processor = $this->processors->get($job->getAction());
            $processor($job);
            $job->markDone($message->getPayload());
        } catch (\Throwable $e) {
            $job->markFailed($e->getMessage());
            throw $e;  // rethrow pour le mécanisme de retry de Messenger
        } finally {
            $this->em->flush();
        }
    }
}
