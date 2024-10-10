<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $coach = $coachObj->getAllCoaches(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $coach = $coachObj->destroyCoach((int) $_POST['destroy']);

                    if ($coach) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Coach Supprimée !"); } </script>';
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
                                <th scope="col">Prenom</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date De Naissance</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($coach)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucun Coach</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($coach as $index => $onecoach) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <?= ucwords($onecoach->nom) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($onecoach->prenom) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($onecoach->gender) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($onecoach->email) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($onecoach->date_naissance) ?>
                                        </td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <a href="coach-edit.php?coach=<?= $onecoach->id ?>" class="btn btn-sm btn-dark"><i class="bi bi-pen"></i></a>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $onecoach->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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