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
                        <?php
                        if (isset($_POST['login'])) {

                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $errorArray = array();

                            // Check required fields
                            if (empty($email)) {
                                $errorArray[] = "L'adresse e-mail est required.";
                            }
                            if (empty($password)) {
                                $errorArray[] = "Le password est required.";
                            }

                            // Check L'adresse e-mail length
                            if (strlen($email) > 200) {
                                $errorArray[] = "L'adresse e-mail dépasse la longueur maximale de 200 caractères.";
                            }

                            // Validate email
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errorArray[] = "Veuillez fournir une adresse e-mail valide.";
                            }

                            if (empty($errorArray)) {
                                $register = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

                                $register->bindValue("email", $_POST['email']);
                                $passwordUser = sha1($_POST['password']);
                                $register->bindValue("password", $passwordUser);

                                $register->execute();

                                if ($register->rowCount() === 1) {
                                    $user = $register->fetchObject();
                                    $_SESSION['user'] = $user;
                                    $_SESSION['user']->name = $user->nom . ' ' . $user->prenom;

                                    if ($user->role === "user") {
                                         if($user->changed_password === 1)
                                        header("location:" . APP_URL . "/pages/changer_mot_passe.php", true);
                                        else 
                                        header("location:" . APP_URL . "/user/sports.php", true);
                                    } else if ($user->role === "admin") {
                                        header("location:" . APP_URL . "/admin/demandes.php", true);
                                    } else if ($user->role === "secretaire") {
                                        if($user->changed_password === 1)
                                        header("location:" . APP_URL . "/pages/changer_mot_passe.php", true);
                                        else
                                        header("location:" . APP_URL . "/secretaire/demandes.php",true);
                                    } else if ($user->role === "coach") {
                                        if($user->changed_password === 1)
                                        header("location:" . APP_URL . "/pages/changer_mot_passe.php", true);
                                        else 
                                        header("location:" . APP_URL . "/coach/equipes.php", true);
                                    }


                                    $_POST['email'] = '';
                                    $_POST['password'] = '';
                                } else {
                                    echo '<div class="alert alert-danger py-2" role="alert">Email ou mot de passe incorrect</div>';
                                }
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
                    </div>
                </div>

                <?php $oldEmail = isset($_POST['email']) ? $_POST['email'] : ''; ?>
                <div class="d-flex justify-content-center mb-5 pb-3 text-center">
                    <div class="col-md-4 p-4 shadow">
                        <h3 class="mb-3">Se connecter</h3>
                        <form method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" placeholder="Email address" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?= $oldEmail ?>" maxlength="200" required />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock-fill"></i></span>
                                <input type="password" name="password" placeholder="Password" class="form-control" id="inputPassword1" maxlength="200" required />
                            </div>
                            <div class="form-group mb-3 d-flex justify-content-start gap-2">
                                <input type="checkbox" class="form-check-input" id="inputCheck">
                                <label class="form-check-label" for="inputCheck">Souviens-toi de moi</label>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="login" class="btn btn-dark w-100 w-full block">Se connecter</button>
                            </div>
                            <p class="p-0 m-0">Vous n'avez pas de compte? <a href="register.php" class="fw-bold"><span>S'inscrire</span></a></p>
                            <p class="p-0 m-0">Mot de passe oublie? <a href="<?=APP_URL;?>/pages/contact.php" class="fw-bold"><span>Contactez l'admin</span></a></p>
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
