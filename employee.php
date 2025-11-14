<?php include 'header.php'; ?>
<?php require_role(['employee','admin']); ?>

<h1>Создание пользователя (сотрудник банка)</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'client';

    if ($fullname && $email && $password && in_array($role, ['client','employee'])) {
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
                'role' => $role,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT)
            ];
            save_json('users.json', $users);
            echo '<p class="success">Пользователь успешно создан.</p>';
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
