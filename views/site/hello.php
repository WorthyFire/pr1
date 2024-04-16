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
        .search-form {
            margin-bottom: 20px;
        }
        .search-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }
        .search-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }
        .filter-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .filter-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
use Model\Department;
use Model\Employee;

if (app()->auth::check()) {
    $user = app()->auth::user();
    $role = $user->roles->isNotEmpty() ? $user->roles[0]->Name : 'Неизвестно';
} else {
    $role = 'Неизвестно';
}

// Получаем все подразделения


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
        <form class="search-form" method="GET" action="<?= app()->route->getUrl('/hello') ?>">
            <input class="search-input" type="text" name="search_lastname" placeholder="Введите фамилию">
            <input class="search-input" type="text" name="search_firstname" placeholder="Введите имя">
            <button class="search-button" type="submit">Поиск</button>
        </form>

        <form class="filter-form" method="get">
            <label for="department">Подразделение:</label>
            <select class="filter-select" name="department" id="department">
                <option value="">Выберите подразделение</option>
                <?php foreach ($departments as $department): ?>
                    <option value="<?= $department->DepartmentID ?>"><?= $department->Name ?></option>
                <?php endforeach; ?>
            </select>
            <button class="filter-button" type="submit">Применить</button>
        </form>

        <!-- Выводите здесь таблицу с сотрудниками, которые прошли через фильтр -->

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
    <?php endif; ?>
    <!-- Отдел кадров: Список сотрудников -->
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
            <?php if (app()->auth::check() && app()->auth::user()->roles->contains('Name', 'Сотрудник отдела кадров')): ?>
                <th>Действия</th>
            <?php endif; ?>
        </tr>
        <?php
        // Получаем всех сотрудников
        $employees = Employee::query();

        // Поиск по фамилии и имени
        if (isset($_GET['search_lastname']) && isset($_GET['search_firstname'])) {
            // Получаем значения фамилии и имени из формы поиска
            $search_lastname = $_GET['search_lastname'];
            $search_firstname = $_GET['search_firstname'];

            $employees = $employees->where('Surname', 'like', "%$search_lastname%")
                ->where('FirstName', 'like', "%$search_firstname%");
        }


        // Фильтрация по подразделению
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['department'])) {
                $departmentId = $_GET['department'];

                if ($departmentId) {
                    $employees = $employees->whereHas('departments', function ($query) use ($departmentId) {
                        $query->where('departments.DepartmentID', $departmentId);
                    });
                }
            }
        }

        $employees = $employees->get();

        // Проверяем, есть ли сотрудники в базе данных
        if ($employees->isEmpty()) {
            echo "<tr><td colspan='10'>Нет сотрудников для отображения.</td></tr>";
        } else {
            // Выводим список сотрудников
            foreach ($employees as $employee) {
                // Получаем первую должность сотрудника
                $position = $employee->positions()->first();
                $positionName = $position ? $position->Name : 'Не указана';

                // Получаем первое подразделение сотрудника
                $department = $employee->departments()->first();
                $departmentName = $department ? $department->Name : 'Не указано';

                echo "<tr>
                        <td>{$employee->EmployeeID}</td>
                        <td>{$employee->Surname}</td>
                        <td>{$employee->FirstName}</td>
                        <td>{$employee->Patronymic}</td>
                        <td>{$employee->Gender}</td>
                        <td>{$employee->BirthDate}</td>
                        <td>{$employee->Address}</td>
                        <td>{$positionName}</td>
                        <td>{$departmentName}</td>";
                if (app()->auth::check() && app()->auth::user()->roles->contains('Name', 'Сотрудник отдела кадров')) {
                    echo "<td><a href=\"edit_employee.php?employee_id={$employee->EmployeeID}\">Редактировать</a></td>";
                }
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>
