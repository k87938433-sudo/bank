<?php
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

$q = trim($_GET['q'] ?? '');
$newsList = load_json('news.json');
if ($q !== '') {
    $q_mb = mb_strtolower($q, 'UTF-8');
    $newsList = array_filter($newsList, function($n) use ($q_mb) {
        return mb_strpos(mb_strtolower($n['title'], 'UTF-8'), $q_mb) !== false
            || mb_strpos(mb_strtolower($n['content'], 'UTF-8'), $q_mb) !== false;
    });
}

if ($newsList) {
    usort($newsList, function($a, $b){ return $b['id'] <=> $a['id']; });
    foreach ($newsList as $news) {
        echo '<article class="news-item">';
        echo '<h2>' . htmlspecialchars($news['title']) . '</h2>';
        echo '<p>' . nl2br(htmlspecialchars($news['content'])) . '</p>';
        echo '</article>';
    }
} else {
    echo '<p>По вашему запросу новости не найдены.</p>';
}
