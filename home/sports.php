<?php require_once __DIR__ . '/../Models/Sport.php'; ?>

<section id="sports" class="container text-center py-5">
    <div class="row justify-content-md-center g-4">
        <?php
            $fct = new Sport($conn);
            $sports = $fct->getAllSports();
            foreach ($sports as $sport) {
        ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="<?= $sport->image ?>" class="card-img-top" height="200" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucwords($sport->title); ?></h5>
                        <p class="card-text"><?= $sport->description; ?></p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
