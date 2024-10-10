<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php
if (isset($_GET['equipe'])) {
    $selectedEquipeId = (int) $_GET['equipe'];
} else {
    header("location: " . APP_URL . "/secretaire/equipes.php", true);
    exit();
}

if (!is_int($selectedEquipeId)) {
    header("location: " . APP_URL . "/secretaire/equipes.php", true);
    exit();
}

$equipe = $equipeObj->getEquipeById($selectedEquipeId);

if (!$equipe) {
    header("location: " . APP_URL . "/secretaire/equipes.php", true);
    exit();
}
?>

<?php $sports = $sportObj->getAllSports(); ?>
<?php $coaches = $coachObj->getAllCoaches(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['update'])) {
                    $sportId = $_POST['sport'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $nbr = $_POST['nbr'];
                    $price = $_POST['price'];
                    $gender = $_POST['gender'];
                    $coachId = $_POST['coach'];

                    $errorArray = array();

                    // Check required fields
                    if (empty($sportId) || is_null($sportId)) {
                        $errorArray[] = "Le sport est required.";
                    }
                    if (empty($title) || is_null($title)) {
                        $errorArray[] = "Le title est required.";
                    }
                    if (empty($description) || is_null($description)) {
                        $errorArray[] = "La description est required.";
                    }
                    if (empty($nbr) || is_null($nbr)) {
                        $errorArray[] = "Le nombre est required.";
                    }
                    if (empty($price) || is_null($price)) {
                        $errorArray[] = "Le prix est required.";
                    }
                    if (empty($gender) || is_null($gender)) {
                        $errorArray[] = "Le genre est required.";
                    }
                    if (empty($coachId) || is_null($coachId)) {
                        $errorArray[] = "La coach est required.";
                    }

                    // Check length
                    if (strlen($title) > 200) {
                        $errorArray[] = "Le title longueur maximale de 200 caractères.";
                    }
                    if (strlen($description) > 700) {
                        $errorArray[] = "La description longueur maximale de 700 caractères.";
                    }

                    if (!in_array($gender, ['homme', 'femme'])) {
                        $errorArray[] = "gender incorrect";
                    }

                    if (empty($errorArray)) {
                        $updateEquipe = $conn->prepare("UPDATE equipes
                        SET  sport_id = :sport_id, coach_id = :coach_id, gender = :gender, title = :title, description = :description, price = :price, nbr = :nbr
                        where id=:id");

                        $updateEquipe->bindValue("sport_id", $sportId);
                        $updateEquipe->bindValue("coach_id", $coachId);
                        $updateEquipe->bindValue("gender", $gender);
                        $updateEquipe->bindValue("title", $title);
                        $updateEquipe->bindValue("description", $description);
                        $updateEquipe->bindValue("price", $price);
                        $updateEquipe->bindValue("nbr", $nbr);
                        $updateEquipe->bindValue("id", $selectedEquipeId);

                        if ($updateEquipe->execute()) {

                            echo '<div class="alert alert-success py-2" role="alert">
                            Vote Equipe a été modifier avec succès
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
                $oldTitle = isset($_POST['title']) ? $_POST['title'] : $equipe->title;
                $oldDescription = isset($_POST['description']) ? $_POST['description'] : $equipe->description;
                $oldNbr = isset($_POST['nbr']) ? $_POST['nbr'] : $equipe->nbr;
                $oldPrice = isset($_POST['price']) ? $_POST['price'] : $equipe->price;
                ?>

                <form class="form" method="POST">
                    <div class="form-group mb-3">
                        <label for="sport" class="form-label">Sport</label>
                        <select class="form-select" aria-label="sport" name="sport" required>
                            <?php foreach ($sports as $sport) : ?>
                                <option <?= (isset($_POST['sport']) && $_POST['sport'] == $sport->id || ($equipe->sport_id == $sport->id)) ? 'selected' : ''; ?> value="<?= $sport->id ?>"><?= ucwords($sport->title) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" placeholder="Titre" maxlength="255" class="form-control" id="title" value="<?= $oldTitle ?>" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" maxlength="700" class="form-control" placeholder="Description ..." id="description" aria-describedby="description" style="max-height: 300px; min-height:150px;" required><?= $oldDescription ?></textarea>
                    </div>

                    <div class="d-flex gap-4 mb-3">
                        <div class="form-group w-25">
                            <label for="nbr" class="form-label">Nombre</label>
                            <input type="number" name="nbr" min="1" max="10" placeholder="Nombre" class="form-control" id="nbr" value="<?= $oldNbr ?>" required />
                        </div>

                        <div class="form-group w-25">
                            <label for="price" class="form-label">Prix</label>
                            <input type="number" name="price" min="1" placeholder="Prix" class="form-control" id="price" value="<?= $oldPrice ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">Gender:</label>
                            <div class="d-flex gap-3">
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
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="coach" class="form-label">Coach</label>
                        <select class="form-select" aria-label="coach" name="coach" required>
                            <?php foreach ($coaches as $coach) : ?>
                                <option <?= (isset($_POST['coach']) && $_POST['coach'] == $coach->id || $equipe->coach_id == $coach->id) ? 'selected' : ''; ?> value="<?= $coach->id ?>"><?= ucwords($coach->nom . ' ' . $coach->prenom) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" name="update" class="btn btn btn-dark">Update</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
        <script>
            var formHasChanged = true;
            var submitted = false;
            $(".form").submit(function() {
                submitted = true;
            });
            $(document).ready(function() {
                window.onbeforeunload = function(e) {
                    if (formHasChanged && !submitted) {
                        return "Sure you want to leave?";
                    }
                }
            });
        </script>
    </div>
    </div>
</body>

</html>