<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;
use Src\Response;

class RoleMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        // Если пользователь не администратор, выполняем редирект на главную страницу сотрудника
        if (!Auth::checkRole()) {
            return new Response('Forbidden', 403);
        }

        // Пропускаем пользователя дальше
        return $next($request);
    }
}

