<?php include 'header.php'; ?>
<?php require_role(['employee','admin']); ?>

<h1>Заявки клиентов</h1>

<h2>Кредитные заявки</h2>
<?php
$credit = load_json('credit_applications.json');
if ($credit):
    usort($credit, function($a, $b){ return $b['id'] <=> $a['id']; });
?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Сумма</th>
        <th>Срок</th>
        <th>Комментарий</th>
        <th>Дата</th>
    </tr>
    <?php foreach ($credit as $c): ?>
    <tr>
        <td><?php echo $c['id']; ?></td>
        <td><?php echo htmlspecialchars($c['fullname']); ?></td>
        <td><?php echo htmlspecialchars($c['phone']); ?></td>
        <td><?php echo htmlspecialchars($c['amount']); ?></td>
        <td><?php echo htmlspecialchars($c['term']); ?></td>
        <td><?php echo nl2br(htmlspecialchars($c['comment'])); ?></td>
        <td><?php echo htmlspecialchars($c['created_at']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p>Кредитных заявок нет.</p>
<?php endif; ?>

<h2>Заявки на вклады</h2>
<?php
$dep = load_json('deposit_applications.json');
if ($dep):
    usort($dep, function($a, $b){ return $b['id'] <=> $a['id']; });
?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Сумма</th>
        <th>Срок</th>
        <th>Тип вклада</th>
        <th>Комментарий</th>
        <th>Дата</th>
    </tr>
    <?php foreach ($dep as $d): ?>
    <tr>
        <td><?php echo $d['id']; ?></td>
        <td><?php echo htmlspecialchars($d['fullname']); ?></td>
        <td><?php echo htmlspecialchars($d['phone']); ?></td>
        <td><?php echo htmlspecialchars($d['amount']); ?></td>
        <td><?php echo htmlspecialchars($d['term']); ?></td>
        <td><?php echo htmlspecialchars($d['type']); ?></td>
        <td><?php echo nl2br(htmlspecialchars($d['comment'])); ?></td>
        <td><?php echo htmlspecialchars($d['created_at']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p>Заявок на вклады нет.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
