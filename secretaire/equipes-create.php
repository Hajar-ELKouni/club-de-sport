<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $sports = $sportObj->getAllSports(); ?>
<?php $coaches = $coachObj->getAllCoaches(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['create'])) {
                    $sportId = $_POST['sport'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $nbr = $_POST['nbr'];
                    $price = $_POST['price'];
                    $gender = $_POST['gender'];
                    $coachId = $_POST['coach'];
                    $status = $_POST['status'];
                    $emploi = $_POST['emploi'];

                    $salle = $_POST['salle'];
                    $salleId = $_POST['salle_id'];

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
                    if (empty($salle) || is_null($salle)) {
                        $errorArray[] = "La salle est required.";
                    }
                    if (empty($salleId) || is_null($salleId)) {
                        $errorArray[] = "Le salle id est required.";
                    }
                    if (empty($emploi) || is_null($emploi)) {
                        $errorArray[] = "L'emploi est required.";
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

                    if (strlen($salle) > 200) {
                        $errorArray[] = "La salle longueur maximale de 200 caractères.";
                    }

                    if (empty($errorArray)) {
                        $createEquipe = $conn->prepare("INSERT INTO
                        equipes(sport_id, coach_id, gender, title, description, price, nbr, emploi, salle, salle_id, status)
                        VALUES(:sport_id, :coach_id, :gender, :title, :description, :price, :nbr, :emploi, :salle, :salle_id, :status)");

                        $createEquipe->bindValue("sport_id", $sportId);
                        $createEquipe->bindValue("coach_id", $coachId);
                        $createEquipe->bindValue("gender", $gender);
                        $createEquipe->bindValue("title", $title);
                        $createEquipe->bindValue("description", $description);
                        $createEquipe->bindValue("price", $price);
                        $createEquipe->bindValue("nbr", $nbr);
                        $createEquipe->bindValue("emploi", $emploi);
                        $createEquipe->bindValue("salle", $salle);
                        $createEquipe->bindValue("salle_id", $salleId);
                        $createEquipe->bindValue("status", $status);

                        if ($createEquipe->execute()) {
                            $_POST['sport_id'] = '';
                            $_POST['coach_id'] = '';
                            $_POST['gender'] = '';
                            $_POST['title'] = '';
                            $_POST['description'] = '';
                            $_POST['price'] = '';
                            $_POST['nbr'] = '';
                            $_POST['emploi'] = '';
                            $_POST['salle'] = '';
                            $_POST['salle_id'] = '';
                            $_POST['status'] = '';

                            echo '<div class="alert alert-success py-2" role="alert">
                            Vote Equipe a été créé avec succès
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
                $oldTitle = isset($_POST['title']) ? $_POST['title'] : '';
                $oldDescription = isset($_POST['description']) ? $_POST['description'] : '';
                $oldNbr = isset($_POST['nbr']) ? $_POST['nbr'] : '';
                $oldPrice = isset($_POST['price']) ? $_POST['price'] : '';
                $oldEmploi = isset($_POST['emploi']) ? $_POST['emploi'] : '';
                $oldSalle = isset($_POST['salle']) ? $_POST['salle'] : '';
                $oldSalleId = isset($_POST['salle_id']) ? $_POST['salle_id'] : '';
                ?>

                <form class="form" method="POST">
                    <div class="form-group mb-3">
                        <label for="sport" class="form-label">Sport</label>
                        <select class="form-select" aria-label="sport" name="sport" required>
                            <?php foreach ($sports as $sport) : ?>
                                <option <?= (isset($_POST['sport']) && $_POST['sport'] == $sport->id) ? 'checked' : ''; ?> value="<?= $sport->id ?>"><?= ucwords($sport->title) ?></option>
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

                    <div class="d-flex gap-4 mb-3">

                        <div class="form-group w-50">
                            <label for="salle" class="form-label">Salle</label>
                            <input type="text" name="salle" placeholder="Salle" class="form-control" id="salle" value="<?= $oldSalle ?>" required />
                        </div>

                        <div class="form-group w-25">
                            <label for="salle_id" class="form-label">Salle Id</label>
                            <input type="number" name="salle_id" min="1" placeholder="Salle ID" class="form-control" id="salle_id" value="<?= $oldSalleId ?>" required />
                        </div>

                        <div class="form-group w-25">
                            <label for="emploi" class="form-label">Emploi</label>
                            <input type="text" name="emploi" placeholder="emploi" class="form-control" id="emploi" value="<?= $oldEmploi ?>" required />
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" aria-label="status" name="status" required>
                                <option value="1">disponible</option>
                                <option value="0">plein</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="coach" class="form-label">Coach</label>
                        <select class="form-select" aria-label="coach" name="coach" required>
                            <?php foreach ($coaches as $coach) : ?>
                                <option <?= (isset($_POST['coach']) && $_POST['coach'] == $coach->id) ? 'checked' : ''; ?> value="<?= $coach->id ?>"><?= ucwords($coach->nom . ' ' . $coach->prenom.'('.$coach->sport.')') ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" name="create" class="btn btn btn-dark">Create</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__. '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>