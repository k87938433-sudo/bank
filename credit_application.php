<?php include 'header.php'; ?>

<h1>Заявка на кредит</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $term = trim($_POST['term'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($fullname && $phone && $amount && $term) {
        $stmt = $pdo->prepare("INSERT INTO credit_applications (fullname, phone, amount, term, comment) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fullname, $phone, $amount, $term, $comment]);
        echo '<p class="success">Заявка отправлена. С вами свяжется сотрудник банка.</p>';
    } else {
        echo '<p class="error">Пожалуйста, заполните все обязательные поля.</p>';
    }
}
?>

<form method="post" action="credit_application.php" class="form">
    <label>ФИО:
        <input type="text" name="fullname" required>
    </label>
    <label>Телефон:
        <input type="text" name="phone" required>
    </label>
    <label>Сумма кредита, руб.:
        <input type="number" name="amount" required>
    </label>
    <label>Срок кредита, месяцев:
        <input type="number" name="term" required>
    </label>
    <label>Комментарий:
        <textarea name="comment" rows="4"></textarea>
    </label>
    <button type="submit" class="btn">Отправить заявку</button>
</form>

<?php include 'footer.php'; ?>
