<?php include 'header.php'; ?>

<?php
$u = current_user();
if (!$u || $u['role'] !== 'employee') {
    header('Location: /login.php');
    exit;
}
?>

<section class="page-section employee-page">
    <h1>Кабинет сотрудника</h1>

    <p>Добро пожаловать, <?= htmlspecialchars($u['fullname']) ?>!</p>
    <p>Здесь вы можете просматривать заявки клиентов и сообщения.</p>

    <a href="/admin.php" class="btn-primary">Просмотр всех записей</a>
</section>

<?php include 'footer.php'; ?>
