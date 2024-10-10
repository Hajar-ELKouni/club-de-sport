<?php $demande = $demandeObj->getDemandeByUserId($user->id); ?>

<?php


foreach($demande as $onedemande):?>

    <div class="card text-center">
    <h5 class="card-header p-3 text-success fw-bold"><?= ($onedemande->status === 'approved') ? 'Votre demande a été approuvée' : 'Merci pour votre demande, Nous vous informerons !'; ?></h5>
    <div class="card-body p-4">
        <h5 class="card-title">Votre Demande Informations:</h5>

        <p class="text-muted">Demande Id: <span class="fw-bold">#(<?= $onedemande->demande_id ?>)</span></p>

        <div class="my-3 p-3 border rounded">
            <?php $equipe = $equipeObj->getEquipeById($onedemande->equipe_id) ?>
            <p class="text-dark"><span class="fw-bold">Equipe Titre: </span><?= ucwords($equipe->title); ?></p>

            <?php $sport = $sportObj->getSportById($equipe->sport_id) ?>
            <p class="text-dark"><span class="fw-bold">Sport Titre: </span><?= ucwords($sport->title); ?></p>

            <p class="text-muted"><span class="text-dark fw-bold">Prix: </span><?= $equipe->price; ?> <span style="font-size: 14px;" class="fw-bold text-dark">MAD</span></p>
            <p class="text-muted"><span class="text-dark fw-bold">Total Personnes:</span><?= $equipe->nbr ?></p>
            <?php $coach = $coachObj->getCoachById($equipe->coach_id) ?>
            <p class="text-muted"><span class="text-dark fw-bold">Coach: </span><?= ucwords($coach->nom . ' ' . $coach->prenom) ?></p>
            <p class="text-dark"><span class="fw-bold">Emploi:</span> <?= ucwords($equipe->emploi); ?></p>
            <p class="text-dark"><span class="fw-bold">Salle:</span> <?= ucwords($equipe->salle); ?></p>
            <p class="text-dark"><span class="fw-bold">Salle Id:</span> <?= ucwords($equipe->salle_id); ?></p>

        </div>

        <div class="text-muted fs-5">
            <span>Status:</span>
            <span class="btn btn-sm badge <?= ($onedemande->status === 'approved') ? 'text-bg-success' : 'text-bg-secondary'; ?>">
                <?= ($onedemande->status === 'approved') ? 'Approuvé' : 'En attente'; ?>
            </span>
        </div>
    </div>
</div>

<?php endforeach;?>
