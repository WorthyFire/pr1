<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отдел кадров: Компании</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
use Model\Department;
use Model\Employee;
use Carbon\Carbon;

// Функция для вычисления среднего возраста сотрудников в подразделении
function averageAgeByDepartment($departmentId)
{
    $employees = Employee::whereHas('departments', function ($query) use ($departmentId) {
        $query->where('departments.DepartmentID', $departmentId);
    })->get();

    $totalAge = 0;
    $count = $employees->count();

    foreach ($employees as $employee) {
        $totalAge += Carbon::parse($employee->BirthDate)->age;
    }

    return $count > 0 ? round($totalAge / $count) : 0;
}

// Получаем все подразделения
$departments = Department::all();
?>
<h2>Отдел кадров: Средний возраст сотрудников подразделений</h2>
<table>
    <tr>
        <th>#</th>
        <th>Наименование подразделения</th>
        <th>Средний возраст</th>
    </tr>
    <?php
    // Отображение среднего возраста для каждого подразделения
    foreach ($departments as $department) {
        $averageAge = averageAgeByDepartment($department->DepartmentID);
        echo "<tr>
                <td>{$department->DepartmentID}</td>
                <td>{$department->Name}</td>
                <td>{$averageAge} лет</td>
              </tr>";
    }
    ?>
</table>
</body>
</html>
