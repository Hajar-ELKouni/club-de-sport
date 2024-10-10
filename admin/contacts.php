<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $contacts = $contactObj->getAllContacts(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__ . '/partials/header.php'; ?>
                <?php
                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $contact = $contactObj->destroyContact((int) $_POST['destroy']);

                    if ($contact) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("contact Supprimée !"); } </script>';
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
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                                <th scope="col">Created at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($contacts)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune Contact</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($contacts as $index => $contact) : ?>
                                    <tr>
                                        <th scope="row"><?= $contact->id ?></th>
                                        <td>
                                            <?= ucwords($contact->name) ?>
                                        </td>
                                        <td>
                                            <?= $contact->email ?>
                                        </td>
                                        <td>
                                            <?= $helpersObj->limit($contact->message, 80) ?>
                                        </td>

                                        <td><?= $contact->created_at ?></td>
                                        <td class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-dark modal-link-view" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $contact->id ?>" data-name="<?= $contact->name ?>" data-email="<?= $contact->email ?>" data-message="<?= $contact->message ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $contact->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </main>

            <!-- Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewModalLabel">Contact Informations</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="modal-id" class="mb-3"></p>
                            <p id="modal-name" class="mb-3"></p>
                            <p id="modal-email" class="mb-3"></p>
                            <p id="modal-message"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
        <script>
            $('.modal-link-view').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var message = $(this).data('message');

                $('#modal-id').html('<span class="fw-bold">ID: </span>' + id);
                $('#modal-name').html('<span class="fw-bold">Name: </span>' + name);
                $('#modal-email').html('<span class="fw-bold">Email: </span>' + email);
                $('#modal-message').html('<span class="fw-bold">Message: </span>' + message);
            });
        </script>
    </div>
    </div>
</body>

</html>
