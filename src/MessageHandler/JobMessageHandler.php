<?php

namespace App\MessageHandler;

use App\Message\JobMessage;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class JobMessageHandler
{
    public function __construct(
        private JobRepository $repository,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(JobMessage $message): void
    {
        $job = $this->repository->find($message->getId());
        $job->markProcessing();
        $this->em->flush();

        try {
            $this->logger->error("test", $message->getPayload());
            $job->markDone($message->getPayload());
        } catch (\Throwable $e) {
            $job->markFailed($e->getMessage());
            throw $e;  // rethrow pour le mécanisme de retry de Messenger
        } finally {
            $this->em->flush();
        }
    }
}
