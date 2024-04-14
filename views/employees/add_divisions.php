<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление нового подразделения</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
        }
        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form {
            padding: 20px;
        }
        input {
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
    <h2>Добавление нового подразделения</h2>
    <form method="post">
        <input type="text" id="department-name" name="department-name" placeholder="Наименование подразделения" required>
        <input type="text" id="department-type" name="department-type" placeholder="Тип подразделения" required>
        <button>Добавить подразделение</button>
    </form>
</div>
</body>
</html>
