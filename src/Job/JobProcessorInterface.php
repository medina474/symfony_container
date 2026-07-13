<?php

namespace App\Job;

use App\Entity\Job;

interface JobProcessorInterface
{
    public function __invoke(Job $job): void;
}
