<?php

namespace App\Job;

use App\Entity\Job;

interface JobProcessorInterface
{
    public static function supports(): string;

    public function execute(Job $job): void;
}
