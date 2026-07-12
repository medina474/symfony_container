<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;
use Symfony\Component\Uid\Uuid;

#[AsMessage('async')]
class JobMessage
{
    public function __construct(
        private string $id,
        private string $payload,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }
}
