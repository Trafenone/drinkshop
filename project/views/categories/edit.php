<?php

/** @var string $error_message */
/** @var object $category */

$this->title = 'Редагування категорії';

?>

<h1 class="text-center mt-1">Редагування категорії</h1>

<form id="category" method="post" action="">
    <?php

    if (!empty($error_message)) : ?>

        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $error_message ?>
            </div>
        </div>

    <?php
    endif; ?>

    <div class="mb-3">
        <label for="name">Категорія</label>
        <input value="<?= $category->name ?>" name="name" type="text" class="form-control" id="name" placeholder="Назва категорії" required>
    </div>

    <div class="row">
        <button type="submit" class="btn btn-success">Зберегти</button>
    </div>

    <div class="row mt-2">
        <a href="/admin/categories" class="btn btn-secondary">Повернутися назад</a>
    </div>
</form>
