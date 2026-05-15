<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SuperAdmin = 'Super Admin';
    case Admin = 'Admin';
    case User = 'User';
}
