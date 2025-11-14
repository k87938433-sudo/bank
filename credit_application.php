<?php include 'header.php'; ?>

<section class="page-section credit-page">
    <h1>Заявка на кредит</h1>

    <p>Заполните форму ниже, и наш специалист свяжется с вами в ближайшее время.</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $amount = trim($_POST['amount'] ?? '');
        $comment = trim($_POST['comment'] ?? '');

        if ($fullname && $phone && $amount) {
            $requests = load_json('credit_requests.json');
            $id = max(array_column($requests, 'id') ?: [0]) + 1;

            $requests[] = [
                'id' => $id,
                'fullname' => $fullname,
                'phone' => $phone,
                'amount' => $amount,
                'comment' => $comment,
                'created_at' => date('Y-m-d H:i:s')
            ];

            save_json('credit_requests.json', $requests);

            echo '<p class="success-msg">Спасибо! Ваша заявка отправлена.</p>';
        } else {
            echo '<p class="error-msg">Пожалуйста, заполните обязательные поля.</p>';
        }
    }
    ?>

    <form method="post" action="/credit_application.php" class="form loan-form">
        <label>ФИО:
            <input type="text" name="fullname" required>
        </label>

        <label>Телефон:
            <input type="text" name="phone" required>
        </label>

        <label>Сумма кредита:
            <input type="number" name="amount" required>
        </label>

        <label>Комментарий:
            <textarea name="comment" rows="4"></textarea>
        </label>

        <button type="submit" class="btn-primary">Отправить заявку</button>
    </form>
</section>

<?php include 'footer.php'; ?>
