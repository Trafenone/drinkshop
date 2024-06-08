<?php
/** @var string $error_message */

$this->title = 'Вхід'
?>

<section class="py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <form method="post">
                            <div class="row gy-3 overflow-hidden">

                                <?php

                                if (!empty($error_message)) : ?>

                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $error_message ?>
                                        </div>
                                    </div>

                                <?php
                                endif; ?>

                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="name@example.com" required>
                                        <label for="email" class="form-label">Пошта</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" id="password"
                                               value="" placeholder="Password" required>
                                        <label for="password" class="form-label">Пароль</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" type="submit">Увійти</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
