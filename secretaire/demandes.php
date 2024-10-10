<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $demandes = $demandeObj->getAllDemandes(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['statusValue']) && isset($_POST['demandeId'])) {
                    $statusValue = $_POST['statusValue'];

                    $demandeId = $_POST['demandeId'];
                    $demande = null;

                    if ($statusValue === 'approved') {
                        $demande = $demandeObj->updateStatusDemande('pending', $demandeId);

                        $equipeID = $demandeObj->getDemandeById($demandeId)->equipe_id;
                        $updatedNumber = $equipeObj->getEquipeById($equipeID)->nbr - 1;
                        $equipeObj->updateEquipeNumber($equipeID, $updatedNumber);

                    } else if ($statusValue === 'pending') {
                        $demande = $demandeObj->updateStatusDemande('approved', $demandeId);

                        $equipeID = $demandeObj->getDemandeById($demandeId)->equipe_id;
                        $updatedNumber = $equipeObj->getEquipeById($equipeID)->nbr + 1;
                        $equipeObj->updateEquipeNumber($equipeID, $updatedNumber);
                    }


                    header('Refresh:0');
                    exit; // Added to stop further execution
                }


                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $demande = $demandeObj->destroyDemande((int) $_POST['destroy']);

                    if ($demande) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Demande Supprimée !"); } </script>';
                    } else {
                        // Deletion failed
                        echo '<script> window.onload = function() { alert("Something went Wrong"); } </script>';
                    }

                    header('Refresh:0');
                    exit; // Added to stop further execution
                }

                ?>

                <section class="my-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Equipe</th>
                                <th scope="col">Sport</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($demandes)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Demande</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($demandes as $index => $demande) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <?php $user = $userObj->getUserById($demande->user_id) ?>
                                            <?= $user->nom . ' ' . $user->prenom ?>
                                        </td>
                                        <td>
                                            <?php $user = $userObj->getUserById($demande->user_id) ?>
                                            <?= $user->gender; ?>
                                        </td>
                                        <td>
                                            <?php $equipe = $equipeObj->getEquipeById($demande->equipe_id) ?>
                                            <?= ucwords($equipe->title) ?>
                                        </td>
                                        <td>
                                            <?php $sport = $sportObj->getSportById($equipe->sport_id) ?>
                                            <?= ucwords($sport->title) ?>
                                        </td>
                                        <td>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="statusValue" value="<?= $demande->status ?>" />
                                                <button class="btn btn-sm badge <?= ($demande->status === 'approved') ? 'text-bg-success' : 'text-bg-secondary'; ?>" name="demandeId" value="<?= $demande->id ?>" type="submit">
                                                    <?= ($demande->status === 'approved') ? 'Approuvé' : 'En attente'; ?>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure ?')">
                                                <button type="submit" name="destroy" value="<?= $demande->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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