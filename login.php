<?php include 'header.php'; ?>

<h1>Вход в систему</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email && $password) {
        $users = load_json('users.json');
        $found = null;
        foreach ($users as $u) {
            if ($u['email'] === $email && password_verify($password, $u['password_hash'])) {
                $found = $u;
                break;
            }
        }
        if ($found) {
            $_SESSION['user'] = $found;
            echo '<p class="success">Вы успешно вошли. Перейдите на нужный раздел сайта.</p>';
        } else {
            echo '<p class="error">Неверный email или пароль.</p>';
        }
    } else {
        echo '<p class="error">Заполните все поля.</p>';
    }
}
?>

<form method="post" action="login.php" class="form">
    <label>Email:
        <input type="email" name="email" required>
    </label>
    <label>Пароль:
        <input type="password" name="password" required>
    </label>
    <button type="submit" class="btn">Войти</button>
</form>

<?php include 'footer.php'; ?>
