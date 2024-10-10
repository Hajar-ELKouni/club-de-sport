<?php include __DIR__ . '/partials/check-user.php'; ?>

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
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['create'])) {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $date_naissance = $_POST['date_naissance'];
                    $gender = $_POST['gender'];
                    $email = $_POST['email'];
                    $bio = $_POST['bio'];
                    $password = $_POST['password'];
                    $password_confirmation = $_POST['password_confirmation'];
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
                    if (empty($email) || is_null($email)) {
                        $errorArray[] = "L'adresse e-mail est required.";
                    }
                    if (empty($bio) || is_null($bio)) {
                        $errorArray[] = "La biographie est required.";
                    }
                    if (empty($password) || is_null($password)) {
                        $errorArray[] = "Le mot de passe est required.";
                    }
                    if (empty($password_confirmation) || is_null($password_confirmation)) {
                        $errorArray[] = "La confirmation du mot de passe est required.";
                    }

                    // Validate age
                    function validateAge($then)
                    {
                        $then = strtotime($then);

                        $min = strtotime('+18 years', $then);

                        if(time() < $min) return false;

                        return true;
                    }

                    if (validateAge($date_naissance) === false) {
                        $errorArray[] = "L'âge doit être supérieur à 18 ans";
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

                    if (strlen($password_confirmation) > 200) {
                        $errorArray[] = "Le password de confirmation dépasse la longueur maximale de 200 caractères.";
                    }

                    if (!in_array($gender, ['homme', 'femme'])) {
                        $errorArray[] = "gender incorrect";
                    }

                    // Validate email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorArray[] = "Veuillez fournir une adresse e-mail valide.";
                    }

                    if ($password_confirmation !== $password) {
                        $errorArray[] = "Le mot de passe ne correspond pas";
                    }

                    if (empty($errorArray)) {

                        $password = sha1($_POST['password']);

                        $createEquipe = $conn->prepare("INSERT INTO users(nom, prenom, date_naissance, gender, email, password, bio, role) VALUES(:nom, :prenom, :date_naissance, :gender, :email, :password, :bio, :role)");

                        $createEquipe->bindValue("nom", $nom);
                        $createEquipe->bindValue("prenom", $prenom);
                        $createEquipe->bindValue("date_naissance", $date_naissance);
                        $createEquipe->bindValue("gender", $gender);
                        $createEquipe->bindValue("email", $email);
                        $createEquipe->bindValue("password", $password);
                        $createEquipe->bindValue("bio", $bio);
                        $createEquipe->bindValue("role", $role);

                        if ($createEquipe->execute()) {
                            $_POST['nom'] = '';
                            $_POST['prenom'] = '';
                            $_POST['date_naissance'] = '';
                            $_POST['gender'] = '';
                            $_POST['email'] = '';
                            $_POST['password'] = '';
                            $_POST['bio'] = '';

                            echo '<div class="alert alert-success py-2" role="alert">
                            Vote Coach a été créé avec succès
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
                $oldNom = isset($_POST['nom']) ? $_POST['nom'] : '';
                $oldPrenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
                $oldDateNaissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
                $oldEmail = isset($_POST['email']) ? $_POST['email'] : '';
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
                        <textarea name="bio" id="bio" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="password" maxlength="255" placeholder="Mot de passe" class="form-control" id="inputPassword" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le Mot de passe</label>
                        <input type="password" name="password_confirmation" maxlength="255" placeholder="Confirmer Mot de passe" class="form-control" id="password_confirmation" required />
                    </div>


                    <div class="form-group mb-3">
                        <button type="submit" name="create" class="btn btn btn-dark">Create</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>