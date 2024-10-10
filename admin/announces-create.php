<?php include __DIR__ . '/partials/check-user.php'; ?>

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
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['create'])) {
                    $content = $_POST['content'];
                    $status = $_POST['status'];

                    $errorArray = array();

                    // Check required fields
                    if (empty($content) || is_null($content)) {
                        $errorArray[] = "Le contenu est required.";
                    }

                    // Check length
                    if (strlen($content) > 300) {
                        $errorArray[] = "L'announce longueur maximale de 300 caractères.";
                    }

                    if (!in_array($status, [1, 0])) {
                        $errorArray[] = "status incorrect";
                    }

                    if (empty($errorArray)) {
                        $createAnnounce = $conn->prepare("INSERT INTO announces(content, status) VALUES(:content,:status)");

                        $createAnnounce->bindValue("content", $content);
                        $createAnnounce->bindValue("status", $status);

                        if ($createAnnounce->execute()) {
                            $_POST['content'] = '';
                            $_POST['status'] = '';

                            echo '<div class="alert alert-success py-2" role="alert">
                            Announce a été créé avec succès 
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
                $oldContent = isset($_POST['content']) ? $_POST['content'] : '';
                ?>

                <h3 class="mb-3">Create Announce</h3>

                <form class="form" method="POST">

                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <input type="text" name="content" placeholder="Contenu" maxlength="300" class="form-control" id="content" value="<?= $oldContent ?>" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="visible" value="1" <?= (isset($_POST['status']) && $_POST['status'] == 'visible') ? 'checked' : ''; ?> checked required />
                                <label class="form-check-label" for="visible">
                                    Visible
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="invisible" value="0" <?= (isset($_POST['status']) && $_POST['status'] == 'invisible') ? 'checked' : ''; ?> required />
                                <label class="form-check-label" for="invisible">
                                    Invisible
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" name="create" class="btn btn btn-dark">Create</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>