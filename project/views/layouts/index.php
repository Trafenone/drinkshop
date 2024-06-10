<?php
/** @var string $title */

/** @var string $content */

use project\models\User;

if (empty($title)) {
    $title = '';
}

if (empty($content)) {
    $content = '';
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/project/wwwroot/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>
<body>
<header class="p-3 text-bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
        <div class="container">
            <a class="navbar-brand" href="/home">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
                    aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/index" aria-disabled="true">Продукти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/news/index">Новини</a>
                    </li>
                    <?php if(User::isAdmin()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Адмінка</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/admin/products">Продукти</a></li>
                                <li><a class="dropdown-item" href="/admin/categories">Категорії</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="text-end">
                    <a href="/cart/index" class="btn btn-outline-info me-2">
                        <i class="bi bi-basket"></i> Корзина
                    </a>
                </div>

                <?php
                if (!User::isUserLogged()) : ?>

                    <div class="text-end">
                        <button onclick="location.href = '/users/login'" type="button"
                                class="btn btn-outline-light me-1">
                            <i class="bi bi-box-arrow-in-right"></i> Увійти
                        </button>
                        <button onclick="location.href = '/users/register'" type="button" class="btn btn-warning">
                            <i class="bi bi-person-add"></i> Зареєструватися
                        </button>
                    </div>

                <?php
                else: ?>

                    <div class="text-end">
                        <button type="button" class="btn btn-outline-warning me-2">
                            <i class="bi bi-person-circle"></i> Профіль
                        </button>
                        <button onclick="location.href = '/users/logout'" type="button"
                                class="btn btn-outline-light me-2">
                            <i class="bi bi-box-arrow-left"></i> Вийти
                        </button>
                    </div>

                <?php
                endif ?>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <?= $content ?>
</main>

<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>
    <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>