<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case USERS_VIEW = 'users.view';
    case USERS_CREATE = 'users.create';
    case USERS_UPDATE = 'users.update';
    case USERS_DELETE = 'users.delete';

    case ROLES_VIEW = 'roles.view';
    case ROLES_CREATE = 'roles.create';
    case ROLES_UPDATE = 'roles.update';
    case ROLES_DELETE = 'roles.delete';

    case PERMISSIONS_VIEW = 'permissions.view';
    case PERMISSIONS_CREATE = 'permissions.create';
    case PERMISSIONS_UPDATE = 'permissions.update';
    case PERMISSIONS_DELETE = 'permissions.delete';

    case CATEGORIES_VIEW = 'categories.view';
    case CATEGORIES_CREATE = 'categories.create';
    case CATEGORIES_UPDATE = 'categories.update';
    case CATEGORIES_DELETE = 'categories.delete';

    case PRODUCTS_VIEW = 'products.view';
    case PRODUCTS_CREATE = 'products.create';
    case PRODUCTS_UPDATE = 'products.update';
    case PRODUCTS_DELETE = 'products.delete';

    case BRANDS_VIEW = 'brands.view';
    case BRANDS_CREATE = 'brands.create';
    case BRANDS_UPDATE = 'brands.update';
    case BRANDS_DELETE = 'brands.delete';

    case SETTINGS_UPDATE = 'settings.update';

    public static function userPermissions(): array
    {
        return [
            self::USERS_VIEW,
        ];
    }
}
