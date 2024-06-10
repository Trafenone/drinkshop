<?php

/** @var array $order */
/** @var array $orderItems */
$this->title = 'Замовлення';
?>

<div class="mt-2">
    <h1>Деталі замовлення</h1>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>ID замовлення:</strong> <?= $order->id ?></p>
            <p class="card-text"><strong>Покупець:</strong> <?= $order->username ?> (<?= $order->email ?>)</p>
            <p class="card-text"><strong>Сума:</strong> <?= $order->total_amount ?></p>
            <p class="card-text"><strong>Статус:</strong> <?= $order->status ?></p>
            <p class="card-text"><strong>Час створення:</strong> <?= $order->created_at ?></p>
            <p class="card-text"><strong>Час оновлення:</strong> <?= $order->updated_at ?></p>
        </div>
    </div>

    <h2>Товари замовлення</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Товар</th>
                <th>Кількість</th>
                <th>Ціна</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?= $item->product_name ?></td>
                    <td><?= $item->quantity ?></td>
                    <td><?= $item->price ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Оновлення статусу</h2>
    <form method="post" action="/adminOrder/updatestatus/<?= $order->id ?>" class="mb-4">
        <div class="mb-3">
            <label for="status" class="form-label">Статус:</label>
            <select name="status" id="status" class="form-select">
                <option value="Pending" <?= $order->status == 'Pending' ? 'selected' : '' ?>>В очікуванні</option>
                <option value="Processing" <?= $order->status == 'Processing' ? 'selected' : '' ?>>Обробка</option>
                <option value="Completed" <?= $order->status == 'Completed' ? 'selected' : '' ?>>Виконано</option>
                <option value="Cancelled" <?= $order->status == 'Cancelled' ? 'selected' : '' ?>>Скасовано</option>
            </select>
        </div>
        <div >
            <button type="submit" class="btn btn-primary">Оновити статус замовлення</button>
            <a href="/adminOrder/index" class="btn btn-outline-dark">Повернутися назад</a>
        </div>
    </form>
</div>
