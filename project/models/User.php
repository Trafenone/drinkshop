<?php

namespace project\models;

use core\Core;
use core\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    public static $tableName = 'users';

    public static function getUserInformation()
    {
        return Core::getInstance()->session->get('user');
    }

    public static function findByEmailAndPassword($email, $password)
    {
        $rows = self::findByCondition(['email' => $email, 'password' => self::hashPassword($password)]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function findByEmail($email)
    {
        $rows = self::findByCondition(['email' => $email]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function isAdmin(): bool
    {
        if (self::isUserLogged()) {
            return Core::getInstance()->session->get('user')->isAdmin;
        }
        return false;
    }

    public static function isUserLogged(): bool
    {
        return !empty(Core::getInstance()->session->get('user'));
    }

    public static function login($user): void
    {
        Core::getInstance()->session->set('user', $user);
    }

    public static function register($username, $email, $password): void
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = self::hashPassword($password);
        $user->save();
    }

    public static function logout(): void
    {
        Core::getInstance()->session->remove('user');
    }

    public static function hashPassword($password): string
    {
        return md5($password);
    }
}