<?php

require_once __DIR__ . '/../config/app.php';

if (isset($_SESSION['user'])) {
   
        $user = $_SESSION['user'];
    } 


$id = $user->id ;

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<body>

<div class="main-wrapper">
<main>
                <div class="d-flex justify-content-center my-2 mt-5 pt-3 text-center">
                    <div class="col-md-4">
                        <?php
                        if (isset($_POST['login'])) {

                            $password = $_POST['email'];
                            $Confirme = $_POST['password'];
                            //$id  = $_POST['id'];
                            $errorArray = array();

                            // Check required fields
                            if (empty($password)) {
                                $errorArray[] = "Nouvelle mot de passe  est nécessaire!";
                            }
                            if (empty($Confirme)) {
                                $errorArray[] = "La Confirmation est nécessaire!";
                            }
                             
                            // Verifier l'egalite de pass 
                            if ($password!=$Confirme) {
                                $errorArray[] = "Les deux champs doivent être identiques !";
                            }

                            

                            if (empty($errorArray)) {
                              $updatePassword = $conn->prepare("UPDATE users SET password = :password, changed_password = :changed_password WHERE id = :id");
                              $hash=  sha1($password);
                              $updatePassword->bindValue("password", $hash);

                              $updatePassword->bindValue("changed_password", 0);
                               $updatePassword->bindValue("id", $id);

                               $updatePassword->execute();
                               if ($updatePassword->execute())
                            {
        
                                $_POST['password'] = '';
                                $_POST['email'] = '';
        
                                echo '<div class="alert alert-success py-2" role="alert">
                                Le mot de passe de l\'utilisateur n°' . $id . ' a été modifié avec succès
                                </div>';
        
                            } else {
                                echo '<div class="alert alert-danger py-2" role="alert">
                                Erreur lors de insertion   | Error 500
                            </div>';
                            };    
                            } 
                            
                            
                            else {
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
                        <h3 class="mb-3">Changer mot de passe </h3>
                        <form method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="email" placeholder="Mot de passe " class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?= $oldEmail ?>" maxlength="200" required />
                            </div>
                           <!-- <input type="hidden" name="id" value="<?= $user->id ?>"-->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
                                <input type="password" name="password" placeholder="Confirmer" class="form-control" id="inputPassword1" maxlength="200" required />
                            </div>
                            
                            <div class="form-group mb-3">
                                <button type="submit" name="login"  class="btn btn-dark w-100 w-full block">Changer </button>
                            </div>
                        
                        </form>
                    </div>
                </div>
              
            </main>
       

    </div>
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</div>
</div>
</body>

</html>