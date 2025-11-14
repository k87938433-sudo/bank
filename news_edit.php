<?php include 'header.php'; ?>

<?php require_role('admin'); ?>

<?php
$id = $_GET['id'] ?? null;
$deleteId = $_GET['delete'] ?? null;

if ($deleteId) {
    $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$deleteId]);
    echo '<p class="success">Новость удалена.</p>';
}

$title = '';
$content = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $n = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($n) {
        $title = $n['title'];
        $content = $n['content'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title && $content) {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $content, $id]);
            echo '<p class="success">Новость обновлена.</p>';
        } else {
            $stmt = $pdo->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
            $stmt->execute([$title, $content]);
            echo '<p class="success">Новость создана.</p>';
        }
    } else {
        echo '<p class="error">Заполните все поля.</p>';
    }
}
?>

<h1><?php echo $id ? 'Редактирование новости' : 'Создание новости'; ?></h1>

<form method="post" action="" class="form">
    <label>Заголовок:
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
    </label>
    <label>Текст новости:
        <textarea name="content" rows="8" required><?php echo htmlspecialchars($content); ?></textarea>
    </label>
    <button type="submit" class="btn">Сохранить</button>
</form>

<p><a href="admin.php">Вернуться в админ-панель</a></p>

<?php include 'footer.php'; ?>
