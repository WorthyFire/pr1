<?php

namespace Src\Auth;

use Src\Session;
use Model\User;

class Auth
{
    //Свойство для хранения текущего пользователя
    private static ?User $user = null;

    //Инициализация текущего пользователя
    public static function init(User $user): void
    {
        self::$user = $user;
        if (self::user()) {
            self::login(self::user());
        }
    }

    //Вход пользователя
    public static function login(User $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
    }

    //Аутентификация пользователя и вход по учетным данным
    public static function attempt(array $credentials): bool
    {
        $user = User::where('login', $credentials['login'])->first();
        //var_dump($user->Password, md5($credentials['password']));
        if ($user && md5($credentials['password']) === $user->Password) {
            self::login($user);
            return true;
        }
        return false;
    }

    //Возврат текущего аутентифицированного пользователя
    public static function user(): ?User
    {
        $id = Session::get('id');
        return $id ? User::find($id) : null;
    }
    //Генерация нового токена для CSRF
    public static function generateCSRF(): string
    {
        $token = md5(time());
        Session::set('csrf_token', $token);
        return $token;
    }


    //Проверка является ли текущий пользователь аутентифицированным
    public static function check(): bool
    {
        return self::user() !== null;
    }

    //Проверка роли пользователя
    public static function checkRole(string $roleName): bool
    {
        $user = self::user();
        return $user && $user->roles()->where('Name', $roleName)->exists();
    }

    //Выход текущего пользователя
    public static function logout(): void
    {
        Session::clear('id');
        self::$user = null;
    }
}
