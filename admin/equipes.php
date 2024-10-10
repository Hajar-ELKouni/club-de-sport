<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__. '/../partials/head.php'; ?>
</head>

<?php $equipes = $equipeObj->getAllEquipes(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
   
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <main class="container py-5">
                <?php include __DIR__. '/partials/header.php'; ?>

                <?php
                if (isset($_POST['destroy']) && $_POST['destroy']) {
                    $equipe = $equipeObj->destroyEquipe((int) $_POST['destroy']);

                    if ($equipe) {
                        // Deletion successful
                        echo '<script> window.onload = function() { alert("Equipe Supprimée !"); } </script>';
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
                                <th scope="col">Sport</th>
                                <th scope="col">Equipe</th>
                                <th scope="col">Coach</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Price</th>
                                <th scope="col">Nombre</th>   
                                <th scope="col">Nombre Maximale</th> 
                                <th scope="col">Approuvé Par Coach</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
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
                                            <?= $equipe->price ?> <span style="font-size: 14px;" class="fw-bold text-dark">MAD</span>
                                        </td>

                                        <td>
                                            <?php if($equipe->nbr ==$equipe->nbr_max  ) : ?>
                                                <span class="badge bg-danger"><?=$equipe->nbr;?></span>
                                            <?php else:?>
                                                <span class="badge bg-success"><?=$equipe->nbr;?></span>
                                            <?php endif;?>
                                        </td>
                                         <!--new modif --> 
                                         <td>
                                            <?php if($equipe->nbr_max == 10 || $equipe->nbr_max ==5 ) : ?>
                                                <span class="badge bg-danger"><?=$equipe->nbr_max;?></span>
                                            <?php else:?>
                                                <span class="badge bg-success"><?=$equipe->nbr_max;?></span>
                                            <?php endif;?>
                                        </td>
                                                
                                        <td>
                                            <span class="badge bg-secondary"><?=$equipe->approved;?></span>
                                        </td>

                                       <td>
                                         <!--    <?php if($equipe->status === 0):?>
                                                <span class="fw-bold text-dark">Non Paie</span>
                                            <?php else:?>
                                                <span class="fw-bold text-dark">Paie</span>
                                            <?php endif;?>-->
                                        
                                        <?= ucwords($equipe->description) ?></td>  
                                        <td class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-dark modal-link-view" data-bs-toggle="modal" data-bs-target="#viewModal" data-title="<?= $equipe->title ?>" data-description="<?= $equipe->description ?>" data-emploi="<?= $equipe->emploi ?>" data-salle="<?= ucwords($equipe->salle) ?>" data-salle-id="<?= $equipe->salle_id ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="equipes-edit.php?equipe=<?= $equipe->id ?>" class="btn btn-sm btn-dark"><i class="bi bi-pen"></i></a>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Are You Sure ?')">
                                                <button type="submit" name="destroy" value="<?= $equipe->id ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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
                            <h1 class="modal-title fs-5" id="viewModalLabel">Informations d'équipe</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="modal-title" class="mb-3"></p>
                            <p id="modal-description" class="mb-3"></p>
                            <p id="modal-emploi" class="mb-3"></p>
                            <p id="modal-salle"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php require_once __DIR__. '/../partials/footer.php'; ?>
        <script>
            $('.modal-link-view').on('click', function() {
                var title = $(this).data('title');
                var description = $(this).data('description');
                var emploi = $(this).data('emploi');
                var salle = $(this).data('salle');
                var salleId = $(this).data('salle-id');

                $('#modal-title').html('<span class="fw-bold">Title: </span>' + title);
                $('#modal-description').html('<span class="fw-bold">Description: </span>' + description);
                $('#modal-emploi').html('<span class="fw-bold">Date d\'emploi: </span>' + emploi);
                $('#modal-salle').html('<span class="fw-bold">Salle: </span>'+ salle +' <span class="fw-bold">('+ salleId +')</span>');
            });
        </script>
    </div>
    </div>
</body>

</html>