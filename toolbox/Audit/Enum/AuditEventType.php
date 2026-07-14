<?php declare(strict_types=1);

namespace Toolbox\Audit\Enum;

enum AuditAction: string
{
    case AUDIT = 'audit';
    case LOGIN_SUCCESS = 'login success';
    case LOGIN_FAILURE = 'login failure';
    case LOGOUT = 'logout';
}
