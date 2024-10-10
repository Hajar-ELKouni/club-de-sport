<?php require_once __DIR__ . '/../config/app.php' ?>

<!DOCTYPE html>
<html>

<head>
  <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<div class="main-wrapper">
  <div class="content">
    <?php require_once __DIR__ . '/../partials/nav.php'; ?>
    <?php
    if (isset($_SESSION['user'])) :
      if ($_SESSION['user']->role === "user") {
        header("location:" . APP_URL . "/user/sports.php", true);
      } else if ($_SESSION['user']->role === "secretaire") {
        header("location:" . APP_URL . "/secretaire/demandes.php", true);
      } else if ($_SESSION['user']->role === "admin") {
        header("location:" . APP_URL . "/admin/demandes.php", true);
      }
    ?>
    <?php else : ?>

      <main>

        <div class="d-flex justify-content-center my-2 mt-5 pt-3 text-center">
          <div class="col-md-4">
            <?php include __DIR__ . '/partials/register-request.php' ?>
          </div>
        </div>

        <?php include __DIR__ . '/partials/register-old-values.php' ?>

        <div class="d-flex justify-content-center mb-5 pb-3">
          <div class="col-md-4 p-4 shadow">
            <h3 class="mb-3 text-center">S'inscrire</h3>
            <form method="POST">
              <?php include __DIR__ . '/partials/register-form.php' ?>
              <div class="form-group mb-3">
                <button type="submit" name="register" class="btn btn btn-dark btn-block w-100 w-full text-center">S'inscrire</button>
              </div>
              <p class="text-center">Vous avez déjà un compte? <a href="login.php" class="fw-bold"><span>Se connecter</span></a> </p>
            </form>
          </div>
        </div>
      </main>

    <?php endif; ?>
  </div>
  <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</div>
</div>
</body>

</html>