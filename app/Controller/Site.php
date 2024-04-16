<?php

namespace Controller;

use Model\Department;
use Model\Position;
use Model\Post;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class Site
{

    public function add_worker(Request $request)
    {
        // Получение всех должностей из базы данных
        $positions = Position::all();

        // Получение всех подразделений из базы данных
        $departments = Department::all();

        if ($request->method === 'POST') {
            // Получение данных из запроса
            $surname = $request->get('surname');
            $name = $request->get('name');
            $patronymic = $request->get('patronymic');
            $gender = $request->get('gender');
            $birthDate = $request->get('birth-date');
            $address = $request->get('address');
            $position = Position::find($request->get('position'));
            $department = Department::find($request->get('department'));

            // Создаем новые экземпляры валидаторов для каждого поля
            $surnameValidator = new \Validators\CyrillicValidator('surname', $surname);
            $nameValidator = new \Validators\CyrillicValidator('name', $name);
            $patronymicValidator = new \Validators\CyrillicValidator('patronymic', $patronymic);
            $addressValidator = new \Validators\CyrillicValidator('address', $address);

            // Выполняем валидацию каждого поля
            $surnameValidation = $surnameValidator->validate();
            $nameValidation = $nameValidator->validate();
            $patronymicValidation = $patronymicValidator->validate();
            $addressValidation = $addressValidator->validate();

            // Проверяем результаты валидации
            $errors = [];
            if ($surnameValidation !== true) {
                $errors['surname'] = $surnameValidation;
            }
            if ($nameValidation !== true) {
                $errors['name'] = $nameValidation;
            }
            if ($patronymicValidation !== true) {
                $errors['patronymic'] = $patronymicValidation;
            }
            if ($addressValidation !== true) {
                $errors['address'] = $addressValidation;
            }

            // Если есть ошибки валидации, возвращаем форму с ошибками
            if (!empty($errors)) {
                $view = new View();
                return $view->render('employees.add_worker', [
                    'positions' => $positions,
                    'departments' => $departments,
                    'errors' => $errors
                ]);
            }

            // Ваш текущий код обработки POST-запроса

            // После сохранения перенаправляем пользователя на страницу приветствия
            app()->route->redirect('/hello');
        } else {
            // Если метод запроса не POST, просто отображаем форму для добавления сотрудника
            $view = new View();
            return $view->render('employees.add_worker', ['positions' => $positions, 'departments' => $departments]);
        }
    }


    public function add_divisions(Request $request)
    {
        // Если метод запроса - POST, значит, пользователь отправил форму с данными
        if ($request->method === 'POST') {
            // Получаем данные из запроса
            $name = $request->get('department-name');
            $type = $request->get('department-type');

            // Валидация данных
            $validator = new \Validators\UniqueDivisionsValidator('name', $name);
            $validator->validate();

            // Проверяем, прошла ли валидация
            if ($validator->fails()) {
                // Если валидация не прошла, выводим ошибку пользователю
                $view = new View();
                return $view->render('employees.add_divisions', ['errors' => $validator->errors()]);
            }

            // Создаем новый экземпляр модели подразделения
            $department = new Department();
            $department->name = $name;
            $department->type = $type;

            // Сохраняем данные в базе данных
            $department->save();

            // После сохранения перенаправляем пользователя на страницу hello
            app()->route->redirect('/hello');
        } else {
            // Если метод запроса не POST, просто отображаем форму для добавления подразделения
            $view = new View();
            return $view->render('employees.add_divisions');
        }
    }




    public function avg_age(): string
    {
        $view = new View();
        return $view->render('employees.avg_age');
    }
    public function hello(Request $request): string
    {
        $departments = Department::all();
        $view = new View();
        return $view->render('site.hello', ['departments' => $departments]);
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        // var_dump($request->all());
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }

    public function edit_employee($request)
    {
        $view = new View();
        return $view->render('employees.edit_employee');
    }

}