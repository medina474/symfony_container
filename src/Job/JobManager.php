<?php

namespace App\Job;

use App\Entity\Job;
use App\Message\JobMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class JobManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MessageBusInterface $messageBus,
    ) {
    }

    public function dispatch(JobProcessorInterface $request, array $payload): Job
    {
        $job = new Job(
            action: $request::class,
        );

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        $this->messageBus->dispatch(
            new JobMessage($job->getId()->toString(), $payload)
        );
    
        return $job;
    }
}
