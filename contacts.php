<?php include 'header.php'; ?>

<h1>Контакты</h1>

<p><strong>Головной офис:</strong> г. Москва, ул. Примерная, д. 10</p>
<p><strong>Телефон:</strong> +7 (495) 000-00-00</p>
<p><strong>Email:</strong> info@bankx.ru</p>

<h2>Форма обратной связи</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && $email && $message) {
        $messages = load_json('messages.json');
        $id = 1;
        foreach ($messages as $m) { if ($m['id'] >= $id) $id = $m['id'] + 1; }
        $messages[] = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        save_json('messages.json', $messages);
        echo '<p class="success">Спасибо! Ваше сообщение отправлено.</p>';
    } else {
        echo '<p class="error">Пожалуйста, заполните все поля.</p>';
    }
}
?>

<form method="post" action="contacts.php" class="form">
    <label>Ваше имя:
        <input type="text" name="name" required>
    </label>
    <label>Ваш email:
        <input type="email" name="email" required>
    </label>
    <label>Сообщение:
        <textarea name="message" rows="5" required></textarea>
    </label>
    <button type="submit" class="btn">Отправить</button>
</form>

<?php include 'footer.php'; ?>
