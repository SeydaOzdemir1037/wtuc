<?php include "header.php";
require_once("../../controller/DepartmanController.php");
$departmancont = new DepartmanController();
$departmangetir = $departmancont->departman_getir();

$error = [];
if ($_POST) {
    require_once "../../controller/IlanController.php";
    $ilancont = new IlanController();
    if (empty(trim($_POST['baslik']))) {
        array_push($error, "İlan Başlığı Boş Bırakılamaz!");
    } else {
        $baslik = $_POST['baslik'];
    }
    if (empty(trim($_POST['aciklama']))) {
        array_push($error, "İlan Detayları Boş Bırakılamaz!");
    } else {
        $aciklama = $_POST['aciklama'];
    }
    if (empty(trim($_POST['son_basvuru_tarih']))) {
        array_push($error, "Son Başvuru Tarihi Boş Bırakılamaz!");
    } else {
        $son_basvuru_tarih = $_POST['son_basvuru_tarih'];
    }
    if (empty(trim($_POST['departman']))) {
        array_push($error, "Departman Boş Bırakılamaz!");
    } else {
        $departman_id = $_POST['departman'];
        $departman_bul = $departmancont->departman_bul($departman_id);
    }
    $maxsira = $ilancont->ilanSiraBul();
    $sira = $maxsira['sira'];
    $sira++;
    $durum_id = 1;

    if (count($error) == 0) {
        $ilan_ekle = $ilancont->ilanEkle($baslik, $departman_id, $aciklama, $durum_id, $sira,$son_basvuru_tarih);

        if ($ilan_ekle) {
            header("Location:ilan-ver.php?ekle=1");
        } else {
            array_push($error, "HATA. TEKRAR DENEYİNİZ");
        }
    }
}
?>


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>İLAN EKLE</h1>
            </div>
        </div>
        <?php if (count($error) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($error as $er) { ?>
                    - <?php echo $er; ?><br>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="row tile">
            <form action="ilan-ekle.php" method="POST">
                <div style="float: left" class="col-md-12 form-group">
                    <div class="form-group">
                        <label class="col-form-label">İlan Başlık</label>
                        <input type="text" class="form-control" name="baslik" id="baslik" value="<?= $baslik ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Departman</label>
                        <select class="form-control" name="departman" id="departman">
                            <?php if (empty($departman_id)) { ?>
                                <option value="">Seçiniz</option>
                            <?php } else { ?>
                                <option value="<?= $departman_bul['id'] ?>"><?= $departman_bul['departman'] ?></option>
                            <?php }
                            foreach ($departmangetir as $departman) {
                                if ($departman['departman'] != $departman_bul['departman']) { ?>
                                    <option value="<?= $departman['id'] ?>"><?= $departman['departman'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Son Başvuru Tarihi</label>
                        <input type="date" class="form-control" name="son_basvuru_tarih" id="son_basvuru_tarih" value="<?= $son_basvuru_tarih ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">İlan Detayları</label>
                        <textarea name="aciklama" id="aciklama" cols="100" rows="10"
                                  class="form-control ckeditor"><?= $aciklama ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right">
                        İlan Ekle
                    </button>
                </div>
            </form>
        </div>
    </main>
<?php include "footer.php"; ?>