<?php include 'header.php'; ?>

<h1>Регистрация клиента</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($fullname && $email && $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password_hash, role) VALUES (?, ?, ?, 'client')");
        try {
            $stmt->execute([$fullname, $email, $passwordHash]);
            echo '<p class="success">Регистрация успешно выполнена. Теперь вы можете <a href="login.php">войти</a>.</p>';
        } catch (PDOException $e) {
            echo '<p class="error">Ошибка регистрации: возможно, такой email уже используется.</p>';
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
