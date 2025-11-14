<?php include 'header.php'; ?>
<?php require_role('admin'); ?>

<h1>Админ-панель</h1>

<section>
    <h2>Управление новостями</h2>
    <p><a href="news_edit.php">Создать новость</a></p>
    <?php
    $newsList = load_json('news.json');
    if ($newsList):
        usort($newsList, function($a, $b){ return $b['id'] <=> $a['id']; });
    ?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($newsList as $news): ?>
            <tr>
                <td><?php echo $news['id']; ?></td>
                <td><?php echo htmlspecialchars($news['title']); ?></td>
                <td>
                    <a href="news_edit.php?id=<?php echo $news['id']; ?>">Редактировать</a> |
                    <a href="news_edit.php?delete=<?php echo $news['id']; ?>" onclick="return confirm('Удалить новость?');">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Новостей нет.</p>
    <?php endif; ?>
</section>

<section>
    <h2>Заявки клиентов</h2>
    <p><a href="applications_admin.php">Перейти к заявкам</a></p>
</section>

<section>
    <h2>Сообщения с формы обратной связи</h2>
    <?php
    $messages = load_json('messages.json');
    if ($messages):
        usort($messages, function($a, $b){ return $b['id'] <=> $a['id']; });
        foreach ($messages as $m):
    ?>
        <article class="news-item">
            <h3><?php echo htmlspecialchars($m['name']); ?> (<?php echo htmlspecialchars($m['email']); ?>)</h3>
            <p class="date"><?php echo htmlspecialchars($m['created_at']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($m['message'])); ?></p>
        </article>
    <?php
        endforeach;
    else:
        echo '<p>Сообщений нет.</p>';
    endif;
    ?>
</section>

<?php include 'footer.php'; ?>
