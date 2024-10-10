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
        <?php if ($currentUrl[0] == APP_URL . '/secretaire/equipes.php'): ?>
            <a href="./equipes-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/secretaire/equipes-create.php' || ($currentUrl[0] == APP_URL . '/secretaire/equipes-edit.php')) : ?>
            <a href="./equipes.php" class="btn btn-sm btn-dark">Back</a>
        <?php elseif($currentUrl[0] == APP_URL . '/secretaire/coach.php'): ?>
            <a href="./coach-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif($currentUrl[0] == APP_URL . '/secretaire/coach-edit.php'):?>
            <a href="./coach.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif;?>
        <?php if ($currentUrl[0] == APP_URL . '/secretaire/announces.php') : ?>
            <a href="./announces-create.php" class="btn btn-sm btn-dark">Create</a>
        <?php elseif ($currentUrl[0] == APP_URL . '/secretaire/announces-create.php' || ($currentUrl[0] == APP_URL . '/secretaire/announces-edit.php')) : ?>
            <a href="./announces.php" class="btn btn-sm btn-dark">Back</a>
        <?php endif; ?>
    </div>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link <?= ($currentUrl[0] == APP_URL . '/secretaire/demandes.php') ? 'active' : '' ?>" href="<?= APP_URL . '/secretaire/demandes.php' ?>">Demandes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/secretaire/equipes.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/equipes-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/equipes-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/secretaire/equipes.php' ?>">Equipes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/secretaire/coach.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/coach-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/coach-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/secretaire/coach.php' ?>">Coach</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/secretaire/announces.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/announces-create.php') ||
                                    ($currentUrl[0] == APP_URL . '/secretaire/announces-edit.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/secretaire/announces.php' ?>">Announeces</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/pages/changer_mot_passe.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/pages/changer_mot_passe.php' ?>">Changer M.D.P 🔏</a>
        </li>
    </ul>
</header>