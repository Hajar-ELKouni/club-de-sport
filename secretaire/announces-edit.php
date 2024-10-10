<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php
if (isset($_GET['announce'])) {
    $selectedAnnounceId = (int) $_GET['announce'];
} else {
    header("location: " . APP_URL . "/admin/announces.php", true);
    exit();
}

if (!is_int($selectedAnnounceId)) {
    header("location: " . APP_URL . "/admin/announces.php", true);
    exit();
}

$announce = $announceObj->getAnnounceById($selectedAnnounceId);

if (!$announce) {
    header("location: " . APP_URL . "/admin/announces.php", true);
    exit();
}
?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['update'])) {
                    $content = $_POST['content'];
                    $status = $_POST['status'];

                    $errorArray = array();

                    // Check required fields
                    if (empty($content) || is_null($content)) {
                        $errorArray[] = "Le contenu est required.";
                    }

                    // Check length
                    if (strlen($content) > 300) {
                        $errorArray[] = "Le contenu longueur maximale de 300 caractères.";
                    }

                    if (!in_array($status, [1, 0])) {
                        $errorArray[] = "status incorrect";
                    }

                    if (empty($errorArray)) {
                        $updateAnnounce = $conn->prepare("UPDATE announces SET content = :content, status = :status where id=:id");

                        $updateAnnounce->bindValue("content", $content);
                        $updateAnnounce->bindValue("status", $status);
                        $updateAnnounce->bindValue("id", $selectedAnnounceId);

                        if ($updateAnnounce->execute()) {
                            echo '<div class="alert alert-success py-2" role="alert">
                            Vote announce a été modifier avec succès 
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

                <?php $oldContent = isset($_POST['content']) ? $_POST['content'] : $announce->content; ?>

                <h3 class="mb-3">Modifier Announce</h3>

                <form class="form" method="POST">
                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Contenu</label>
                        <input type="text" name="content" placeholder="Contenu" maxlength="300" class="form-control" id="content" value="<?= $oldContent ?>" required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="visible" value="1" <?= (isset($_POST['status']) && $_POST['status'] == 1 || $announce->status == 1) ? 'checked' : ''; ?> checked required />
                                <label class="form-check-label" for="visible">
                                    Visible
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="invisible" value="0" <?= (isset($_POST['status']) && $_POST['status'] == 0 || $announce->status == 0) ? 'checked' : ''; ?> required />
                                <label class="form-check-label" for="invisible">
                                    Invisible
                                </label>
                            </div>
                        </div>
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