<?php declare(strict_types=1);

namespace Toolbox\Audit\Entity;

use Toolbox\Audit\Enum\AuditAction;
use Toolbox\Audit\Repository\AuditRepository;
use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditRepository::class)]
class Audit
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(enumType: AuditAction::class)]
    private AuditAction $action = AuditAction::AUDIT;

    #[ORM\ManyToOne()]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?string $entity = null;

    #[ORM\Column(nullable: true)]
    private ?int $entityId = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $userAgent = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ipAddress = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: 'json')]
    private array $data = [];

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getAction(): AuditAction
    {
        return $this->action;
    }

    public function setAction(AuditAction $action): static
    {
        $this->action = $action;
        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): static
    {
        $this->entity = $entity;
        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): static
    {
        $this->entityId = $entityId;
        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): static
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
