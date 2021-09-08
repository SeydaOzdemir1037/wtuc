<?php include "header.php";

if (!$yetkiler['izinler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}



require_once("../../controller/IzinController.php");
$izincont = new IzinController();

require_once("../../controller/OdemeController.php");
$odemecont = new OdemeController();

$izinler_onay_bekleyen = $izincont->izinler_getir(3);
$izinler_onaylanan = $izincont->izinler_getir(4);
$izinler_reddedilen = $izincont->izinler_getir(5);

$odemeler_onay_bekleyen = $odemecont->odemeler_getir(3);
$odemeler_onaylanan = $odemecont->odemeler_getir(4);
$odemeler_reddedilen = $odemecont->odemeler_getir(5);


if ($_GET["izin-onayla"]) {
    $onayla = $_GET["izin-onayla"];
    $izinonayla = $izincont->izin_guncelle(4, $onayla);
    if ($izinonayla) {
        header("Location:izinler.php?onay=tamam");
    } else {
        header("Location:izinler.php?onay=hata");

    }
}

if ($_GET["izin-reddet"]) {
    $reddet = $_GET["izin-reddet"];
    $izinreddet = $izincont->izin_guncelle(5, $reddet);
    if ($izinreddet) {
        header("Location:izinler.php?reddet=tamam");
    } else {
        header("Location:izinler.php?reddet=hata");

    }
}

if ($_GET["odeme-onayla"]) {
    $onayla = $_GET["odeme-onayla"];
    $odemeonayla = $odemecont->odeme_guncelleme(4, $onayla);
    if ($odemeonayla) {
        header("Location:izinler.php?onay=tamam");
    } else {
        header("Location:izinler.php?onay=hata");
    }
}

if ($_GET["odeme-reddet"]) {
    $reddet = $_GET["odeme-reddet"];
    $odemereddet = $odemecont->odeme_guncelleme(5, $reddet);
    if ($odemereddet) {
        header("Location:izinler.php?reddet=tamam");
    } else {
        header("Location:izinler.php?reddet=hata");
    }
}

?>


<?php
if (($_GET['onay'] == "tamam")||($_GET['reddet'] == "tamam")) {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            position: 'topCenter'
        });
    </script>
<?php } ?>
<?php
if (($_GET['onay'] == "hata")||($_GET['reddet'] == "hata")) {
    ?>
    <script>
        iziToast.error({
            title: 'HATA',
            position: 'topCenter'
        });
    </script>
<?php } ?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>TALEPLER</h1>
        </div>
    </div>

    <div class="tile">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                            İZİN TALEPLERİ
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">

                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#onayBekleyenIzın">Onay
                                    Bekleyen(<?= count($izinler_onay_bekleyen) ?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill"
                                   href="#onaylananIzın">Onaylanan(<?= count($izinler_onaylanan) ?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill"
                                   href="#reddedilenIzın">Reddedilen(<?= count($izinler_reddedilen) ?>)</a>
                            </li>
                        </ul>
                        <div class="container-fluid tab-content">
                            <div class="tab-pane container-fluid active" id="onayBekleyenIzın">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil_no</center>
                                            </th>
                                            <th>
                                                <center>Başlangıç</center>
                                            </th>
                                            <th>
                                                <center>Bitiş</center>
                                            </th>
                                            <th>
                                                <center>Süre</center>
                                            </th>
                                            <th>
                                                <center>Sebep</center>
                                            </th>
                                            <th>
                                                <center>Açıklama</center>
                                            </th>
                                            <th>
                                                <center>İşlemler</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($izinler_onay_bekleyen as $izin) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['talep_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['baslama_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['bitis_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?php
                                                        $izin_hesapla = $menulercont->sure_hesaplama($izin['baslama_tarih'], $izin['bitis_tarih']);
                                                        echo "<b>" . $izin_hesapla . " gün </b>";
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sebep'] ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button class="btn btn-outline btn-dark btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#aciklama<?= $izin['izinlerid'] ?>">
                                                            Açıklamayı Gör
                                                        </button>
                                                        <div class="modal fade" id="aciklama<?= $izin['izinlerid'] ?>">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title text-center">
                                                                            Açıklama</h4>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">
                                                                            <span class="fa fa-times"
                                                                                  aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <?= $izin['aciklama'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($yetkiler['izinler']['duzenleme']) { ?>
                                                            <button data-url="izinler.php?izin-onayla=<?= $izin['izinlerid'] ?>"
                                                                    class="btn btn-dark btn-sm sil-sweet">
                                                                Onayla
                                                            </button>
                                                            <button data-url="izinler.php?izin-reddet=<?= $izin['izinlerid'] ?>"
                                                                    class="btn btn-dark btn-sm sil-sweet">
                                                                Reddet
                                                            </button>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane container-fluid  fade" id="onaylananIzın">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil_no</center>
                                            </th>
                                            <th>
                                                <center>Başlangıç</center>
                                            </th>
                                            <th>
                                                <center>Bitiş</center>
                                            </th>
                                            <th>
                                                <center>Süre</center>
                                            </th>
                                            <th>
                                                <center>Sebep</center>
                                            </th>
                                            <th>
                                                <center>Açıklama</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($izinler_onaylanan as $izin) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['talep_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['baslama_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['bitis_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?php
                                                        $izin_hesapla = $menulercont->sure_hesaplama($izin['baslama_tarih'], $izin['bitis_tarih']);
                                                        echo "<b>" . $izin_hesapla . " gün </b>";
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sebep'] ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button class="btn btn-outline btn-dark btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#aciklama<?= $izin['izinlerid'] ?>">
                                                            Açıklamayı Gör
                                                        </button>
                                                        <div class="modal fade" id="aciklama<?= $izin['izinlerid'] ?>">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title text-center">
                                                                            Açıklama</h4>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">
                                                                            <span class="fa fa-times"
                                                                                  aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <?= $izin['aciklama'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane container-fluid  fade" id="reddedilenIzın">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil_no</center>
                                            </th>
                                            <th>
                                                <center>Başlangıç</center>
                                            </th>
                                            <th>
                                                <center>Bitiş</center>
                                            </th>
                                            <th>
                                                <center>Süre</center>
                                            </th>
                                            <th>
                                                <center>Sebep</center>
                                            </th>
                                            <th>
                                                <center>Açıklama</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($izinler_reddedilen as $izin) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['talep_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['baslama_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?= date("d/m/Y", strtotime($izin['bitis_tarih'])) ?></center>
                                                </td>
                                                <td>
                                                    <center><?php
                                                        $izin_hesapla = $menulercont->sure_hesaplama($izin['baslama_tarih'], $izin['bitis_tarih']);
                                                        echo "<b>" . $izin_hesapla . " gün </b>";
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center> <?= $izin['sebep'] ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button class="btn btn-outline btn-dark btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#aciklama<?= $izin['izinlerid'] ?>">
                                                            Açıklamayı Gör
                                                        </button>
                                                        <div class="modal fade" id="aciklama<?= $izin['izinlerid'] ?>">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title text-center">
                                                                            Açıklama</h4>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">
                                                                            <span class="fa fa-times"
                                                                                  aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <?= $izin['aciklama'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </center>
                                                </td>

                                            </tr>
                                        <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            ÖDEME TALEPLERİ
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">

                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#onayBekleyenOdeme">Onay
                                    Bekleyen(<?=count($odemeler_onay_bekleyen)?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#onaylananOdeme">Onaylanan(<?=count($odemeler_onaylanan)?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reddedilenOdeme">Reddedilen(<?=count($odemeler_reddedilen)?>)</a>
                            </li>
                        </ul>
                        <div class="container-fluid tab-content">
                            <div class="tab-pane container-fluid active" id="onayBekleyenOdeme">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil No</center>
                                            </th>
                                            <th>
                                                <center>İşlem</center>
                                            </th>
                                            <th>
                                                <center>Tutar</center>
                                            </th>
                                            <th>
                                                <center>İşlemler</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($odemeler_onay_bekleyen as $odeme) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= ($odeme['talep_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['tip'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['odenen_miktar'] ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($yetkiler['izinler']['duzenleme']) { ?>
                                                            <button data-url="izinler.php?odeme-onayla=<?= $odeme['odemeid'] ?>"
                                                                    class="btn btn-dark btn-sm sil-sweet">
                                                                Onayla
                                                            </button>
                                                            <button data-url="izinler.php?odeme-reddet=<?= $odeme['odemeid'] ?>"
                                                                    class="btn btn-dark btn-sm sil-sweet">
                                                                Reddet
                                                            </button>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane container-fluid  fade" id="onaylananOdeme">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil No</center>
                                            </th>
                                            <th>
                                                <center>İşlem</center>
                                            </th>
                                            <th>
                                                <center>Tutar</center>
                                            </th>
                                            <th>
                                                <center>Onaylanma Tarihi</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($odemeler_onaylanan as $odeme) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= ($odeme['talep_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['tip'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['odenen_miktar'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= ($odeme['odeme_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane container-fluid  fade" id="reddedilenOdeme">
                                <div class="table-responsive mt-2">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>
                                                <center>Talep Tarihi</center>
                                            </th>
                                            <th>
                                                <center>Ad</center>
                                            </th>
                                            <th>
                                                <center>Soyad</center>
                                            </th>
                                            <th>
                                                <center>Sicil No</center>
                                            </th>
                                            <th>
                                                <center>İşlem</center>
                                            </th>
                                            <th>
                                                <center>Tutar</center>
                                            </th>
                                            <th>
                                                <center>Reddedilme Tarihi</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="myTable">
                                        <?php foreach ($odemeler_reddedilen as $odeme) { ?>
                                            <tr>
                                                <td>
                                                    <center><?= ($odeme['talep_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['ad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['soyad'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['sicil_no'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['tip'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $odeme['odenen_miktar'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?= ($odeme['odeme_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>


<?php include "footer.php" ?>

