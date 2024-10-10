<?php require_once __DIR__ . '/../config/app.php' ?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>

<body>
    <div class="main-wrapper">
        <div class="content">
            <?php require_once __DIR__ . '/../partials/nav.php'; ?>

            <header class="bg-light py-5 my-5">
                <h2 class="text-center">Frequently Asked Questions</h2>
            </header>

            <div class="container">
                <div class="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqsOne" aria-expanded="true" aria-controls="faqsOne">
                                Lorem ipsum dolor sit amet. #1
                            </button>
                        </h2>
                        <div id="faqsOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit, <strong>amet consectetur adipisicing elit</strong>. Voluptatum possimus hic debitis soluta fugit eius tenetur nihil deleniti labore, dignissimos assumenda sequi! Quo provident non natus minus animi distinctio veritatis. <code>Enim quam tenetur quaerat</code>. Adipisci mollitia fuga nam quibusdam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqsTwo" aria-expanded="false" aria-controls="faqsTwo">
                                Lorem ipsum dolor sit amet. #2
                            </button>
                        </h2>
                        <div id="faqsTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit, <strong>amet consectetur adipisicing elit</strong>. Voluptatum possimus hic debitis soluta fugit eius tenetur nihil deleniti labore, dignissimos assumenda sequi! Quo provident non natus minus animi distinctio veritatis. <code>Enim quam tenetur quaerat</code>. Adipisci mollitia fuga nam quibusdam.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqsThree" aria-expanded="false" aria-controls="faqsThree">
                                Lorem ipsum dolor sit amet. #3
                            </button>
                        </h2>
                        <div id="faqsThree" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Lorem ipsum dolor sit, <strong>amet consectetur adipisicing elit</strong>. Voluptatum possimus hic debitis soluta fugit eius tenetur nihil deleniti labore, dignissimos assumenda sequi! Quo provident non natus minus animi distinctio veritatis. <code>Enim quam tenetur quaerat</code>. Adipisci mollitia fuga nam quibusdam.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    </div>
    </div>
</body>

</html>