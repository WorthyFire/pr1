<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление нового сотрудника</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
        }
        form {
            background: #f7f7f7;
            padding: 20px;
            margin-top: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Добавление нового сотрудника</h2>
    <form method="post">
        <input type="text" id="surname" name="surname" placeholder="Фамилия" required>
        <?php if(isset($errors['surname'])): ?>
            <div class="error"><?php echo $errors['surname']; ?></div>
        <?php endif; ?>
        <input type="text" id="name" name="name" placeholder="Имя" required>
        <?php if(isset($errors['name'])): ?>
            <div class="error"><?php echo $errors['name']; ?></div>
        <?php endif; ?>
        <input type="text" id="patronymic" name="patronymic" placeholder="Отчество">
        <?php if(isset($errors['patronymic'])): ?>
            <div class="error"><?php echo $errors['patronymic']; ?></div>
        <?php endif; ?>
        <select id="gender" name="gender">
            <option value="M">Мужской</option>
            <option value="F">Женский</option>
        </select>
        <input type="date" id="birth-date" name="birth-date" placeholder="Дата рождения" required>
        <input type="text" id="address" name="address" placeholder="Адрес прописки" required>
        <?php if(isset($errors['address'])): ?>
            <div class="error"><?php echo $errors['address']; ?></div>
        <?php endif; ?>
        <select id="department" name="department" placeholder="Подразделение (не обязательно)">
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?php echo $department->DepartmentID; ?>"><?php echo $department->Name; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($errors['department'])): ?>
            <div class="error"><?php echo $errors['department']; ?></div>
        <?php endif; ?>
        <select id="position" name="position" placeholder="Должность (не обязательно)">
            <option value="">Выберите должность</option>
            <?php foreach ($positions as $position): ?>
                <option value="<?php echo $position->PositionID; ?>"><?php echo $position->Name; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($errors['position'])): ?>
            <div class="error"><?php echo $errors['position']; ?></div>
        <?php endif; ?>
        <button>Добавить</button>
    </form>
</div>
</body>
</html>
