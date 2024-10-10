<?php include __DIR__ . '/partials/check-user.php'; ?>

<?php
if (isset($_GET['sport'])) {
    $selectedSportId = (int) $_GET['sport'];
} else {
    header("location: " . APP_URL . "/user/sports.php", true);
    exit();
}

if (!is_int($selectedSportId)) {
    header("location: " . APP_URL . "/user/sports.php", true);
    exit();
}

$sport = $sportObj->getSportById($selectedSportId);

if (!$sport) {
    header("location: " . APP_URL . "/user/sports.php", true);
    exit();
}

$equipes = $equipeObj->getAllEquipesBySportIdAndGender($selectedSportId, $user->gender);
$announces = $announceObj->getAllVisibleAnnounces();

?>

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
                    <?php
                    if (isset($_POST['demander']) && isset($_POST['equipe_id']) && isset($_POST['user_id'])) {
                        $equipeId = $_POST['equipe_id'];
                        $userId = $_POST['user_id'];
                        $status = "pending";
                        $demandeId = hexdec(uniqid());

                        $demander = $conn->prepare("INSERT INTO demandes(equipe_id, user_id, status, demande_id) VALUES(:equipe_id, :user_id, 'pending', :demande_id) ON DUPLICATE KEY UPDATE status = :status");

                        $demander->bindValue("equipe_id", $equipeId);
                        $demander->bindValue("user_id", $userId);
                        $demander->bindValue("status", $status);
                        $demander->bindValue("demande_id", $demandeId);

                        if (!$demander->execute()) {
                            echo '<script> window.onload = function() { alert("Something went Wrong"); } </script>';
                            exit();
                            die();
                        }

                        header("location: " . APP_URL . "/user/sports.php", true);
                        exit;
                    }
                    ?>
                    <?php
                    if (count($announces)) {
                        foreach ($announces as $announce) {
                            echo '<div class="alert alert-info d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                        <div class="ms-2">
                            ' . $announce->content . '
                        </div>
                    </div>';
                        }
                    }
                    ?>

                    <header class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold text-dark">(<?= ucwords($sport->title) ?>) Sélectionnez votre équipe</h3>
                        <a href="./sports.php" class="btn btn-sm btn-dark">Back</a>
                    </header>
                    <section class="my-3">
                        <?php if (empty($equipes)) : ?>
                            <div class="alert alert-info fs-3 text-center" role="alert">Aucune équipe disponible pour ce sport.</div>
                        <?php else : ?>
                            <?php foreach ($equipes as $index => $equipe) : ?>
                                <div class="mb-4 px-4 border-start border-2 border-secondary">
                                    <p class="fw-bold text-dark">#<?= $index + 1 ?> <?= ucwords($equipe->title); ?></p>
                                    <p class="text-muted mb-2"><?= $equipe->description; ?></p>
                                    <p class="text-muted">Prix: <span class="text-dark fw-bold"><?= $equipe->price; ?></span> <span style="font-size: 14px;" class="fw-bold text-dark">MAD</span></p>
                                    <p class="text-muted">Total Personnes: <span class="text-dark fw-bold"><?= $equipe->nbr ?></span></p>
                                    <?php $coach = $coachObj->getCoachById($equipe->coach_id) ?>
                                    <p class="text-muted">Coach: <span class="text-dark fw-bold"><?= ucwords($coach->nom . ' ' . $coach->prenom) ?></span></p>
                                    <p class="text-dark">Biographie: <b><?= $coach->bio ?></b></p>
                                    <form method="POST">
                                        <input type="hidden" name="equipe_id" value="<?= $equipe->id ?>" />
                                        <input type="hidden" name="user_id" value="<?= $user->id ?>" />
                                        <button type="submit" name="demander" class="btn btn-sm btn-dark my-2">Demander</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
</body>

</html>