<?php include 'header.php'; ?>

<h1>Заявка на вклад</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $term = trim($_POST['term'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($fullname && $phone && $amount && $term && $type) {
        $stmt = $pdo->prepare("INSERT INTO deposit_applications (fullname, phone, amount, term, type, comment) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fullname, $phone, $amount, $term, $type, $comment]);
        echo '<p class="success">Заявка на вклад отправлена. С вами свяжется сотрудник банка.</p>';
    } else {
        echo '<p class="error">Пожалуйста, заполните все обязательные поля.</p>';
    }
}
?>

<form method="post" action="deposit_application.php" class="form">
    <label>ФИО:
        <input type="text" name="fullname" required>
    </label>
    <label>Телефон:
        <input type="text" name="phone" required>
    </label>
    <label>Сумма вклада, руб.:
        <input type="number" name="amount" required>
    </label>
    <label>Срок вклада, месяцев:
        <input type="number" name="term" required>
    </label>
    <label>Тип вклада:
        <select name="type" required>
            <option value="">Выберите тип</option>
            <option value="Накопительный">Накопительный</option>
            <option value="Срочный">Срочный</option>
            <option value="До востребования">До востребования</option>
        </select>
    </label>
    <label>Комментарий:
        <textarea name="comment" rows="4"></textarea>
    </label>
    <button type="submit" class="btn">Отправить заявку</button>
</form>

<?php include 'footer.php'; ?>
