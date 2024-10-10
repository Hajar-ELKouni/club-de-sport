<style>
    .nav-tabs .nav-link {
        color: #737373 !important;
    }

    .nav-tabs .nav-link.active {
        color: black !important;
        font-weight: 600;
    }
</style>

<?php $currentUrl = explode("?", $_SERVER['REQUEST_URI']); ?>

<header>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <p class="text-left fs-5"> Bienvenue <span class="fw-bold"><?= $user->name ?></span></p>
        <?php if ($currentUrl[0] == APP_URL . '/admin/equipes.php') : ?>
            <a href="./equipes-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/admin/equipes-create.php' || ($currentUrl[0] == APP_URL . '/admin/equipes-edit.php')) : ?>
            <a href="./equipes.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif; ?>

        <?php if ($currentUrl[0] == APP_URL . '/admin/secretaires.php') : ?>
            <a href="./secretaires-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/admin/secretaires-create.php') : ?>
            <a href="./secretaires.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif; ?>

        <?php if ($currentUrl[0] == APP_URL . '/admin/announces.php') : ?>
            <a href="./announces-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/admin/announces-create.php' || ($currentUrl[0] == APP_URL . '/admin/announces-edit.php')) : ?>
            <a href="./announces.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif; ?>

        <?php if ($currentUrl[0] == APP_URL . '/admin/coach.php') : ?>
            <a href="./coach-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/admin/coach-create.php' || ($currentUrl[0] == APP_URL . '/admin/coach-edit.php')) : ?>
            <a href="./coach.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif; ?>
    </div>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link <?= ($currentUrl[0] == APP_URL . '/admin/demandes.php') ? 'active' : '' ?>" href="<?= APP_URL . '/admin/demandes.php' ?>">Demandes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/equipes.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/equipes-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/equipes-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/equipes.php' ?>">Equipes</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/secretaires.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/secretaires-create.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/secretaires.php' ?>">Secretaires</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/announces.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/announces-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/announces-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/announces.php' ?>">Announeces</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/coach.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/coach-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/coach-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/coach.php' ?>">Coach</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/users.php') ||
                                    ($currentUrl[0] == APP_URL . '/admin/users-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/users.php' ?>">Users</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/admin/contacts.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/admin/contacts.php' ?>">Contacts</a>
        </li>
        
    </ul>
</header>