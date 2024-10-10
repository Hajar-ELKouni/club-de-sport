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
    </div>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link <?= ($currentUrl[0] == APP_URL . '/coach/equipes.php') ? 'active' : '' ?>" href="<?= APP_URL . '/coach/equipes.php' ?>">Vos Equipes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($currentUrl[0] == APP_URL . '/coach/tous-equipes.php') ? 'active' : '' ?>" href="<?= APP_URL . '/coach/tous-equipes.php' ?>">Equipes En Attente</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (
                                    ($currentUrl[0] == APP_URL . '/pages/changer_mot_passe.php')
                                ) ? 'active' : '' ?>" href="<?= APP_URL . '/pages/changer_mot_passe.php' ?>">Changer M.D.P 🔏</a>
        </li>
    </ul>
</header>