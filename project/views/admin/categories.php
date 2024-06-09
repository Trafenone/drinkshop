<?php

/** @var array $categories */

$this->title = 'Адмін панель';

?>

<h1 class="text-center mt-1">Панель управління категоріями</h1>

<div class="row mt-2">
    <a href="/categories/add" class="btn btn-outline-success btn-sm">Створити нову категорію</a>
</div>

<table id="categories-table" class="table table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Назва</th>
        <th>Дії</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($categories as $category) : ?>
        <tr>
            <td><?= $category->id ?></td>
            <td><?= $category->name ?></td>
            <td>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-secondary" href="/categories/edit/<?= $category->id ?>">
                        <i class="bi bi-pen"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-category-id="<?= $category->id ?>">
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
                <p>Ви впевнені, що хочете видалити цю категорію?</p>
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
        $('#categories-table').DataTable({
            stateSave: true
        });

        $('#categories-table tbody').on('click', '.btn-delete', function () {
            let categoryId = $(this).data('category-id');
            let deleteModal = $('#deleteModal');

            deleteModal.find('.modal-footer .btn-danger').attr('href', '/categories/delete/' + categoryId);

            deleteModal.modal('show');
        });
    })

</script>
