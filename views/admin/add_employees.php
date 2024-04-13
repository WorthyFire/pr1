<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление нового сотрудника отдела кадров</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7f6;
        }
        .add_employees_content {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .add_employees_content_block {
            padding: 20px;
        }
        .form_add_employees {
            margin-top: 20px;
        }
        .fields_form {
            margin-bottom: 20px;
        }
        .field_add_employees {
            padding: 10px;
            margin-right: 10px;
            width: 200px;
        }
        .button_add_employees {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button_add_employees:hover {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
<?= $message ?? ''; ?>
<div class="add_employees_content">
    <div class="add_employees_content_block">
        <h2>Добавление нового сотрудника отдела кадров</h2>
        <form method="post" class="form_add_employees">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <div class="fields_form">
                <input class="field_add_employees" type="text" name="login" placeholder="Логин" >
                <input class="field_add_employees" type="password" name="password" placeholder="Пароль" >
            </div>
            <button class="button_add_employees">Добавить</button>
        </form>
    </div>
</div>
</body>
</html>
