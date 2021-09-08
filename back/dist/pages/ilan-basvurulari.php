<?php include "header.php";
require_once("../../controller/IlanController.php");
require_once("../../controller/UniversiteController.php");

$ilancont = new IlanController();
$unicont = new UniversiteController();



if ($_GET['id']) {
    $id = $_GET['id'];
}
$basvurular = $ilancont->ilanBasvurulari($id);

?>


<?php
if (($_GET['izin-talep'] == "tamam") || ($_GET['odeme-talep'] == "tamam")) {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Talebiniz Oluşturuldu...',
            position: 'topCenter'
        });
    </script>
<?php } ?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>TALEP ET</h1>
        </div>
    </div>

    <div class="tile">
        <div id="accordion" >
            <?php $say = 0;
            foreach ($basvurular as $basvuru) {
                $say++;
                $lisans_uni = $unicont->uni_getir($basvuru['lisans_uni_id']);
                $ylisans_uni = $unicont->uni_getir($basvuru['ylisans_uni_id']);
                $doktora_uni = $unicont->uni_getir($basvuru['doktora_uni_id']);
                $lisans_uni_bolum = $unicont->universite_bolum_getir($basvuru['lisans_bolum_id']);
                $ylisans_uni_bolum = $unicont->universite_bolum_getir($basvuru['ylisans_bolum_id']);
                $doktora_uni_bolum = $unicont->universite_bolum_getir($basvuru['doktora_bolum_id']);

                ?>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <button class="btn btn-link" data-toggle="collapse"
                                data-target="#basvuru<?= $basvuru['basvuruid'] ?>">
                            <?= $say ?>) <?= strtoupper($basvuru['ad_soyad']) ?>
                        </button>
                        <p style="float: right" class="mt-2">
                            <?= date("d-m-Y / H:m:s", strtotime($basvuru['basvuru_tarih'])) ?>
                        </p>

                    </div>
                    <div id="basvuru<?= $basvuru['basvuruid'] ?>" class="collapse " aria-labelledby="headingOne"
                         data-parent="#accordion">
                        <div class="card-body ilanBasvurular row">
                            <div class="col-md-4">
                                <label>TC No</label>
                                <p><?= $basvuru['tc_no'] ?></p>
                                <label>Ad Soyad</label>
                                <p><?= $basvuru['ad_soyad'] ?></p>
                            </div>
                            <div class="col-md-4">
                                <label>E-mail</label>
                                <p><?= $basvuru['mail'] ?></p>
                                <label>Telefon Numarası</label>
                                <p><?= $basvuru['telefon'] ?></p>
                                <label>Doğum Tarihi/Yeri</label>
                                <p><?= date("d-m-Y", strtotime($basvuru['d_tarih'])) ?> / <?= $basvuru['il'] ?></p>
                            </div>
<div class="col-md-4">
    <label>Lisans üniversite/Bölüm</label>
    <p><?= $lisans_uni['universite'] ?> / <?= $lisans_uni_bolum['bolum'] ?></p>
    <label>Yüksek Lisans üniversite/Bölüm</label>
    <p><?= $ylisans_uni['universite'] ?> / <?= $ylisans_uni_bolum['bolum'] ?></p>
    <label>Doktora üniversite/Bölüm</label>
    <p><?= $doktora_uni['universite'] ?> / <?= $doktora_uni_bolum['bolum'] ?></p>
</div>


                        </div>
                    </div>
                </div>
                <br>
            <?php } ?>

        </div>
    </div>

</main>


<?php include "footer.php" ?>

