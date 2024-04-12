<?php
// RoleAdminMiddleware.php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleEmployeesMiddleware
{
    public function handle(Request $request)
    {
        // Проверяем, имеет ли текущий пользователь роль "Сотрудник отдела кадров"
        if (!Auth::checkRole('Сотрудник отдела кадров')) {
            // Если нет, перенаправляем его на другую страницу
            app()->route->redirect('/hello');
        }
    }
}
