<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отдел кадров: Компании</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7f6;
        }
        .header {
            background: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .roles {
            font-size: 0.9em;
            color: #555;
        }
        .header .exit {
            font-size: 0.9em;
            color: #555;
            cursor: pointer;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .add-button-container {
            display: inline-block;
            margin-right: 10px;
        }
        .add-button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-button:hover{
            background-color: blue;
        }
    </style>
</head>
<body>
<?php
// Проверяем, авторизован ли пользователь
if (app()->auth::check()) {
    // Получаем текущего пользователя
    $user = app()->auth::user();

    // Получаем роль пользователя
    $role = $user->roles->isNotEmpty() ? $user->roles[0]->Name : 'Неизвестно';
} else {
    $role = 'Неизвестно';
}
?>
<div class="header">
    <div class="roles">Роль: <?php echo $role; ?></div>
    <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
</div>

<div class="container">
    <?php if (app()->auth::check() && app()->auth::user()->roles->contains('Name', 'Администратор')): ?>
        <div class="add-button-container">
            <a href="<?= app()->route->getUrl('/addEmployees') ?>" class="add-button">Добавить сотрудника отдела кадров</a>
        </div>
    <?php endif; ?>

    <?php if (app()->auth::check() && app()->auth::user()->roles->contains('Name', 'Сотрудник отдела кадров')): ?>
        <div class="add-button-container">
            <a href="<?= app()->route->getUrl('/add_worker') ?>" class="add-button">Добавить нового сотрудника</a>
        </div>
        <div class="add-button-container">
            <a href="<?= app()->route->getUrl('/add_divisions') ?>" class="add-button">Добавить новое подразделение</a>
        </div>
        <div class="add-button-container">
            <a href="<?= app()->route->getUrl('/avg_age') ?>" class="add-button">Средний возраст сотрудников подразделений</a>
        </div>
    <br>
    <br>
        <input type="text" placeholder="Поиск сотрудников" >
    <?php endif; ?>

    <h2>Отдел кадров: Список сотрудников</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Адрес прописки</th>
            <th>Должность</th>
            <th>Подразделение</th>
        </tr>
    </table>
</div>


</body>
</html>
