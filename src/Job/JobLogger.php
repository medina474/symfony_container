<?php
namespace App\Job;

use App\Entity\Job;

final class JobLogger implements JobProcessorInterface
{
    public static function supports(): string
    {
        return JobLogger::class;
    }

    public function execute(Job $job): void
    {

    }
}
