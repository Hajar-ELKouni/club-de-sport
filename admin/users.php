<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $users = $userObj->getUsers() ; ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>
                <?php
                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $user = $userObj->destroyUser((int) $_POST['destroy']);

                    if ($user) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Utilisateur Supprimée !"); } </script>';
                    } else {
                        // Deletion failed
                        echo '<script> window.onload = function() { alert("Something went Wrong"); } </script>';
                    }

                    header('Refresh:0');
                    exit; // Added to stop further execution
                }


                if (isset($_POST['save']))
                {
                    $password = $_POST['password'];
                    $id = $_POST['id'];

                    if (empty($password) || is_null($password)) {
                        $password = $_POST['oldPassword'];
                    } else {
                        $password = sha1($_POST['password']);
                    }
                    // modifications 
                    $updatePassword = $conn->prepare("UPDATE users SET password = :password , changed_password = :changed_password  WHERE id = :id");
                    $updatePassword->bindValue("password", $password);
                    $updatePassword->bindValue("changed_password", 1);
                    $updatePassword->bindValue("id", $id);

                    if ($updatePassword->execute())
                    {

                        $_POST['password'] = '';

                        echo '<div class="alert alert-success py-2" role="alert">
                        Le mot de passe de l\'utilisateur n°' . $id . ' a été modifié avec succès
                        </div>';

                    } else {
                        echo '<div class="alert alert-danger py-2" role="alert">
                        Something went Wrong | Error 500
                    </div>';
                    };
                }

                ?>
                <section>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Contact</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($users as $index => $user) : ?>
                                    <tr>
                                        <th scope="row"><?= $user->id ?></th>
                                        <td>
                                            <?= ucwords($user->nom . ' ' . $user->prenom) ?>
                                        </td>
                                        <td>
                                            <?= $user->email ?>
                                        </td>
                                        <td>
                                            <?= $user->gender ?>
                                        </td>

                                        <td><?= $user->role ?></td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-dark modal-link-view" data-bs-toggle="modal" data-bs-target="#user<?= $user->id ?>">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $user->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="user<?= $user->id ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form method="post">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="viewModalLabel">Changer le mot de passe</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="inputPassword" class="form-label">Mot de passe</label>
                                                            <input type="text" name="password" maxlength="255" placeholder="Mot de passe (Laissez vide si vous ne l'avez pas changer) " class="form-control" id="inputPassword" value="<?= generatePassword() ?>" />
                                                            <input type="hidden" name="oldPassword" value="<?= $user->password; ?>">
                                                            <input type="hidden" name="id" value="<?= $user->id ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-sm btn-primary" name="save">Enregistrer</button>
                                                        <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </main>

        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>




<?php

function generatePassword() {
    // Array of word letters
    $wordLetters = range('A', 'Z');

    // Generate three random word letters
    $randomWord = '';
    for ($i = 0; $i < 3; $i++) {
        $randomWord .= $wordLetters[array_rand($wordLetters)];
    }

    // Generate five random numbers
    $randomNumbers = '';
    for ($i = 0; $i < 5; $i++) {
        $randomNumbers .= rand(0, 9);
    }

    // Concatenate the word letters and numbers
    $password = $randomWord . $randomNumbers;

    return $password;
}
?>