<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $secretaires = $secretaireObj->getAllSecretaires(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $secretaire = $secretaireObj->destroySecretaire((int) $_POST['destroy']);

                    if ($secretaire) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Secretaire Supprimée !"); } </script>';
                    } else {
                        // Deletion failed
                        echo '<script> window.onload = function() { alert("Something went Wrong"); } </script>';
                    }

                    header('Refresh:0');
                    exit; // Added to stop further execution
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
                                <th scope="col">Created at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($secretaires)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Secretaire</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($secretaires as $index => $secretaire) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <?= ucwords($secretaire->nom) . ' ' . ucwords($secretaire->prenom) ?>
                                        </td>
                                        <td>
                                            <?= $secretaire->email ?>
                                        </td>
                                        <td>
                                            <?= ucwords($secretaire->gender) ?>
                                        </td>

                                        <td><?= $secretaire->created_at ?></td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $secretaire->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
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