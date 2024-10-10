<?php require_once __DIR__ . '/../config/app.php' ?>

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

        <?php
        if (isset($_POST['contact'])) {

          $full_name = $_POST['full_name'];
          $email = $_POST['email'];
          $message = $_POST['message'];

          $errorArray = array();

          // Check required fields
          if (empty($full_name)) {
            $errorArray[] = "Le nom complet est required.";
          }
          if (empty($email)) {
            $errorArray[] = "L'adresse e-mail est required.";
          }
          if (empty($message)) {
            $errorArray[] = "Le message est required.";
          }

          // Check message length
          if (strlen($message) > 700) {
            $errorArray[] = "Le message dépasse la longueur maximale de 700 caractères.";
          }

          // Validate email
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorArray[] = "Veuillez fournir une adresse e-mail valide.";
          }

          // Check name length
          if (strlen($full_name) > 200) {
            $errorArray[] = "Le nom complet dépasse la longueur maximale de 200 caractères.";
          }

          if (empty($errorArray)) {
            $contactUs = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");

            $contactUs->bindValue(":name", $full_name);
            $contactUs->bindValue(":email", $email);
            $contactUs->bindValue(":message", $message);

            if ($contactUs->execute()) {
              $_POST['full_name'] = '';
              $_POST['email'] = '';
              $_POST['message'] = '';

              echo '<div class="alert alert-success py-2" role="alert">
              Merci pour votre message.
          </div>';
            } else {
              echo '<div class="alert alert-danger py-2" role="alert">
              Une erreur s\'est produite. Veuillez réessayer.
          </div>';
            }
          } else {
            // Display error messages
            echo '<div class="alert alert-danger py-2" role="alert">
          <ul class="m-0">';
            foreach ($errorArray as $error) {
              echo '<li class="fw-bold">' . $error . '</li>';
            }
            echo '</ul>
          </div>';
          }
        }
        ?>

        <?php
          $oldName = isset($_POST['full_name']) ? $_POST['full_name'] : '';
          $oldEmail = isset($_POST['email']) ? $_POST['email'] : '';
          $oldMessage = isset($_POST['message']) ? $_POST['message'] : '';
        ?>

        <header class="mb-5">
          <h3>Contact Page</h3>
          <p class="m-0 p-0 text-muted">L'équipe d'assistance est disponible 24 heures sur 24 et 7 jours sur 7 pour vous aider et répondre à toutes vos questions afin d'obtenir un plus grand succès.</p>
        </header>
        <form method="POST">
          <div class="form-group mb-3">
            <label for="full_name" class="form-label">Nom</label>
            <input type="text" name="full_name" placeholder="Nom" maxlength="255" class="form-control" id="full_name" value="<?= $oldName ?>" required />
          </div>

          <div class="form-group mb-3">
            <label for="inputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" placeholder="Email address" maxlength="255" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?= $oldEmail ?>" required />
          </div>

          <div class="form-group mb-3">
            <label for="message" class="form-label">Votre Message</label>
            <textarea name="message" class="form-control" placeholder="Votre Message ..." id="message" aria-describedby="message" style="max-height: 300px; min-height:150px;" required><?= $oldMessage ?></textarea>
          </div>

          <div class="form-group mb-3">
            <button type="submit" name="contact" class="btn btn btn-dark">Envoyer</button>
          </div>
        </form>
      </main>
    </div>
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>