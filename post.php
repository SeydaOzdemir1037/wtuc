<?php
require_once("front-end/controller/DBController.php");
require_once("front-end/controller/UniversiteController.php");
$unicont = new UniversiteController();

if ($_POST['lisans_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['lisans_uni']);
    echo json_encode($bolumler);
}

if ($_POST['ylisans_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['ylisans_uni']);
    echo json_encode($bolumler);
}

if ($_POST['doktora_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['doktora_uni']);
    echo json_encode($bolumler);
}