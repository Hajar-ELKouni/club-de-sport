<nav class="navbar navbar-expand-lg navbar-ligth bg-ligth shadow-sm">
  <div class="container md:row d-md-flex justify-content-between">
    <div class="col-md-4">
      <a class="navbar-brand text-uppercase fw-bold" href="<?= APP_URL . '/index.php' ?>">
        <span class="text-dark">TETOUAN</span><span class="text-warning">SPORT</span>
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse col-md-4" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL . '/index.php' ?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL . '/pages/about.php' ?>">A propos</a>
        </li>
        <?php if (isset($_SESSION['user']) AND $_SESSION['user']->role === 'user') : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= APP_URL . '/pages/sports.php' ?>">Sports</a>
          </li>
        <?php else:?>
          <li class="nav-item">
            <a class="nav-link" href="<?= APP_URL . '/pages/sports.php' ?>">Sports</a>
          </li>
        <?php endif;?>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL . '/pages/contact.php' ?>">Contact</a>
        </li>
        
      </ul>
    </div>

    <div class="collapse navbar-collapse col-md-4 d-md-flex justify-content-end" id="navbarNav">
      <ul class="navbar-nav mr-auto mt-lg-0">
        <?php if (isset($_SESSION['user'])) : ?>
          <li class="nav-item">
            <a href="" class="nav-link"> <span class="fw-bold text-truncate"><?= $_SESSION['user']->name ?></span></a>
          </li>
          <li class="nav-item">
          <div class="dropdown h-100">
            <button class="btn btn-warning dropdown-toggle py-1 h-100" type="button" data-toggle="dropdown">
              <i class="bi bi-person-fill"></i>
            </button>
            <ul class="dropdown-menu">
              <?php /* CONDITION SUR LES ROLES */ ?>
              <?php if($_SESSION['user']->role === 'admin'){?>
                <li><a href="<?= APP_URL . '/admin/demandes.php' ?>">Tableau de bord</a></li>
                
              
              <?php }else if($_SESSION['user']->role === 'user'){ ?>
                <li><a href="<?= APP_URL . '/user/sports.php' ?>">Mes demandes</a></li>
                <li><a href="<?= APP_URL . '/pages/changer_mot_passe.php' ?>">Changer M.D.P.</a></li>
                
              <?php }else if($_SESSION['user']->role === 'secretaire'){ ?>
                <li><a href="<?= APP_URL . '/secretaire/demandes.php' ?>">Tableau de bord</a></li>
                <li><a href="<?= APP_URL . '/pages/changer_mot_passe.php' ?>">Changer M.D.P.</a></li>

              <?php }else{ ?>
                <li><a href="<?= APP_URL . '/coach/equipes.php' ?>">Mes équipes</a></li>
                <li><a href="<?= APP_URL . '/pages/changer_mot_passe.php' ?>">Changer M.D.P.</a></li>
              
              <?php } ?>
              

            </ul>
          </div>
          </li>
          <li class="nav-item">
            <form method="POST" class="h-100"> <button class='btn btn-sm btn-warning mx-md-1 h-100' type='submit' name='logout'>Logout</button></form>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="btn btn-sm btn-warning my-1 mx-md-1" href="<?= APP_URL . '/auth/login.php' ?>">S'authentifier</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-warning my-1 mx-md-1" href="<?= APP_URL . '/auth/register.php' ?>">S'inscrire</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: " . APP_URL . "/auth/login.php", true);
}
?>