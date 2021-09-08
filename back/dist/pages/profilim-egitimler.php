<?php
require_once("../../controller/UniversiteController.php");
$unicont = new UniversiteController();


if (isset($_POST['egitimler'])) {
    $sicil_no = $personel['sicil_no'];
    if (empty(trim($_POST['lisans_uni']))) {
        $lisans_uni_id = 0;
    } else {
        $lisans_uni_id = $_POST['lisans_uni'];
    }
    if (empty(trim($_POST['lisans_bolum']))) {
        $lisans_bolum_id = 0;
    } else {
        $lisans_bolum_id = $_POST['lisans_bolum'];
    }
    if (empty(trim($_POST['ylisans_uni']))) {
        $ylisans_uni_id = 0;
    } else {
        $ylisans_uni_id = $_POST['ylisans_uni'];
    }
    if (empty(trim($_POST['ylisans_bolum']))) {
        $ylisans_bolum_id = 0;
    } else {
        $ylisans_bolum_id = $_POST['ylisans_bolum'];
    }
    if (empty(trim($_POST['doktora_uni']))) {
        $doktora_uni_id = 0;
    } else {
        $doktora_uni_id = $_POST['doktora_uni'];
    }
    if (empty(trim($_POST['doktora_bolum']))) {
        $doktora_bolum_id = 0;
    } else {
        $doktora_bolum_id = $_POST['doktora_bolum'];
    }

    $egitim_guncelle = $personelcont->profilim_egitimler_guncelle($lisans_uni_id, $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id,
        $doktora_uni_id, $doktora_bolum_id, $sicil_no);
    if ($egitim_guncelle) {
        header("Location:profilim.php?egitimler=tamam");
    }




}



$universiteler = $unicont->universite_getir();
$lisans_uni = $unicont->uni_getir($personel['lisans_uni_id']);
$ylisans_uni = $unicont->uni_getir($personel['ylisans_uni_id']);
$doktora_uni = $unicont->uni_getir($personel['doktora_uni_id']);
$lisans_uni_bolum = $unicont->universite_bolum_getir($personel['lisans_bolum_id']);
$ylisans_uni_bolum = $unicont->universite_bolum_getir($personel['ylisans_bolum_id']);
$doktora_uni_bolum = $unicont->universite_bolum_getir($personel['doktora_bolum_id']);

?>

<?php if ($_GET['egitimler']=="tamam") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Eğitimler güncellendi',
            position: 'topCenter'
        });
    </script>
<?php } ?>





<div class="col-md-12 ">
    <form action="profilim.php" method="POST">
        <div class="widget-body row">
            <div class="col-md-4 "><br>
                <h6 class="text-center">LİSANS</h6>
                <div class="form-group">
                    <label>Üniversite</label>
                    <select class="form-control" id="lisans_uni" name="lisans_uni">
                        <option value="<?= $lisans_uni['id'] ?>"><?= $lisans_uni['universite'] ?></option>
                        <?php foreach ($universiteler as $uni) { ?>
                            <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label>Bölüm</label>
                    <select class="form-control" id="lisans_bolum" name="lisans_bolum">
                        <option value="<?= $lisans_uni_bolum['id'] ?>">
                            <?= $lisans_uni_bolum['bolum'] ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 yan-cizgi"><br>
                <h6 class="text-center">YÜKSEK LİSANS</h6>
                <div class="form-group">
                    <label>Üniversite</label>
                    <select class="form-control" id="ylisans_uni" name="ylisans_uni">
                        <option value="<?= $ylisans_uni['id'] ?>"><?= $ylisans_uni['universite'] ?></option>
                        <?php foreach ($universiteler as $uni) { ?>
                            <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bölüm</label>
                    <select class="form-control" id="ylisans_bolum" name="ylisans_bolum">
                        <option value="<?= $ylisans_uni_bolum['id'] ?>">
                            <?= $ylisans_uni_bolum['bolum'] ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 yan-cizgi"><br>
                <h6 class="text-center">DOKTORA</h6>
                <div class="form-group">
                    <label>Üniversite</label>
                    <select class="form-control" id="doktora_uni" name="doktora_uni">
                        <option value="<?= $doktora_uni['id'] ?>"><?= $doktora_uni['universite'] ?></option>
                        <?php foreach ($universiteler as $uni) { ?>
                            <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bölüm</label>
                    <select class="form-control" id="doktora_bolum" name="doktora_bolum">
                        <option value="<?= $doktora_uni_bolum['id'] ?>"><?= $doktora_uni_bolum['bolum'] ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right" name="egitimler">KAYDET</button>
            </div>
        </div>
    </form>
</div><!-- .widget-body -->

