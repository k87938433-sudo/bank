<?php include 'header.php'; ?>

<h1>Новости банка</h1>

<div class="search-block">
    <label>Поиск по новостям:
        <input type="text" id="news-search" placeholder="Введите ключевое слово">
    </label>
</div>

<div id="news-list">
    <?php
    $newsList = load_json('news.json');
    if ($newsList):
        usort($newsList, function($a, $b){ return $b['id'] <=> $a['id']; });
        foreach ($newsList as $news):
    ?>
        <article class="news-item">
            <h2><?php echo htmlspecialchars($news['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
        </article>
    <?php
        endforeach;
    else:
    ?>
        <p>Новости пока отсутствуют.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
