<?php include __DIR__ . '/partials/check-user.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<?php $announces = $announceObj->getAllVisibleAnnounces(); ?>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>
            <main class="container py-5">

                <?php
                if (count($announces)) {
                    foreach ($announces as $announce) {
                        echo '<div class="alert alert-info d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                        <div class="ms-2">
                            ' . $announce->content . '
                        </div>
                    </div>';
                    }
                }
                ?>

                <?php if ($demandeObj->hasDemandeByUserId($user->id)) : ?>
                    <?php include __DIR__ . '/partials/thank-you-page.php'; ?>
                <?php else : ?>
                    <header>
                        <h3 class="fw-bold text-dark">Sélectionnez votre sport préférés</h3>
                    </header>
                    <section class="my-3">
                        <?php $sports = $sportObj->getAllSports(); ?>
                        <?php if (empty($sports)) : ?>
                            <div class="alert alert-info fs-3 text-center" role="alert">Aucune sport disponible.</div>
                        <?php else : ?>
                            <?php foreach ($sports as $sport) : ?>
                                <a href="equipes.php?sport=<?= $sport->id ?>" class="text-decoration-none text-dark">
                                    <div class="d-flex gap-3 position-relative my-5 p-3 border border-2 rounded sport-card">
                                        <img src="<?= $sport->image ?>" class="flex-shrink-0 me-3" width="250" height="120" alt="<?= $sport->title ?>">
                                        <div>
                                            <h5 class="mt-0"><?= ucwords($sport->title); ?></h5>
                                            <p><?= $sport->description; ?></p>
                                            <a href="equipes.php?sport=<?= $sport->id ?>" class="btn btn-sm btn-dark my-2">Choisir</a>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            </main>
        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>