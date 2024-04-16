<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\RoleAdminMiddleware::class,
        'employees'=> \Middlewares\RoleEmployeesMiddleware::class
    ],
    'routeAppMiddleware' => [
      'trim' => \Middlewares\TrimMiddleware::class,
      'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],

    'validator' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'uniqueDivisions' => \Validators\UniqueDivisionsValidator::class,
        'cyrillic'=>\Validators\CyrillicValidator::class,
        ]
 ];
