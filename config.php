<?php
session_start();

function load_json($file) {
    $path = __DIR__ . '/data/' . $file;
    if (!file_exists($path)) {
        return [];
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function save_json($file, $data) {
    $path = __DIR__ . '/data/' . $file;
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

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

// тема: обычная / для слабовидящих
if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'] === 'accessible' ? 'accessible' : 'default';
}
$theme = $_SESSION['theme'] ?? 'default';
?>
