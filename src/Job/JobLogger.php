<?php

namespace App\Job;

use App\Entity\Job;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AutoconfigureTag('app.job_processor')]
#[AsTaggedItem(index: self::class)]
final class JobLogger implements JobProcessorInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(Job $job): void
    {
       $this->logger->error("test", $job->getPayload());
    }
}
