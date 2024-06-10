<?php
/** @var array $products */
/** @var array $categories */
/** @var int $currentPage */
/** @var int $totalPages */
/** @var string $searchQuery */
/** @var int $selectedCategoryId */
/** @var array $cart */

$this->title = 'Напої';

?>

<div class="container mt-4">
    <h1>Продукти</h1>

    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Всі категорії</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>" <?= $category->id == $selectedCategoryId ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Пошук..." value="<?= htmlspecialchars($searchQuery) ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    <div class="products row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-4  g-3 mt-1">
        <?php
        foreach ($products as $product) : ?>
            <div class="col">
                <div class="card shadow-sm">
                    <?php
                    $isInCart = isset($cart[$product->id]);
                    $filePath = $product->image;
                    if ($filePath == null || !is_file($filePath)) {
                        $filePath = '/project/wwwroot/uploads/no_image.jpg';
                    } else {
                        $filePath = '/' . $filePath;
                    }
                    ?>
                    <img class="card-img-top object-fit-fill" src="<?= $filePath ?>" height="200" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?= $product->name ?></h5>
                        <p class="card-text"><?= $product->description ?> </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/products/view/<?= $product->id ?>"
                                   class="btn btn-sm btn-outline-secondary">Детальніше</a>
                                <button class="btn btn-sm btn-outline-secondary btn-add-to-cart"
                                        data-product-id="<?= $product->id ?>" <?= $isInCart ? 'disabled' : '' ?> >
                                    <?= $isInCart ? 'В кошику' : 'В кошик' ?>
                                </button>
                            </div>
                            <small class="text-body-secondary"><?= $product->price ?> ₴</small>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>

    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                    <a class="page-link" href="/products/index?page=<?= $i ?>&category=<?= $selectedCategoryId ?>&search=<?= htmlspecialchars($searchQuery) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');

                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({productId: productId, quantity: 1})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.setAttribute('disabled', true);
                            this.textContent = 'В кошику';
                        } else {
                            alert('Failed to add product to cart: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>