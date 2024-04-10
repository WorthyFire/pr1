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
        .add-button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="roles">Роль: Администратор</div>
    <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
</div>

<div class="container">
    <div>
        <button class="add-button">Добавить сотрудника отдела кадров</button>
    </div>
    <h2>Отдел кадров: Список сотрудников</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Адрес прописски</th>
            <th>Должность</th>
            <th>Подразделение</th>

            <!-- Добавьте остальные столбцы согласно вашим требованиям -->
        </tr>
        <!-- Здесь будут строки с данными сотрудников, которые можно генерировать динамически с помощью PHP -->
    </table>
</div>

</body>
</html>
