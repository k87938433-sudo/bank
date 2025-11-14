<?php include 'header.php'; ?>

<h1>Новости банка</h1>

<div class="search-block">
    <label>Поиск по новостям:
        <input type="text" id="news-search" placeholder="Введите ключевое слово">
    </label>
</div>

<div id="news-list">
    <?php
    $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
    $newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($newsList):
        foreach ($newsList as $news):
    ?>
    <article class="news-item">
        <h2><?php echo htmlspecialchars($news['title']); ?></h2>
        <p class="date"><?php echo htmlspecialchars($news['created_at']); ?></p>
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
