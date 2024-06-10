<?php

/** @var array $user */
$this->title = 'Профіль користувач'
?>

<div class="container mt-4">
    <h1>Профіль користувача</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4><?= htmlspecialchars($user->username) ?></h4>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?= htmlspecialchars($user->email) ?></p>
                    <p><strong>Адміністратор:</strong> <?= $user->isAdmin ? 'Так' : 'Ні' ?></p>
                    <p><strong>Зареєстрований:</strong> <?= htmlspecialchars($user->created_at) ?></p>
                    <p><strong>Останнє оновлення:</strong> <?= htmlspecialchars($user->updated_at) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
