<?php
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

$q = trim($_GET['q'] ?? '');
if ($q === '') {
    $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
} else {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE title LIKE :q OR content LIKE :q ORDER BY created_at DESC");
    $stmt->execute([':q' => '%' . $q . '%']);
}
$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($newsList) {
    foreach ($newsList as $news) {
        echo '<article class="news-item">';
        echo '<h2>' . htmlspecialchars($news['title']) . '</h2>';
        echo '<p class="date">' . htmlspecialchars($news['created_at']) . '</p>';
        echo '<p>' . nl2br(htmlspecialchars($news['content'])) . '</p>';
        echo '</article>';
    }
} else {
    echo '<p>По вашему запросу новости не найдены.</p>';
}
