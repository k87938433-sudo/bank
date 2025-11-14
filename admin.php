<?php include 'header.php'; ?>

<?php
$u = current_user();
if (!$u || $u['role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}
?>

<section class="page-section admin-page">
    <h1>Админ-панель</h1>

    <h2>Сообщения из формы контактов</h2>
    <?php
    $messages = load_json('messages.json');
    if (count($messages) > 0): ?>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Сообщение</th>
                <th>Дата</th>
            </tr>
            <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
                <td><?= $m['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Нет сообщений.</p>
    <?php endif; ?>

    <h2>Заявки на кредит</h2>
    <?php
    $credits = load_json('credit_requests.json');
    if (count($credits) > 0): ?>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Сумма</th>
                <th>Комментарий</th>
                <th>Дата</th>
            </tr>
            <?php foreach ($credits as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['fullname']) ?></td>
                <td><?= htmlspecialchars($c['phone']) ?></td>
                <td><?= htmlspecialchars($c['amount']) ?></td>
                <td><?= nl2br(htmlspecialchars($c['comment'])) ?></td>
                <td><?= $c['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Нет заявок.</p>
    <?php endif; ?>

    <h2>Заявки на вклад</h2>
    <?php
    $deposits = load_json('deposit_requests.json');
    if (count($deposits) > 0): ?>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Сумма</th>
                <th>Срок</th>
                <th>Дата</th>
            </tr>
            <?php foreach ($deposits as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><?= htmlspecialchars($d['fullname']) ?></td>
                <td><?= htmlspecialchars($d['phone']) ?></td>
                <td><?= htmlspecialchars($d['amount']) ?></td>
                <td><?= htmlspecialchars($d['term']) ?></td>
                <td><?= $d['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Нет заявок.</p>
    <?php endif; ?>

</section>

<?php include 'footer.php'; ?>
