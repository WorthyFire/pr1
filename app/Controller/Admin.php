<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Model\Role;

class Admin
{
    public function addEmployees(Request $request): string
    {
        // Проверяем, были ли данные отправлены методом POST
        if ($request->method === 'POST') {
            // Получаем все данные запроса
            $requestData = $request->all();

            // Проверяем, существует ли уже пользователь с таким логином
            $existingUser = User::where('login', $requestData['login'])->first();

            // Если пользователь уже существует и он является сотрудником отдела кадров, выводим сообщение об ошибке
            if ($existingUser && $existingUser->hasRole('Сотрудник отдела кадров')) {
                return new View('error', ['message' => 'Сотрудник с таким логином уже существует']);
            }

            // Если пользователя с таким логином еще нет, создаем нового
            $user = User::create([
                'login' => $requestData['login'], // Используем метод all() для получения данных
                'password' => md5($requestData['password']), // Хэшируем пароль
            ]);

            // Проверяем, был ли пользователь успешно создан
            if ($user) {
                // Находим роль "Сотрудник отдела кадров"
                $role = Role::where('Name', 'Сотрудник отдела кадров')->first();

                // Если роль найдена, присваиваем ее созданному пользователю
                if ($role) {
                    $user->roles()->attach($role->RoleID);
                }

                // Перенаправляем пользователя после успешного добавления
                app()->route->redirect('/hello');
            }
        }

        // Если что-то пошло не так или данные неверны, отображаем форму добавления сотрудника с сообщением об ошибке
        return new View('admin.add_employees', ['message' => 'Неправильные данные']);
    }
}
