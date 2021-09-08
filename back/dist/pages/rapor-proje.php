<!DOCTYPE html>
<html>
<head>
    <title>Proje Raporu</title>
    <style type="text/css">
        .icerik {
            width: 100%;
            margin: auto;
        }

        table {
            width: 100%;
            margin: 15px 0;
        }

        table tr td {
            padding: 4px;
        }

        .baslik {

            font-weight: bold;
        }

        .ortabaslik {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<!-- <body onload="window.print()"> -->
<body onload="window.print()">

<?php

require_once("../../controller/DBController.php");
require_once("../../controller/ProjeController.php");
require_once("../../controller/menu_yonetimi.php");
$projecont = new ProjeController();
$menulercont = new menu_yonetimi();
$bugunun_tarihi = new DateTime();
if ($_GET['proje']) {
    $proje_seo = $_GET['proje'];
    $projeBilgi = $projecont->proje_bul($proje_seo);
    $proje_gorevlileri_bul = $projecont->projedeki_gorevlileri_bul($projeBilgi['projeid']);
    $projeResimleri=glob("../../../documents/projeler/" . $projeBilgi['projeid'] . "/*.*");
}


?>


<main class="app-content">
<!--    <div style="text-align: right;margin-top: 50px;">--><?//=$bugunun_tarihi->format("d/m/Y")?><!--</div>-->
    <div class="icerik">
        <h3 class="ortabaslik"><?= $projeBilgi['proje_adi'] ?></h3>
        <div class="table-responsive">

            <table border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="4" class="ortabaslik">PROJE BİLGİLERİ</td>
                </tr>
                <tr>
                    <td class="baslik">Proje Türü</td>
                    <td><?= $projeBilgi['tur'] ?></td>
                </tr>
                <tr>
                    <td class="baslik">Proje Durumu</td>
                    <td><?= $projeBilgi['durum'] == "AKTİF" ? "Proje Aktif" : "Proje Pasif" ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="ortabaslik">PROJE TARİHLERİ</td>
                </tr>
                <tr>
                    <td class="baslik">Başlangıç Tarihi:</td>
                    <td><?=date("d/m/Y",strtotime($projeBilgi['baslangic_tarih']))?></td>
                </tr>
                <tr>
                    <td class="baslik">Bitiş Tarihi:</td>
                    <td><?=date("d/m/Y",strtotime($projeBilgi['bitis_tarih']))?></td>
                </tr>
                <tr>
                    <td class="baslik">Süre</td>
                    <td colspan="2"><?php $sure_hesapla = $menulercont->sure_hesaplama($projeBilgi['baslangic_tarih'], $projeBilgi['bitis_tarih']);
                        echo "<b>" . $sure_hesapla . " gün </b>"; ?></td>
                </tr>
                <tr>
                    <td class="baslik">Proje Durumu</td>
                    <td colspan="2"><?php if ($projeBilgi['bitis_tarih'] < $bugunun_tarihi->format("Y-m-d")) { ?>
                            Proje Bitti
                        <?php } else { ?>
                            Proje Devam Ediyor
                        <?php } ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="ortabaslik">PROJE AÇIKLAMA</td>
                </tr>
                <tr>
                    <td colspan="4"><?=$projeBilgi['aciklama']?></td>
                </tr>
            </table>
            <?php if($proje_gorevlileri_bul){?>
            <table border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="4" class="ortabaslik">PROJEDEKİ GÖREVLİLER</td>
                </tr>
                <?php foreach ($proje_gorevlileri_bul as $gorevliler){?>
                    <tr>
                        <td class="baslik">Ad-Soyad</td>
                        <td><?=$gorevliler["ad"]." ".strtoupper($gorevliler['soyad'])?></td>
                        <td class="baslik">Sicil No</td>
                        <td><?=$gorevliler["sicil_no"]?></td>
                    </tr>
                <?php }?>
            </table>
            <?php }?>
            <?php if($projeResimleri){?>
                <table border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="4" class="ortabaslik">PROJE RESİMLERİ</td>
                    </tr>
                    <tr>
                        <td colspan="2">    <?php foreach ($projeResimleri as $file){
                                $endimg=explode('/',$file); ?>
                                <?php if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg" || pathinfo($file, PATHINFO_EXTENSION) == "png") { ?>
                                    <img style="margin: 2px 2px;" width="100px" height="100px" src="<?= $file ?>">
                                <?php } else { ?>
                                    <div style="width: 100px;height: 100px;float: left;margin: 2px 2px">
                                        <a href="<?php echo $file; ?>" style="color:black"><?php echo $endimg[6]; ?></a>
                                    </div>
                                <?php } ?>
                            <?php }?></td>
                    </tr>

                </table>
            <?php }?>
        </div>
    </div>
</main>
</body>
</html>

