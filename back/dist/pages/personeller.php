<?php include "header.php";

if (!$yetkiler['personeller']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}


$personel_getir = $personelcont->personel_listele();

?>


<?php
if ($_GET['ekleme'] == "tamam") {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Ekleme Gerçekleştirildi',
            position: 'topCenter'
        });
    </script>
<?php } ?>





<?php
if ($_GET['durum'] == "tamam") {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'İşlem Gerçekleştirildi Gerçekleştirildi',
            position: 'topCenter'
        });
    </script>
<?php } ?>



<?php
if ($_GET['durum'] == "hata") {
    ?>
    <script>
        iziToast.error({
            title: 'HATA',
            message: 'İşlem gerçekleştirilmedi!',
            position: 'topCenter'
        });
    </script>
<?php } ?>



<?php


if ($_GET['eklenen-personel']) {
    $sicil = $_GET['eklenen-personel'];
    $gecici_sifre = md5("123456789");
    $eklenen_personel = $personelcont->personel_id_getir($sicil);
    $personel_sifre_ver = $personelcont->personel_gecici_sifre_ver($gecici_sifre, $eklenen_personel['personelid']);

    if ($personel_sifre_ver) {
        header("Location:personeller.php?ekleme=tamam");
    } else {
        header("Location:personeller.php?durum=hata");
    }
}

?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Personeller</h1>
        </div>
    </div>

    <div class="tile">
        <?php if ($yetkiler['personeller']['ekleme']) { ?>
            <a class="" href="personelEkle.php">
                <button style="margin: 10px 0 ;" class="btn btn-primary btn-sm  ekle-butonlari"><i
                            class="fa fa-plus"></i>Personel Ekle
                </button>
            </a>
        <?php } else { ?>
            <button style="margin: 10px 0 ;" class="btn btn-primary btn-sm  ekle-butonlari" disabled><i
                        class="fa fa-plus"></i>Personel Ekle
            </button>
        <?php } ?>
        <li class="app-search pull-right">
            <input width="150px" style="border: 1px solid;" class="form-control arama-cubugu" type="search"
                   placeholder="Personellerde ara">
        </li>

        <div class="table-responsive">
            <table class="table table-striped table-bordered" width="100%"
                   cellspacing="0">
                <thead>
                <tr>
                    <th width="20%">
                        <center>Resim</center>
                    </th>
                    <th>
                        <center>Departman</center>
                    </th>
                    <th>
                        <center>Sicil No</center>
                    </th>
                    <th>
                        <center>Ad Soyad</center>
                    </th>
                    <th>
                        <center>Telefon</center>
                    </th>
                    <th>
                        <center>Durum</center>
                    </th>
                    <th width="15%">
                        <center>İşlemler</center>
                    </th>
                </tr>
                </thead>
                <tbody class="myTable">
                <?php foreach ($personel_getir as $getir) { ?>
                    <tr>
                        <td>
                            <center>
                                <?php if(strlen($getir['resim'])){?>
                                <img width="50%" height="50%" src="<?= $getir['resim'] ?>">
                                <?php }else{?>
                                    <img width="50%" height="50%" src="personel_resimleri/resim_yok.PNG">
                                <?php }?>
                            </center>
                        </td>
                        <td>
                            <center><?= $getir['departman'] ?></center>
                        </td>
                        <td>
                            <center><?= $getir['sicil_no'] ?></center>
                        </td>
                        <td>
                            <center><?= $getir['ad'] . " " . $getir['soyad'] ?></center>
                        </td>
                        <td>
                            <center><?= $getir['telefon'] ?></center>
                        </td>
                        <td style="font-weight: bold;">
                            <center><?= $getir['durum'] ?></center>
                        </td>
                        <td>
                            <center>

                                <?php if ($getir['sicil_no'] != $personel['sicil_no']) { ?>

                                    <?php if ($yetkiler['personeller']['icerik_goruntuleme']) { ?>
                                        <a class="btn btn-primary" href="personel-<?= seo($getir['sicil_no']) ?>">
                                            Düzenle
                                        </a>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" disabled>
                                            Düzenle
                                        </button>
                                    <?php }
                                } ?>
                            </center>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</main>


<?php include "footer.php" ?>




