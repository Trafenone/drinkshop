<?php

/** @var array $orders */
$this->title = 'Замовлення';

?>

<h1>Замовлення</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID замовлення</th>
            <th>Користувач</th>
            <th>Сума</th>
            <th>Статус</th>
            <th>Створено</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($orders as $order): ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->username ?> (<?= $order->email ?>)</td>
                <td><?= $order->total_amount ?></td>
                <td><?= $order->status ?></td>
                <td><?= $order->created_at ?></td>
                <td>
                    <a href="/adminOrder/view/<?= $order->id ?>">View</a>
                </td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>
</div>


