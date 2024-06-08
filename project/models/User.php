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

    public static function findByEmailAndPassword($email, $password)
    {
        $rows = self::findByCondition(['email' => $email, 'password' => $password]);

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

    public static function isUserLogged(): bool
    {
        return !empty(Core::getInstance()->session->get('user'));
    }

    public static function login($user)
    {
        Core::getInstance()->session->set('user', $user);
    }

    public static function register($username, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->save();
    }

    public static function logout()
    {
        Core::getInstance()->session->remove('user');
    }
}