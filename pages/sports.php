<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../Models/Equipe.php';
require_once __DIR__ . '/../Models/Sport.php';
require_once __DIR__ . '/../Models/Demande.php';
require_once __DIR__ . '/../Models/Coach.php';
require_once __DIR__ . '/../Models/Announce.php';

$equipeObj = new Equipe($conn);
$sportObj = new Sport($conn);
$demandeObj = new Demande($conn);
$coachObj = new Coach($conn);
$announceObj = new Announce($conn);

?>

<!DOCTYPE html>
<html>

<head>
  <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>
<body>
  <div class="main-wrapper">
    <div class="content">
      <?php require_once __DIR__ . '/../partials/nav.php'; ?>
      <main class="container py-5">

        <header>
          <h3 class="fw-bold text-dark">Tous les sports</h3>
        </header>
        <section class="my-3">
          <?php $sports = $sportObj->getAllSports(); ?>
          <?php if (empty($sports)) : ?>
            <div class="alert alert-info fs-3 text-center" role="alert">Aucune sport disponible.</div>
          <?php else : ?>
            <?php foreach ($sports as $sport) : ?>
              <a href="<?=APP_URL;?>/user/equipes.php?sport=<?= $sport->id ?>" class="text-decoration-none text-dark">
                <div class="d-flex gap-3 position-relative my-5 p-3 border border-2 rounded sport-card">
                  <img src="<?= $sport->image ?>" class="flex-shrink-0 me-3" width="250" height="120" alt="<?= $sport->title ?>">
                  <div>
                    <h5 class="mt-0"><?= ucwords($sport->title); ?></h5>
                    <p><?= $sport->description; ?></p>
                    <a href="<?=APP_URL;?>/user/equipes.php?sport=<?= $sport->id ?>" class="btn btn-sm btn-dark my-2">Choisir</a>
                  </div>
                </div>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </section>
      </main>
    </div>
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
  </div>
  </div>
</body>
</html>