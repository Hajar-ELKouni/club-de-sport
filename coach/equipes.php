<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $equipes = $equipeObj->getEquipesByCoachApprove($_SESSION['user']->id); ?>

<?php

if (isset($_POST['statusValue']) && isset($_POST['equipeID']))
{
    $equipeID = $_POST['equipeID'];

    $demande = $equipeObj->updateStatusEquipe('Non', $equipeID);

    header('Refresh:0');
    exit; // Added to stop further execution
}

?>
<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <section>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sport</th>
                                <th scope="col">Equipe</th>
                                <th scope="col">Coach</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($equipes)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Equipe</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($equipes as $index => $equipe) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <?php $sport = $sportObj->getSportById($equipe->sport_id) ?>
                                            <?= ucwords($sport->title) ?>
                                        </td>
                                        <td>
                                            <?= $equipe->title ?>
                                        </td>
                                        <td>
                                            <?php $coach = $coachObj->getCoachById($equipe->coach_id) ?>
                                            <?= ucwords($coach->nom . ' ' . $coach->prenom) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($equipe->gender) ?>
                                        </td>

                                        <td>
                                            <?php if($equipe->nbr == 10) : ?>
                                                <span class="badge bg-danger"><?=$equipe->nbr;?></span>
                                            <?php else:?>
                                                <span class="badge bg-success"><?=$equipe->nbr;?></span>
                                            <?php endif;?>
                                        </td>

                                        <td>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="statusValue" value="<?= $equipe->approved ?>" />
                                                <button class="btn btn-sm badge text-bg-success" name="equipeID" value="<?= $equipe->id ?>" type="submit">
                                                    Approuvée
                                                </button>
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
