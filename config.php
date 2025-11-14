<?php
session_start();

$host = 'localhost';
$db   = 'bank_site';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die('Ошибка подключения к БД: ' . $e->getMessage());
}

if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'] === 'accessible' ? 'accessible' : 'default';
}

$theme = $_SESSION['theme'] ?? 'default';

function is_logged_in() {
    return isset($_SESSION['user']);
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

function require_role($roles) {
    if (!is_array($roles)) {
        $roles = [$roles];
    }
    if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles)) {
        header('HTTP/1.1 403 Forbidden');
        echo '<p>Доступ запрещён.</p>';
        exit;
    }
}
?>
