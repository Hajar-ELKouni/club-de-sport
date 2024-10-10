<?php require_once __DIR__ . '/../Models/Sport.php'; ?>
<!--
<style>
    .image-container {
        height: 800px !important;
        width: 100% !important;
        overflow: hidden !important;
    }

    .image-container img {
        object-fit: cover !important;
        width: 100% !important;
        height: 100% !important;
    }

    .carousel .carousel-item {
        height: 440px !important;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 440px !important;
    }
</style>

<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <?php
        $fct = new Sport($conn);
        $sports = $fct->getAllSports();
        foreach ($sports as $sport) {
        ?>
            <div class="carousel-item image-container <?= ($sport->id === 1) ? 'active' : '' ?>">
                <img src="<?= $sport->image ?>" class="d-block w-100 slider-img" alt="Lorem ipsum dolor sit amet.">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="fw-bold fs-2"><?= ucwords($sport->title) ?></h5>
                   <p class="fs-5"><?= $sport->description ?></p>
                </div>
            </div>
        <?php
        }
        
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
    -->
    

<style>
    .image-container {
        height: 500px !important;
        width: 100% !important;
        overflow: hidden !important;
    }

    .image-container img {
        object-fit: cover !important;
        width: 100% !important;
        height: 100% !important;
    }
</style>

<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
    <div class="carousel-item image-container active">
        <img src="public/images/1.jpeg" class="d-block w-100 slider-img" alt="Lorem ipsum dolor sit amet.">
        <div class="carousel-caption d-none d-md-block">
            <!--<p class="fs-5"><?= $sports[0]->description ?></p>-->
        </div>
    </div>
    <div class="carousel-item image-container">
        <img src="public/images/5.png" class="d-block w-100 slider-img" alt="Lorem ipsum dolor sit amet.">
        <div class="carousel-caption d-none d-md-block">
            <!--<p class="fs-5"><?= $sports[1]->description ?></p>-->
        </div>
    </div>
</div>

    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>