<?php
/** @var array $cart */

/** @var array $products */

$this->title = 'Корзина';
$totalPrice = 0;
?>

<div class="container mt-4">
    <h1>Ваш кошик</h1>
    <?php
    if (empty($cart)): ?>
        <p>Ваш кошик порожній.</p>
    <?php
    else: ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Зображення</th>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Сума</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($cart as $productId => $quantity): ?>
                <?php
                $product = $products[$productId];
                $totalPrice += $product->price * $quantity;
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
                    <td>
                        <form class="update-quantity-form d-flex" data-product-id="<?= $product->id ?>">
                            <input type="number" class="form-control w-50 me-2" name="quantity" value="<?= $quantity ?>"
                                   min="1">
                            <button type="submit" class="btn btn-sm btn-primary">Оновити</button>
                        </form>
                    </td>
                    <td><?= $product->price * $quantity ?>$</td>
                    <td>
                        <form class="remove-item-form" data-product-id="<?= $product->id ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
        <div class="row justify-content-around">
            <h3 class="col-auto">Загальна сума: <?= $totalPrice ?>₴</h3>
            <a class="btn btn-outline-success col-auto" href="/cart/checkout">Оформити замовлення</a>
        </div>
    <?php
    endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.update-quantity-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                let productId = form.dataset.productId;
                let quantity = form.querySelector('input[name="quantity"]').value;

                fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({productId, quantity})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to update cart: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.remove-item-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                let productId = form.dataset.productId;

                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({productId})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to remove item from cart: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
