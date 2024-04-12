<?php
// RoleAdminMiddleware.php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleAdminMiddleware
{
    public function handle(Request $request)
    {
        // Проверяем, имеет ли текущий пользователь роль администратора
        if (!Auth::checkRole('Администратор')) {
            // Если нет, перенаправляем его на другую страницу
            app()->route->redirect('/hello');
        }
    }
}
