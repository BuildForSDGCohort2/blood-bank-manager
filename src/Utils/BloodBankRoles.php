<?php
namespace App\Utils;

class BloodBankRoles
{
    public const ADMIN = 'ROLE_ADMIN';
    public const MANAGER = 'ROLE_MANAGER';

    public static function get(string $role): array
    {
        if ($role == self::ADMIN) {
            return [
                self::ADMIN,
                self::MANAGER
            ];
        }

        return [
            self::MANAGER
        ];
    }
}
