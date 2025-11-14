<?php include 'header.php'; ?>

<?php require_role('admin'); ?>

<h1>Админ-панель</h1>

<section>
    <h2>Управление новостями</h2>
    <p><a href="news_edit.php">Создать новость</a></p>
    <?php
    $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
    $newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($newsList):
    ?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($newsList as $news): ?>
            <tr>
                <td><?php echo $news['id']; ?></td>
                <td><?php echo htmlspecialchars($news['title']); ?></td>
                <td><?php echo htmlspecialchars($news['created_at']); ?></td>
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
    <h2>Просмотр заявок</h2>
    <p><a href="applications_admin.php">Перейти к заявкам</a></p>
</section>

<?php include 'footer.php'; ?>
