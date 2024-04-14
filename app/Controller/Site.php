<?php

namespace Controller;

use Model\Department;
use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{

    public function add_worker(): string
    {
        $view = new View();
        return $view->render('employees.add_worker');
    }
    public function add_divisions(Request $request)
    {
        // Если метод запроса - POST, значит, пользователь отправил форму с данными
        if ($request->method === 'POST') {
            // Получаем данные из запроса
            $name = $request->get('department-name');
            $type = $request->get('department-type');

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
    public function hello(): string
    {
       // var_dump(app()->auth::user()->roles); die();
        return new View('site.hello', ['message' => 'hello working']);
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




}