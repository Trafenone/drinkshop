<?php

/** @var array $products */

$this->title = 'Адмін панель';
?>

<h1 class="text-center mt-1">Панель управління продуктами</h1>

<div class="row mt-2">
    <a href="/products/add" class="btn btn-outline-success btn-sm">Додати напій</a>
</div>

<table id="products-table" class="table table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Назва</th>
        <th>Опис</th>
        <th>Ціна</th>
        <th>Зображення</th>
        <th>Категорія</th>
        <th>Дії</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($products as $product) : ?>
        <?php
        $filePath = $product->image;
        if (!is_file($filePath)) {
            $filePath = '/project/wwwroot/uploads/no_image.jpg';
        } else {
            $filePath = '/' . $filePath;
        }
        ?>
        <tr>
            <td><?= $product->id ?></td>
            <td><?= $product->name ?></td>
            <td><?= $product->description ?></td>
            <td><?= $product->price ?></td>
            <td class="d-flex justify-content-center">
                <img class="object-fit-fill" src="<?= $filePath ?>" height="50" alt="Card image cap">
            </td>
            <td><?= $product->category_name ?></td>
            <td>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-secondary" href="/products/edit/<?= $product->id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-product-id="<?= $product->id ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Видалити?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ви впевнені, що хочете видалити цей елемент?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ні</button>
                <a class="btn btn-danger">Так, видалити</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script>
    $(document).ready(function () {
        $('#products-table').DataTable({
            stateSave: true
        });

        $('#products-table tbody').on('click', '.btn-delete', function () {
            let productId = $(this).data('product-id');
            let deleteModal = $('#deleteModal');

            deleteModal.find('.modal-footer .btn-danger').attr('href', '/products/delete/' + productId);

            deleteModal.modal('show');
        });
    })
</script>
