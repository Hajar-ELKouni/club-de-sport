<?php

require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../Models/User.php';
require_once __DIR__ . '/../../Models/Coach.php';
require_once __DIR__ . '/../../Models/Equipe.php';
require_once __DIR__ . '/../../Models/Sport.php';
require_once __DIR__ . '/../../Models/Demande.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === "coach") {
        $user = $_SESSION['user'];
    } else {
        header("location: " . APP_URL . "/auth/login.php", true);
        exit();
    }
} else {
    header("location: " . APP_URL . "/auth/login.php", true);
    exit();
}

$userObj = new User($conn);
$coachObj = new Coach($conn);
$equipeObj = new Equipe($conn);
$sportObj = new Sport($conn);
$demandeObj = new Demande($conn);

?>
