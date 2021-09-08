<?php include "header.php";
require_once("../../controller/IzinController.php");
$izincont = new IzinController();
$izin_sebepleri = $izincont->izin_sebepler_getir();

require_once("../../controller/OdemeController.php");
$odemecont = new OdemeController();
$odemeler = $odemecont->odeme_turleri_cek();


$errorIzin = [];
$errorOdeme = [];
$talepTarih=$bugunun_tarihi->format("Y-m-d");
if (isset($_POST["izinTalep"])) {
    $izinSebep=$_POST["sebep"];
    if (empty(trim($_POST['baslangic']))) {
        array_push($errorIzin, "İzin Başlangıç Tarihi Boş Bırakılamaz!");
    } else {
        $baslangic = $_POST["baslangic"];
    }
    if (empty(trim($_POST['bitis']))) {
        array_push($errorIzin, "İzin Bitiş Tarihi Boş Bırakılamaz!");
    } else {
        $bitis = $_POST["bitis"];
    }
    if (empty(trim($_POST['aciklama']))) {
        array_push($errorIzin, "İzin Açıklama Boş Bırakılamaz!");
    } else {
        $aciklama = $_POST["aciklama"];
    }
    if (count($errorIzin) == 0) {
        $izin_talep=$izincont->izin_talep_et($personel["personelid"],3,$izinSebep,$aciklama,$talepTarih,$baslangic,$bitis);
        if($izin_talep){
            header("Location:izin-talep.php?izin-talep=tamam");
        }
        else{?>
            <script>
                iziToast.error({
                    title: 'HATA',
                    message: 'Talep oluşturulmadı...',
                    position: 'topCenter'
                });
            </script>
        <?php }
    }
}

if (isset($_POST["odemeTalep"])) {
    $odeme_tipi=$_POST["odeme_turu"];
    if (empty(trim($_POST['miktar']))) {
        array_push($errorOdeme, "Ödenmesi İstenen Miktar Boş Bırakılamaz!");
    } else {
        $miktar = $_POST["miktar"];
    }
    if (count($errorOdeme) == 0) {
        $odeme_talep=$odemecont->odeme_talep_et($personel["personelid"],$odeme_tipi,3,$miktar,$talepTarih);
        if($odeme_talep){
            header("Location:izin-talep.php?odeme-talep=tamam");
        }
        else{?>
            <script>
                iziToast.error({
                    title: 'HATA',
                    message: 'Talep oluşturulmadı...',
                    position: 'topCenter'
                });
            </script>
        <?php }
    }
}

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
        <?php if (count($errorIzin) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errorIzin as $er) { ?>
                    - <?php echo $er; ?><br>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (count($errorOdeme) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errorOdeme as $er) { ?>
                    - <?php echo $er; ?><br>
                <?php } ?>
            </div>
        <?php } ?>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                            İZİN TALEP ET
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <form action="izin-talep.php" method="post">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Başlama Tarihi</label>
                                    <input type="date" class="form-control" name="baslangic" id="bugun_tarih"
                                           value="<?= $baslangic ?>"
                                           min="<?= $bugunun_tarihi->format("Y-m-d") ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Bitiş Tarihi</label>
                                    <input type="date" class="form-control" name="bitis" id="yeni_tarih"
                                           value="<?= $bitis ?>"
                                           min="<?= $bugunun_tarihi->format("Y-m-d") ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Sebep</label>
                                    <select class="form-control" name="sebep" id="">
                                        <?php foreach ($izin_sebepleri as $sebep) { ?>
                                            <option value="<?= $sebep['id'] ?>"><?= $sebep['sebep'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Açıklama</label>
                                    <textarea cols="30" rows="5" name="aciklama"
                                              class="form-control"><?= $aciklama ?></textarea>
                                </div>

                            </div>
                            <button type="submit" name="izinTalep"
                                    class="btn btn-danger pull-right m-2">TALEP ET
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            ÖDEME TALEP ET
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <form action="izin-talep.php" method="post">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Ödeme Türü</label>
                                    <select name="odeme_turu" class="form-control">
                                        <?php foreach ($odemeler as $odeme) { ?>
                                            <option value="<?= $odeme['id'] ?>"><?= $odeme['tip'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Miktar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="miktar">
                                        <div class="input-group-append"><span class="input-group-text">TL</span></div>
                                    </div>

                                </div>


                                <button type="submit" name="odemeTalep"
                                        class="btn btn-danger pull-right m-2">TALEP ET
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>


<?php include "footer.php" ?>

