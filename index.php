<?php require_once __DIR__ . '/config/app.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <?php require_once __DIR__ . '/partials/head.php'; ?>
</head>

<body>
  <div class="main-wrapper">
    <div class="content">
      <?php include __DIR__ . '/partials/nav.php'; ?>

      <?php include __DIR__ . '/home/slider.php'; ?>

      <section class="text-center my-5">
        <?php include __DIR__ . '/home/about.php'; ?>
      </section>

      <section class="text-center my-5">
        <h1>Sports</h1>
        <p class="text-muted"></p>
        <a href="<?= APP_URL . '/pages/sports.php' ?>" class="btn btn-dark btn-sm px-3 my-2">Voir plus de details</a>
        <?php include __DIR__ . '/home/sports.php'; ?>
      </section>

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
  </div>
</body>

</html>