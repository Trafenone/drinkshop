<?php
/** @var array $cart */
/** @var array $products */

$this->title = 'Оформлення замовлення';
$totalAmount = 0;
?>

<div class="container mt-4">
    <h1>Оформлення замовлення</h1>
    <form method="post">
        <div class="row">
            <div class="col-md-8">
                <h4>Ваші товари</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Зображення</th>
                        <th>Назва</th>
                        <th>Ціна</th>
                        <th>Кількість</th>
                        <th>Сума</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $productId => $quantity): ?>
                        <?php
                        $product = $products[$productId];
                        $totalAmount += $product->price * $quantity;
                        $filePath = $product->image;
                        if ($filePath == null || !is_file($filePath)) {
                            $filePath = '/project/wwwroot/uploads/no_image.jpg';
                        } else {
                            $filePath = '/' . $filePath;
                        }
                        ?>
                        <tr>
                            <td><img src="<?= $filePath ?>" height="50" alt="<?= $product->name ?>"></td>
                            <td><?= $product->name ?></td>
                            <td><?= $product->price ?>$</td>
                            <td><?= $quantity ?></td>
                            <td><?= $product->price * $quantity ?>$</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <h3>Загальна сума: <?= $totalAmount ?>$</h3>
            </div>
            <div class="col-md-4">
                <h4>Ваші дані</h4>
                <div class="form-group mb-3">
                    <label for="name">Ім'я:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Адреса:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Телефон:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <button type="submit" class="btn btn-primary">Оформити замовлення</button>
            </div>
        </div>
    </form>
</div>
