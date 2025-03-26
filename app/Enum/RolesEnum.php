<?php

namespace App\Enum;

enum RolesEnum: string
{
    case Admin = 'admin';
    case User = 'user';
    case Moderator = 'moderator';
    case Commenter = 'commenter';

    public static function labels(): array
    {
        return [
            self::Admin => 'Admin',
            self::User => 'User',
            self::Moderator => 'Moderator',
            self::Commenter => 'Commenter',
        ];
    }

    public static function label(self $role): string
    {
        return self::labels()[$role->value];
    }
}
