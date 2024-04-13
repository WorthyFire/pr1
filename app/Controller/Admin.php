<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\User;
use Model\Role;
use Src\Validator\Validator;

class Admin
{
    public function addEmployees(Request $request): string
    {
        if ($request->method === 'POST') {

            // Получаем все данные из запроса
            $requestData = $request->all();

            // Проверяем, что поля не пустые
            if (empty($requestData['login']) || empty($requestData['password'])) {
                return new View('admin.add_employees', ['message' => 'Логин и пароль обязательны для заполнения']);
            }

            // Проверяем, существует ли пользователь с таким логином
            $existingUser = User::where('login', $requestData['login'])->first();
            if ($existingUser) {
                return new View('admin.add_employees', ['message' => 'Пользователь с таким логином уже существует']);
            }

            // Валидация входных данных
            $validator = new Validator($requestData, [
                'login' => ['required'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field обязательно для заполнения'
            ]);

            // Проверка на ошибки валидации
            if($validator->fails()){
                return new View('admin.add_employees', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            // Создание нового пользователя
            $user = User::create([
                'login' => $requestData['login'],
                'password' => md5($requestData['password']),
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
        return new View('admin.add_employees', ['message' => '']);
    }
}
