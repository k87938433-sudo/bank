<?php include 'header.php'; ?>

<h1>Регистрация клиента</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($fullname && $email && $password) {
        $users = load_json('users.json');
        foreach ($users as $u) {
            if ($u['email'] === $email) {
                echo '<p class="error">Пользователь с таким email уже существует.</p>';
                $email = '';
                break;
            }
        }
        if ($email !== '') {
            $id = 1;
            foreach ($users as $u) { if ($u['id'] >= $id) $id = $u['id'] + 1; }
            $users[] = [
                'id' => $id,
                'fullname' => $fullname,
                'email' => $email,
                'role' => 'client',
                'password_hash' => password_hash($password, PASSWORD_DEFAULT)
            ];
            save_json('users.json', $users);
            echo '<p class="success">Регистрация успешно выполнена. Теперь вы можете <a href="login.php">войти</a>.</p>';
        }
    } else {
        echo '<p class="error">Пожалуйста, заполните все поля.</p>';
    }
}
?>

<form method="post" action="register.php" class="form">
    <label>ФИО:
        <input type="text" name="fullname" required>
    </label>
    <label>Email:
        <input type="email" name="email" required>
    </label>
    <label>Пароль:
        <input type="password" name="password" required>
    </label>
    <button type="submit" class="btn">Зарегистрироваться</button>
</form>

<?php include 'footer.php'; ?>
