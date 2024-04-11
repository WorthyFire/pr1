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
    </style>
</head>
<body>
<div class="container">
    <h2>Добавление нового сотрудника</h2>
    <form>
        <input type="text" id="surname" name="surname" placeholder="Фамилия" required>
        <input type="text" id="name" name="name" placeholder="Имя" required>
        <input type="text" id="patronymic" name="patronymic" placeholder="Отчество">
        <select id="gender" name="gender">
            <option value="male">Мужской</option>
            <option value="female">Женский</option>
        </select>
        <input type="date" id="birth-date" name="birth-date" placeholder="Дата рождения">
        <input type="text" id="address" name="address" placeholder="Адрес прописки">
        <input type="text" id="position" name="position" placeholder="Должность (не обязательно)">
        <input type="text" id="department" name="department" placeholder="Подразделение (не обязательно)">
        <button>Добавить</button>
    </form>
</div>
</body>
</html>