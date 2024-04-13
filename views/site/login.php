<!-- login.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отдел кадров</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7f6;
            color: #333;
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type='text'],
        .login-container input[type='password'] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Отдел кадров</h2>
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?= $message ?></p>
    <?php endif; ?>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" id="login" name="login" placeholder="Логин" required>
        <input type="password" id="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>

</div>
</body>
</html>
