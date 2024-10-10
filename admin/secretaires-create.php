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

                <?php include __DIR__ . '/../auth/partials/register-request.php' ?>
                <?php include __DIR__ . '/../auth/partials/register-old-values.php' ?>

                <h3 class="mb-3 text-left">Create Secretaire</h3>
                <form method="POST">
                <?php include __DIR__ . '/../auth/partials/register-form.php' ?>
                    <div class="form-group mb-3">
                        <input type="hidden" name="role" value="secretaire" />
                        <button type="submit" name="register" class="btn btn btn-dark">Create</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>
