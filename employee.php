<?php include 'header.php'; ?>

<?php require_role(['employee', 'admin']); ?>

<h1>Создание пользователя (сотрудник банка)</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'client';

    if ($fullname && $email && $password && in_array($role, ['client','employee'])) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password_hash, role) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$fullname, $email, $passwordHash, $role]);
            echo '<p class="success">Пользователь успешно создан.</p>';
        } catch (PDOException $e) {
            echo '<p class="error">Ошибка создания пользователя: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    } else {
        echo '<p class="error">Заполните все поля, роль может быть client или employee.</p>';
    }
}
?>

<form method="post" action="employee.php" class="form">
    <label>ФИО:
        <input type="text" name="fullname" required>
    </label>
    <label>Email:
        <input type="email" name="email" required>
    </label>
    <label>Пароль:
        <input type="password" name="password" required>
    </label>
    <label>Роль:
        <select name="role">
            <option value="client">Клиент</option>
            <option value="employee">Сотрудник</option>
        </select>
    </label>
    <button type="submit" class="btn">Создать пользователя</button>
</form>

<?php include 'footer.php'; ?>
