<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $announces = $announceObj->getAllannounces(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>

                <?php
                if (isset($_POST['statusValue']) && isset($_POST['announceId'])) {
                    $statusValue = (int) $_POST['statusValue'];

                    $announceId = (int) $_POST['announceId'];
                    
                    if ($statusValue === 1) {
                        $announceObj->updateStatusAnnounce(0, $announceId);
                    } else if ($statusValue === 0) {
                        $announceObj->updateStatusAnnounce(1, $announceId);
                    }

                    header('Refresh:0');
                    exit; // Added to stop further execution
                }

                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $announce = $announceObj->destroyAnnounce((int) $_POST['destroy']);

                    if ($announce) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Announce Supprimée !"); } </script>';
                    } else {
                        // Deletion failed
                        echo '<script> window.onload = function() { alert("Something went Wrong"); } </script>';
                    }

                    //header('Refresh:0');
                    //exit; // Added to stop further execution
                }

                ?>

                <section>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Content</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($announces)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Announce</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($announces as $index => $announce) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <?= $announce->content ?>
                                        </td>
                                        <td>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="statusValue" value="<?= $announce->status ?>" />
                                                <button class="btn btn-sm badge <?= ($announce->status) ? 'text-bg-success' : 'text-bg-secondary'; ?>" name="announceId" value="<?= $announce->id ?>" type="submit">
                                                    <?= ($announce->status) ? 'Visible' : 'Invisible'; ?>
                                                </button>
                                            </form>
                                        </td>
                                        <td><?= $announce->created_at ?></td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <a href="announces-edit.php?announce=<?= $announce->id ?>" class="btn btn-sm btn-dark"><i class="bi bi-pen"></i></a>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $announce->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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