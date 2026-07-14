<?php declare(strict_types=1);

namespace Toolbox\Audit\Service;

use Toolbox\Audit\Entity\Audit;
use Toolbox\Audit\Enum\AuditAction;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;

final class AuditLogger
{
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
        private RequestStack $requestStack
    ) {}

    public function log(
        AuditAction $type,
        string $message,
        array $data = [],
        ?object $entity = null,
        ?User $user = null
    ): void {
        $audit = new Audit();
        $audit->setAction($type);
        $audit->setMessage($message);
        $audit->setData($data);

        $audit->setUser($user ?? $this->security->getUser());

        $request = $this->requestStack->getCurrentRequest();
        if ($request) {
            $audit->setIpAddress($request->getClientIp());
            $audit->setUserAgent($request->headers->get('User-Agent'));
        }

        if ($entity !== null) {
            $audit->setEntity($entity::class);
            $audit->setEntityId(method_exists($entity, 'getId') ? $entity->getId() : null);
        }

        $this->em->persist($audit);
        $this->em->flush();
    }
}
