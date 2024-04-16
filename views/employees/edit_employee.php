<?php
use Model\Employee;
use Model\Department;
use Model\Position;

// Проверяем, передан ли параметр employee_id
if (isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];

    // Получаем данные о сотруднике по его ID
    $employee = Employee::find($employeeId);

    if ($employee) {
        // Если данные формы были отправлены методом POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Обновляем информацию о сотруднике
            $employee->Surname = $_POST['surname'];
            $employee->FirstName = $_POST['firstname'];
            $employee->Patronymic = $_POST['patronymic'];
            $employee->Gender = $_POST['gender'];
            $employee->BirthDate = $_POST['birth_date'];
            $employee->Address = $_POST['address'];

            // Получаем ID выбранной должности и подразделения из формы
            $positionId = $_POST['position'];
            $departmentId = $_POST['department'];


            // Получаем соответствующие модели должности и подразделения по их ID
            $position = Position::find($positionId);
            $department = Department::find($departmentId);

            // Связываем сотрудника с должностью, если указано
            if ($position) {
                $employee->positions()->sync([$positionId]);
            }

            // Связываем сотрудника с подразделением, если указано
            if ($department) {
                $employee->departments()->sync([$departmentId]);
            }

            $employee->save(); // Сохраняем изменения в базе данных

            header("Location: hello"); // Замените "index.php" на путь к вашей странице со списком сотрудников
            exit();
        }

        // Получаем список всех подразделений и должностей
        $departments = Department::all();
        $positions = Position::all();

        // Выводим форму редактирования данных о сотруднике
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>Редактирование данных сотрудника</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f7f6;
                }

                .container {
                    width: 80%;
                    margin: 20px auto;
                    background: #fff;
                    padding: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                h1 {
                    margin-top: 0;
                }

                label {
                    display: block;
                    margin-bottom: 5px;
                }

                input[type="text"],
                select {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                input[type="submit"] {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h1>Редактирование данных сотрудника</h1>
            <form method="post">
                <!-- Добавляем поля для редактирования информации о сотруднике -->
                <label for="surname">Фамилия:</label>
                <input type="text" id="surname" name="surname" value="<?= $employee->Surname ?>">

                <label for="firstname">Имя:</label>
                <input type="text" id="firstname" name="firstname" value="<?= $employee->FirstName ?>">

                <label for="patronymic">Отчество:</label>
                <input type="text" id="patronymic" name="patronymic" value="<?= $employee->Patronymic ?>">

                <label for="gender">Пол (M/F):</label>
                <input type="text" id="gender" name="gender" value="<?= $employee->Gender ?>">

                <label for="birth_date">Дата рождения (гггг-мм-дд):</label>
                <input type="text" id="birth_date" name="birth_date" value="<?= $employee->BirthDate ?>">

                <label for="address">Адрес прописки:</label>
                <input type="text" id="address" name="address" value="<?= $employee->Address ?>">

                <!-- Добавляем выпадающие списки для выбора должности и подразделения -->
                <label for="position">Должность:</label>
                <select name="position" id="position">
                    <?php foreach ($positions as $position): ?>
                        <option value="<?= $position->PositionID ?>" <?= ($employee->positions->contains('id', $position->PositionID)) ? 'selected' : '' ?>>
                            <?= $position->Name ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="department">Подразделение:</label>
                <select name="department" id="department">
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= $department->DepartmentID ?>" <?= ($employee->departments->contains('id', $department->DepartmentID)) ? 'selected' : '' ?>><?= $department->Name ?></option>
                    <?php endforeach; ?>
                </select>


                <input type="hidden" name="employee_id" value="<?= $employeeId ?>">
                <input type="submit" value="Сохранить изменения">
            </form>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Сотрудник с ID $employeeId не найден.";
    }
} else {
    echo "Не передан ID сотрудника для редактирования.";
}
?>
