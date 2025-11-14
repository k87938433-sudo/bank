<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>АО «Банк Х»</title>
    <link rel="stylesheet" href="css/style.css">
    <?php if ($theme === 'accessible'): ?>
        <link rel="stylesheet" href="css/accessible.css">
    <?php endif; ?>
</head>
<body class="<?php echo $theme === 'accessible' ? 'accessible' : ''; ?>">
<header class="site-header">
    <div class="container header-inner">
        <div class="logo">
            <a href="index.php">АО «Банк Х»</a>
        </div>
        <nav class="main-nav">
            <a href="index.php">Главная</a>
            <a href="about.php">О банке</a>
            <a href="products.php">Продукты</a>
            <a href="internet.php">Интернет-банк</a>
            <a href="news.php">Новости</a>
            <a href="contacts.php">Контакты</a>
            <a href="sitemap.php">Карта сайта</a>
            <a href="credit_application.php">Заявка на кредит</a>
            <a href="deposit_application.php">Заявка на вклад</a>
            <?php if (is_logged_in()): $u = current_user(); ?>
                <?php if ($u['role'] === 'admin'): ?>
                    <a href="admin.php">Админ-панель</a>
                <?php elseif ($u['role'] === 'employee'): ?>
                    <a href="employee.php">Сотруднику</a>
                <?php endif; ?>
            <?php endif; ?>
        </nav>
        <div class="user-block">
            <?php if (is_logged_in()): $u = current_user(); ?>
                <span class="user-info">
                    <?php echo htmlspecialchars($u['fullname']); ?>
                    (<?php echo htmlspecialchars($u['role']); ?>)
                </span>
                <a href="logout.php">Выход</a>
            <?php else: ?>
                <a href="login.php">Вход</a>
                <a href="register.php">Регистрация</a>
            <?php endif; ?>
        </div>
        <div class="theme-switch">
            <a href="?theme=default">Обычная версия</a> |
            <a href="?theme=accessible">Версия для слабовидящих</a>
        </div>
    </div>
</header>
<main class="content container">
