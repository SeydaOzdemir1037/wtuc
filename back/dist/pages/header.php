<?php

ob_start();
session_start();

if ($_SESSION['sicil_no'] == null) {
    header("Location:login.php?durum=izinsizgiris");
    exit;
}
require_once("../../controller/DBController.php");
require_once("../../controller/PersonelController.php");
require_once("../../controller/menu_yonetimi.php");
require_once("../../controller/DepartmanController.php");

include "../../../fonksiyon.php";


$menulercont = new menu_yonetimi();
$menuler = $menulercont->menuler();
$ayarlar = $menulercont->ayarlar();


$personelcont = new PersonelController();
$personel = $personelcont->personel_getir($_SESSION['sicil_no']);
$personel_yetkileri = $personelcont->personel_departman_getir($_SESSION['sicil_no']);
$yetkiler = json_decode($personel_yetkileri['yetki'], true);
$yetki_sinirla = $personelcont->personel_yetki_sinirla($personel['sicil_no']);


$departmancont = new DepartmanController();
$calisma_turleri = $personelcont->calisma_turleri_listele();
$bugunun_tarihi = new DateTime();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="description"
          content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
          content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>ŞM Mühendislk-Yönetim Paneli</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/iziToast.min.css">
    <script src="js/iziToast.min.js"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->


</head>
<body class="app sidebar-mini">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="index.php">Yönetim Paneli</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i
                        class="fa fa-bell-o fa-lg"></i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">1 Yeni Mesaj!!</li>
                <div class="app-notification__content">


                    <div class="app-notification__content">
                        <li><a class="app-notification__item" href="javascript:;"><span
                                        class="app-notification__icon"><span class="fa-stack fa-lg"><i
                                                class="fa fa-circle fa-stack-2x text-success"></i><i
                                                class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Mesaj Konusu</p>
                                    <p class="app-notification__meta">2 Saat Önce</p>
                                </div>
                            </a></li>
                    </div>
                </div>
                <li class="app-notification__footer"><a href="#">Tüm mesajları gör</a></li>
            </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                        class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <?php foreach ($ayarlar as $ayar) { ?>
                    <li>
                        <a class="dropdown-item" href="<?= $ayar['link'] ?>.php">
                            <i class="fa fa-<?= $ayar['icon'] ?> fa-lg"></i>
                            <?= $ayar['title'] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <?php if (strlen($personel['resim'])) { ?>
            <img class="app-sidebar__user-avatar"
                 width="35%" src="<?= $personel['resim'] ?>">
        <?php } else { ?>
            <img width="50%" height="50%" src="personel_resimleri/resim_yok.PNG">
        <?php } ?>

        <div>
            <p class="app-sidebar__user-name"><?= strtoupper($personel['ad'] . "<br> " . $personel['soyad']) ?></p>
            <p class="app-sidebar__user-designation"><?= $personel['departman'] ?></p>
        </div>
    </div>
    <ul class="app-menu">

        <?php foreach ($menuler as $menu) {
            if ($menu['submenu']) {
                ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-<?= $menu['icon'] ?>"></i>
                        <span class="app-menu__label"><?= $menu['title'] ?></span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php foreach ($menu['submenu'] as $submenu) { ?>
                            <li>
                                <a class="treeview-item" href=" <?= $submenu['link'] ?>.php">
                                    <i class="icon fa fa-<?= $submenu['icon'] ?>"></i>
                                    <?= $submenu['title'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } else { ?>
                <li>
                    <a class="app-menu__item" href="<?= $menu['link'] ?>.php">
                        <i class="app-menu__icon fa fa-<?= $menu['icon'] ?>"></i>
                        <span class="app-menu__label"><?= $menu['title'] ?></span>
                    </a>
                </li>
            <?php }
        } ?>


    </ul>


</aside>