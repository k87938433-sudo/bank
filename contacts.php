<?php include 'header.php'; ?>

<h1>Контакты</h1>

<p><strong>Головной офис:</strong> г. Москва, ул. Примерная, д. 10</p>
<p><strong>Телефон:</strong> +7 (495) 000-00-00</p>
<p><strong>Email:</strong> info@bankx.ru</p>

<h2>Форма обратной связи</h2>

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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<p class="success">Спасибо! Ваше сообщение отправлено (для учебного проекта сообщение не обрабатывается).</p>';
}
?>

<?php include 'footer.php'; ?>
