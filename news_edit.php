<?php include 'header.php'; ?>
<?php require_role('admin'); ?>

<?php
$newsList = load_json('news.json');
$id = $_GET['id'] ?? null;
$deleteId = $_GET['delete'] ?? null;

if ($deleteId) {
    $deleteId = (int)$deleteId;
    $newsList = array_values(array_filter($newsList, function($n) use ($deleteId) { return $n['id'] !== $deleteId; }));
    save_json('news.json', $newsList);
    echo '<p class="success">Новость удалена.</p>';
}

$title = '';
$content = '';

if ($id) {
    $id = (int)$id;
    foreach ($newsList as $n) {
        if ($n['id'] === $id) {
            $title = $n['title'];
            $content = $n['content'];
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title && $content) {
        if ($id) {
            foreach ($newsList as &$n) {
                if ($n['id'] === $id) {
                    $n['title'] = $title;
                    $n['content'] = $content;
                }
            }
            unset($n);
            echo '<p class="success">Новость обновлена.</p>';
        } else {
            $newId = 1;
            foreach ($newsList as $n) { if ($n['id'] >= $newId) $newId = $n['id'] + 1; }
            $newsList[] = [
                'id' => $newId,
                'title' => $title,
                'content' => $content
            ];
            echo '<p class="success">Новость создана.</p>';
        }
        save_json('news.json', $newsList);
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
