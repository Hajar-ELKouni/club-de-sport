<?php
if (isset($_POST['register'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_naissance = $_POST['date_naissance'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    $errorArray = array();

    // Check required fields
    if (empty($first_name) || is_null($first_name)) {
        $errorArray[] = "Le nom est required.";
    }
    if (empty($last_name) || is_null($last_name)) {
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
    if (empty($password) || is_null($password)) {
        $errorArray[] = "Le mot de passe est required.";
    }
    if (empty($password_confirmation) || is_null($password_confirmation)) {
        $errorArray[] = "La confirmation du mot de passe est required.";
    }

    // Check length
    if (strlen($first_name) > 200) {
        $errorArray[] = "Le nom dépasse la longueur maximale de 200 caractères.";
    }
    if (strlen($last_name) > 200) {
        $errorArray[] = "Le prenom dépasse la longueur maximale de 200 caractères.";
    }
    if (strlen($email) > 200) {
        $errorArray[] = "L'adresse e-mail dépasse la longueur maximale de 200 caractères.";
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

    if (strlen($password) > 200) {
        $errorArray[] = "Le password dépasse la longueur maximale de 200 caractères.";
    }
    if (strlen($password_confirmation) > 200) {
        $errorArray[] = "Le password de confirmation dépasse la longueur maximale de 200 caractères.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorArray[] = "Veuillez fournir une adresse e-mail valide.";
    }

    if (!in_array($gender, ['homme', 'femme'])) {
        $errorArray[] = "gender incorrect";
    }

    if ($password_confirmation !== $password) {
        $errorArray[] = "Le mot de passe ne correspond pas";
    }

    $register = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $register->bindValue("email", $_POST['email']);
    $register->execute();

    if ($register->rowCount() > 0) {
        $errorArray[] = "Cette adresse e-mail est déjà utilisée, veuillez choisir une autre";
    }

    if (empty($errorArray)) {
        $password = sha1($_POST['password']);
        $addUser = $conn->prepare("INSERT INTO
                users(nom,prenom,date_naissance,gender,email,password,changed_password ,role)
                VALUES(:nom,:prenom,:date_naissance,:gender,:email,:password,:changed_password,:role)");

        $addUser->bindValue("nom", $first_name);
        $addUser->bindValue("prenom", $last_name);
        $addUser->bindValue("date_naissance", $date_naissance);
        $addUser->bindValue("gender", $gender);
        $addUser->bindValue("email", $email);
        $addUser->bindValue("password", $password);
        $addUser->bindValue("changed_password",0);

        if (isset($_POST['role'])) {
            $addUser->bindValue("role", 'secretaire');
            $addUser->bindValue("changed_password",1);
        } else {
            $addUser->bindValue("role", 'user');
            
        }

        if ($addUser->execute()) {
            $_POST['first_name'] = '';
            $_POST['last_name'] = '';
            $_POST['date_naissance'] = '';
            $_POST['gender'] = '';
            $_POST['email'] = '';
            $_POST['password'] = '';
            $_POST['password_confirmation'] = '';

            if (isset($_POST['role'])) {
                echo '<div class="alert alert-success py-2" role="alert">
                Secretaire a été créé avec succès
              </div>';
            } else {
                echo '<div class="alert alert-success py-2" role="alert">
                Vote Compte a été créé avec succès
              </div>';
            }

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
