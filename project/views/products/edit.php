<?php

/** @var object $product */

/** @var array $categories */

$this->title = 'Редагування напою';

$filePath = $product->image;
if (!is_file($filePath)) {
    $filePath = '/project/wwwroot/uploads/no_image.jpg';
} else {
    $filePath = '/' . $filePath;
}

?>

<h1 class="text-center mt-1">Редагування продукту</h1>

<form id="category" method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Напій</label>
        <input value="<?= $product->name ?>" name="name" type="text" class="form-control" id="name"
               placeholder="Назва напою">
    </div>
    <div class="mb-3">
        <label for="description">Опис</label>
        <textarea name="description" class="form-control" id="description"
                  rows="3"><?= $product->description ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price">Ціна</label>
        <input value="<?= $product->price ?>" name="price" type="number" class="form-control" id="price" step="any">
    </div>

    <div class="col-4">
        <img src="<?= $filePath ?>" class="img-fluid rounded" alt="Image">
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Фото</label>
        <input name="image" class="form-control" type="file" id="image" accept="image/png, image/jpg, image/jpeg">
    </div>
    <div class="mb-3">
        <label for="category_id">Категорія напою</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php
            foreach ($categories as $category) : ?>
                <?php
                if ($category->id == $product->category_id) : ?>
                    <option selected value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php
                else: ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
        </select>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-success">Зберегти</button>
    </div>
    <div class="row mt-2">
        <a href="/admin/products" class="btn btn-secondary">Повернутися назад</a>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $("#category").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            description: {
                required: true,
                minlength: 5
            },
            price: {
                required: true,
                number: true,
                min: 0.01
            },
            category_id: {
                required: true,
                min: 1
            }
        },
        messages: {
            name: {
                required: "Назва товару обов'язкове поле",
                minlength: jQuery.validator.format("Довжина повинна бути {0} або більше")
            },
            description: {
                required: "Опис товару обов'язкове поле",
                minlength: jQuery.validator.format("Довжина повинна бути {0} або більше")
            },
            price: {
                required: "Ціна обов'язкове поле",
                minlength: jQuery.validator.format("Довжина повинна бути {0} або більше"),
                number: "Ціна повинна бути числом",
                min: "Мінімальна ціна - 0.01"
            },
            category_id: {
                required: "Обов'язкове поле",
                min: "Оберіть категорію товару"
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
</script>
