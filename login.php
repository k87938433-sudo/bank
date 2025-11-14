<?php include 'header.php'; ?>

<h1>Вход в систему</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'fullname' => $user['fullname'],
                'role' => $user['role'],
                'email' => $user['email']
            ];
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
