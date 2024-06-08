<?php
/** @var array $products */

$this->title = 'Напої';

?>

<div class="row mt-2">
    <a href="/products/add" class="btn btn-outline-success btn-sm">Додати напій</a>
</div>

<div class="products row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-1">
    <?php
    foreach ($products as $product) : ?>
        <div class="col">
            <div class="card shadow-sm">
                <?php
                $filePath = $product->image;
                if (!is_file($filePath)) {
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
                            <button type="button" class="btn btn-sm btn-outline-secondary">Додати у кошик</button>
                        </div>
                        <small class="text-body-secondary"><?= $product->price ?>$</small>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>
</div>