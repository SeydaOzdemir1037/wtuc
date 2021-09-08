<?php
include "fonksiyon.php";

require_once("front-end/controller/DBController.php");
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ŞM Mühendislik</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="front-end/assets/img/favicon.png" rel="icon">
    <link href="front-end/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="front-end/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="front-end/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="front-end/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="front-end/assets/css/style.css" rel="stylesheet">

</head>

<body>

<!-- ======= Açılır Menü Buton ======= -->
<button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

<!-- ======= Header Başlangıç ======= -->
<header id="header">
    <div class="d-flex flex-column">

        <div class="profile">
            <img src="front-end/assets/img/profile-son.jfif" alt="" class="img-fluid rounded-circle">
            <h1 class="text-light"><a href="index.php">ŞM Mühendislik</a></h1>
            <div class="social-links mt-3 text-center">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>

        <nav class="nav-menu">
            <ul>
                <li class="active"><a href="index.php"><i class="bx bx-home"></i> <span>Anasayfa</span></a></li>
                <li><a href="hakkimizda.php"><i class="bx bx-info-circle"></i> <span>Hakkımızda</span></a>
                </li>
                <li><a href="projelerimiz.php"><i class="bx bx-pie-chart-alt"></i> <span>Projelerimiz</span></a>
                </li>
                <li><a href="personeller.php"><i class="bx bxs-user-check"></i> Personel Kadromuz</a></li>
                <li><a href="is-ilanlari.php"><i class="bx bx-spreadsheet"></i> İŞ İLANLARI</a></li>
                <li><a href="iletisim.php"><i class="bx bx-envelope"></i> İletişim</a></li>

            </ul>
        </nav>
        <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
</header><!-- Header Bitiş -->