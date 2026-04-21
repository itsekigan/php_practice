<?php
session_start();

const LOGIN_ID = 'admin';
const LOGIN_PASSWORD = 'password123';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginId = trim($_POST['login_id'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($loginId === LOGIN_ID && $password === LOGIN_PASSWORD) {
        $_SESSION['user'] = $loginId;
        header('Location: index.php');
        exit;
    }

    $errorMessage = 'ログインIDまたはパスワードが正しくありません。';
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background: #f2f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: min(420px, 90vw);
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
        }

        h1 {
            margin-top: 0;
            font-size: 1.4rem;
            text-align: center;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #c8d0db;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background: #1e4fc2;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .welcome {
            text-align: center;
        }

        .logout {
            display: inline-block;
            margin-top: 16px;
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="card">
    <?php if ($isLoggedIn): ?>
        <div class="welcome">
            <h1>ログイン成功</h1>
            <p>ようこそ、<?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?> さん</p>
            <a class="logout" href="?logout=1">ログアウト</a>
        </div>
    <?php else: ?>
        <h1>ログイン</h1>
        <?php if ($errorMessage !== ''): ?>
            <p class="error"><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form method="post" action="index.php">
            <div class="field">
                <label for="login_id">ログインID</label>
                <input id="login_id" type="text" name="login_id" required>
            </div>
            <div class="field">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
