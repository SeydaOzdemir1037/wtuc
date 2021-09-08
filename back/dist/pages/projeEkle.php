<?php include "header.php";


if (!$yetkiler['projeler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['projeler']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    }
}

require_once("../../controller/ProjeController.php");
$projecont = new ProjeController();
$calisma_turleri = $personelcont->calisma_turleri_listele();


$error = [];
if ($_POST) {
    if (empty(trim($_POST['ad']))) {
        array_push($error, "Proje Adı Boş Bırakılamaz!");
    } else {
        $ad = $_POST['ad'];
    }
    if (empty(trim($_POST['baslangic']))) {
        array_push($error, "Başlangıç Tarihi Giriniz!");
    } else {
        $baslangic = $_POST['baslangic'];
    }
    if (empty(trim($_POST['bitis']))) {
        array_push($error, "Bitiş Tarihi Giriniz!");
    } else {
        $bitis = $_POST['bitis'];
    }
    if (empty(trim($_POST['aciklama']))) {
        array_push($error, "Proje Açıklama Kısmını Doldurunuz!");
    } else {
        $aciklama = $_POST['aciklama'];
    }
    $tur_id = $_POST['proje_tur'];

    if (count($error) == 0) {
        $proje_ekle = $projecont->proje_ekle($ad, seo($ad), $tur_id, $baslangic, $bitis, $aciklama, 1);
        if ($proje_ekle) {
            $message = "TAMAM";
            $allowed_extension = array("jpg", "jpeg", "png", "pdf", "doc", "docx");//JPEG YÜKLEMİYOR!!!
            $count = 0;
            if (!empty($_FILES['resim']['name'][0])) {
                if (!file_exists('../../../documents/projeler/' . $proje_ekle)) {
                    mkdir('../../../documents/projeler/' . $proje_ekle, 0777, true);
                }
                foreach ($_FILES['resim']['name'] as $filename) {
                    $temp = '../../../documents/projeler/' . $proje_ekle . '/';
                    $tmp = $_FILES['resim']['tmp_name'][$count];
                    $file_extension = pathinfo($_FILES['resim']['name'][$count], PATHINFO_EXTENSION);
                    if (in_array($file_extension, $allowed_extension)) {
                        $count = $count + 1;
                        $temp = $temp . basename($filename);
                        move_uploaded_file($tmp, $temp);
                    } else {
                        array_push($error, "Desteklenen formatlar: png,jpg,jpeg,pdf,doc,docx");
                    }
                    $temp = '';
                    $tmp = '';
                }
                $count = 0;
            }
        }
        else {
            array_push($error, "HATA");
        }
    }
}

?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>Yeni Proje</h1>
            </div>
        </div>
        <?php if ($message != "") { ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php } ?>
        <?php if (count($error) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($error as $er) { ?>
                    - <?php echo $er; ?><br>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="container-fluid tile">
            <form id="projeEkle" action="projeEkle.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label class="col-form-label">Proje Adı</label>
                        <input type="text" class="form-control" name="ad" id="ad"
                               value="<?= $ad ?>">
                    </div>
                    <div class="col-md-4 col-sm-6 form-group ">
                        <label class="col-form-label">Proje Türü</label>
                        <select class="form-control" name="proje_tur" id="proje_tur">
                            <?php if (empty($tur_id)) { ?>
                                <option value="">Seçiniz</option>
                            <?php } else { ?>
                                <option value="<?= $calisma_tur_bul['id'] ?>"><?= $calisma_tur_bul['tur'] ?></option>
                            <?php }
                            foreach ($calisma_turleri as $tur) {
                                if ($tur['tur'] != $calisma_tur_bul['tur']) { ?>
                                    <option value="<?= $tur['id'] ?>"><?= $tur['tur'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-6 form-group ">
                        <label class="col-form-label">Başlangıç Tarihi</label>
                        <input type="date" class="form-control" name="baslangic" id="baslangic"
                               value="<?= $baslangic ?>">
                    </div>
                    <div class="col-md-4 col-sm-6 form-group ">
                        <label class="col-form-label">Bitiş Tarihi</label>
                        <input type="date" class="form-control" name="bitis" id="bitis"
                               value="<?= $bitis ?>">
                    </div>
                    <div class="form-group col-md-4 col-sm-6">
                        <label class="col-form-label">Proje Resimleri:</label>
                        <div class="col-sm-8">
                            <input type="file" name="resim[]" multiple>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label"
                               for="inputSmall">Açıklama</label>
                        <textarea cols="20" rows="3" class="form-control ckeditor"
                                  name="aciklama" id="aciklama"><?= $aciklama ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right">EKLE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php include "footer.php"; ?>