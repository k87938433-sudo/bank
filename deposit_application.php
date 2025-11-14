<?php include 'header.php'; ?>

<section class="page-section deposit-page">
    <h1>Заявка на вклад</h1>

    <p>Оставьте заявку, и менеджер банка поможет подобрать подходящий вклад и оформить документы.</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $amount = trim($_POST['amount'] ?? '');
        $term = trim($_POST['term'] ?? '');

        if ($fullname && $phone && $amount && $term) {
            $requests = load_json('deposit_requests.json');
            $id = max(array_column($requests, 'id') ?: [0]) + 1;

            $requests[] = [
                'id' => $id,
                'fullname' => $fullname,
                'phone' => $phone,
                'amount' => $amount,
                'term' => $term,
                'created_at' => date('Y-m-d H:i:s')
            ];

            save_json('deposit_requests.json', $requests);

            echo '<p class="success-msg">Спасибо! Ваша заявка отправлена.</p>';
        } else {
            echo '<p class="error-msg">Пожалуйста, заполните все поля.</p>';
        }
    }
    ?>

    <form method="post" action="/deposit_application.php" class="form deposit-form">
        <label>ФИО:
            <input type="text" name="fullname" required>
        </label>

        <label>Телефон:
            <input type="text" name="phone" required>
        </label>

        <label>Сумма вклада:
            <input type="number" name="amount" required>
        </label>

        <label>Срок вклада:
            <select name="term" required>
                <option value="">Выберите срок</option>
                <option value="6 месяцев">6 месяцев</option>
                <option value="1 год">1 год</option>
                <option value="2 года">2 года</option>
            </select>
        </label>

        <button type="submit" class="btn-primary">Отправить заявку</button>
    </form>
</section>

<?php include 'footer.php'; ?>
