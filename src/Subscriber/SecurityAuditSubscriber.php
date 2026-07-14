<?php declare(strict_types=1);

namespace App\Subscriber;

use App\Service\AuditLogger;
use App\Enum\AuditAction;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\Security\Http\Event\LogoutEvent;

final class SecurityAuditSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private AuditLogger $auditLogger
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccess',
            LoginFailureEvent::class => 'onLoginFailure',
            LogoutEvent::class => 'onLogout',
        ];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $user = $event->getUser();

        $this->auditLogger->log(
            AuditAction::LOGIN_SUCCESS,
            'User logged in successfully',
            [
                'firewall' => $event->getFirewallName(),
            ],
            entity: $user,
            user: $user
        );
    }

    public function onLoginFailure(LoginFailureEvent $event): void
    {
        $this->auditLogger->log(
            AuditAction::LOGIN_FAILURE,
            'Login failed',
            [
                'error' => $event->getException()->getMessage(),
                'firewall' => $event->getFirewallName(),
            ]
        );
    }

    public function onLogout(LogoutEvent $event): void
    {
        $token = $event->getToken();

        $this->auditLogger->log(
            AuditAction::LOGOUT,
            'User logged out',
            user: $token?->getUser()
        );
    }
}
