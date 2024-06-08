<?php

/** @var array $categories */

$this->title = 'Додавання нового напою';

?>

<h1 class="text-center mt-1">Додавання нового напою</h1>

<form id="category" method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Напій</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Назва напою">
    </div>
    <div class="mb-3">
        <label for="description">Опис</label>
        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="price">Ціна</label>
        <input name="price" type="number" class="form-control" id="price" step="any">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Фото</label>
        <input name="image" class="form-control" type="file" id="image" accept="image/png, image/jpg, image/jpeg" >
    </div>
    <div class="mb-3">
        <label for="category_id">Категорія напою</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php
            foreach ($categories as $category) : ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php
            endforeach; ?>
        </select>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-success">Додати</button>
    </div>
    <div class="row mt-2">
        <a href="/products/index" class="btn btn-secondary">Повернутися назад</a>
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
            image: {
                required: true,
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
            image: {
                required: "Має бути завантажене зображення",
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