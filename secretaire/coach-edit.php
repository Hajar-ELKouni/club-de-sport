<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php
if (isset($_GET['coach'])) {
    $selectedCoachId = (int) $_GET['coach'];
} else {
    header("location: " . APP_URL . "/secretaire/coach.php", true);
    exit();
}

if (!is_int($selectedCoachId)) {
    header("location: " . APP_URL . "/secretaire/coach.php", true);
    exit();
}

$coach = $coachObj->getCoachById($selectedCoachId);

if (!$coach) {
    header("location: " . APP_URL . "/secretaire/coach.php", true);
    exit();
}


?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['create'])) {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $date_naissance = $_POST['date_naissance'];
                    $gender = $_POST['gender'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $bio = $_POST['bio'];
                    $role = 'coach';

                    $errorArray = array();

                    // Check required fields
                    if (empty($nom) || is_null($nom)) {
                        $errorArray[] = "Le nom est required.";
                    }
                    if (empty($prenom) || is_null($prenom)) {
                        $errorArray[] = "Le prénom est required.";
                    }
                    if (empty($date_naissance) || is_null($date_naissance)) {
                        $errorArray[] = "La date de naissance est required.";
                    }
                    if (empty($gender) || is_null($gender)) {
                        $errorArray[] = "Le gender est required.";
                    }
                    if (empty($bio) || is_null($bio)) {
                        $errorArray[] = "La biographie est required.";
                    }
                    if (empty($email) || is_null($email)) {
                        $errorArray[] = "L'adresse e-mail est required.";
                    }

                    if (empty($password) || is_null($password)) {
                        $password = $_POST['oldPassword'];
                    } else {
                        $password = sha1($_POST['password']);
                    }

                    // Check length
                    if (strlen($nom) > 200) {
                        $errorArray[] = "Le nom dépasse la longueur maximale de 200 caractères.";
                    }
                    if (strlen($prenom) > 200) {
                        $errorArray[] = "Le prenom dépasse la longueur maximale de 200 caractères.";
                    }
                    if (strlen($email) > 200) {
                        $errorArray[] = "L'adresse e-mail dépasse la longueur maximale de 200 caractères.";
                    }

                    if (strlen($password) > 200) {
                        $errorArray[] = "Le password dépasse la longueur maximale de 200 caractères.";
                    }

                    if (!in_array($gender, ['homme', 'femme'])) {
                        $errorArray[] = "gender incorrect";
                    }

                    // Validate email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorArray[] = "Veuillez fournir une adresse e-mail valide.";
                    }

                    // Validate age
                    $birthdateObj = new DateTime($date_naissance);
                    $currentDate = new DateTime();
                    $age = $birthdateObj->diff($currentDate)->y;

                    if ($age < 18) {
                        $errorArray[] = "L'âge doit être supérieur à 18 ans";
                    }

                    if (empty($errorArray)) {

                        $updateCoach = $conn->prepare("UPDATE users SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, gender = :gender, email = :email, password = :password, bio = :bio, role = :role WHERE id = :id");

                        $updateCoach->bindValue("nom", $nom);
                        $updateCoach->bindValue("prenom", $prenom);
                        $updateCoach->bindValue("date_naissance", $date_naissance);
                        $updateCoach->bindValue("gender", $gender);
                        $updateCoach->bindValue("email", $email);
                        $updateCoach->bindValue("password", $password);
                        $updateCoach->bindValue("bio", $bio);
                        $updateCoach->bindValue("role", $role);
                        $updateCoach->bindValue("id", $selectedCoachId);

                        if ($updateCoach->execute()) {
                            $_POST['nom'] = '';
                            $_POST['prenom'] = '';
                            $_POST['date_naissance'] = '';
                            $_POST['gender'] = '';
                            $_POST['email'] = '';
                            $_POST['password'] = '';
                            $_POST['bio'] = '';

                            echo '<div class="alert alert-success py-2" role="alert">
                            Vote Coach a été modifié avec succès
                            </div>';
                        } else {
                            echo '<div class="alert alert-danger py-2" role="alert">
                            Something went Wrong | Error 500
                        </div>';
                        };
                    } else {
                        // Display error messages
                        echo '<div class="alert alert-danger py-2" role="alert"><ul class="m-0 list-unstyled">';
                        foreach ($errorArray as $error) {
                            echo '<li class="fw-bold">• ' . $error . '</li>';
                        }
                        echo '</ul></div>';
                    }
                }

                ?>

                <?php
                $oldNom = isset($_POST['nom']) ? $_POST['nom'] : $coach->nom;
                $oldPrenom = isset($_POST['prenom']) ? $_POST['prenom'] : $coach->prenom;
                $oldDateNaissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : $coach->date_naissance;
                $oldEmail = isset($_POST['email']) ? $_POST['email'] : $coach->email;
                $oldBio = isset($_POST['bio']) ? $_POST['bio'] : $coach->bio;

                ?>

                <form class="form" method="POST">
                    <div class="input-group mb-3">
                        <span for="" class="input-group-text">Nom Complete</span>
                        <input type="text" name="nom" placeholder="Nom" class="form-control" id="first_name" value="<?= $oldNom ?>" maxlength="200" required aria-label="first-name" />
                        <input type="text" name="prenom" placeholder="Prenom" class="form-control" id="last_name" value="<?= $oldPrenom ?>" maxlength="200" required aria-label="last-name" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_naissance" class="form-label">Date de Naissance</label>
                        <input type="date" name="date_naissance" class="form-control" id="date_naissance" value="<?= $oldDateNaissance ?>" required />
                    </div>

                    <div class="form-group d-flex gap-3 mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="homme" value="homme" <?= (isset($_POST['gender']) && $_POST['gender'] == 'homme') ? 'checked' : ''; ?> checked required />
                            <label class="form-check-label" for="homme">
                                Homme
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="femme" value="femme" <?= (isset($_POST['gender']) && $_POST['gender'] == 'femme') ? 'checked' : ''; ?> required />
                            <label class="form-check-label" for="femme">
                                Femme
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" placeholder="Email address" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?= $oldEmail ?>" maxlength="200" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio" class="form-label">La biographie</label>
                        <textarea name="bio" id="bio" class="form-control" cols="30" rows="10"><?= $oldBio ?></textarea>
                    </div>


                    <div class="form-group mb-3">
                        <label for="inputPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="password" maxlength="255" placeholder="Mot de passe (Laissez vide si vous ne l'avez pas changer) " class="form-control" id="inputPassword"  />
                        <input type="hidden" name="oldPassword" value="<?=$coach->password;?>">
                    </div>


                    <div class="form-group mb-3">
                        <button type="submit" name="create" class="btn btn btn-dark">Update</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>