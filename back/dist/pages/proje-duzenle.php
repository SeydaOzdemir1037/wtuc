<?php include "header.php";


if (!$yetkiler['projeler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['projeler']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    } else {
        if (!$yetkiler['projeler']['duzenleme']) {
            header("Location:yetkiYok.php");
        }
    }
}

if ($_GET["proje-id"]) {
    $proje_seo = $_GET["proje-id"];
}

require_once("../../controller/ProjeController.php");
$projecont = new ProjeController();
$proje_bul = $projecont->proje_bul($proje_seo);

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslangic_tarihi = $_POST['baslama_tarih'];
    $proje_tur = $_POST['proje_tur'];
    if (empty(trim($_POST['proje_adi']))) {
        array_push($error, "Proje Adı Boş Bırakılamaz!");
    } else {
        $proje_adi = $_POST['proje_adi'];
    }
    if (empty(trim($_POST['bitis_tarih']))) {
        array_push($error, "Bitiş Tarihi Boş Bırakılamaz!");
    } else {
        $bitis_tarih = $_POST["bitis_tarih"];
    }
    if ($_POST["baslama_tarih"] > $_POST["bitis_tarih"]) {
        array_push($error, "Başlangıç Tarihi Bitiş Tarihinden Büyük Olamaz!");
    }
    if (empty(trim($_POST['proje_aciklama']))) {
        array_push($error, "Açıklama Boş Bırakılamaz!");
    } else {
        $proje_aciklama = $_POST["proje_aciklama"];
    }
    if (count($error) == 0) {
        $proje_guncelle = $projecont->proje_guncelle($proje_adi, $proje_aciklama, $proje_tur, $baslangic_tarihi, $bitis_tarih, seo($proje_adi), $proje_bul['projeid']);
        if ($proje_guncelle) {
            header("Location:projeler.php?guncelleme=tamam");
        } else {
            ?>
            <script>
                iziToast.error({
                    title: 'HATA',
                    message: 'Proje Güncellenemedi...',
                    position: 'topCenter'
                });
            </script>
        <?php }
    }
}


$proje_gorevlileri_bul = $projecont->projedeki_gorevlileri_bul($proje_bul['projeid']);
?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><?= $proje_bul['proje_adi'] ?></h1>
        </div>
    </div>
    <div class="container-fluid tile">
        <ul class="nav nav-pills">
            <li class="nav-item mr-2">
                <a class="btn btn-primary" href="resimler-proje.php?projeResim=<?=$proje_bul['projeid']?>">Proje Resimleri</a>
            </li>

            <li class="nav-item ml-auto mr-2">
                <a data-toggle="modal" class="btn btn-primary pull-right" href="#proje-gorevliler">
                    Projedeki Görevliler
                </a>
            </li>
        </ul>
    </div>

    <div class="container-fluid tile">
        <?php if (count($error) > 0) { ?>
            <div class="alert alert-danger">
                <?php foreach ($error as $er) { ?>
                    - <?php echo $er; ?><br>
                <?php } ?>
            </div>
        <?php } ?>
        <form action="proje-<?= seo($proje_seo) ?>" method="POST">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Proje Adı</label>
                    <input type="text" class="form-control" value="<?= $proje_bul['proje_adi'] ?>" name="proje_adi"
                           id="">
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Başlangıç Tarihi</label>
                    <input type="date" class="form-control" name="baslama_tarih"
                           value="<?= $proje_bul['baslangic_tarih'] ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Bitiş Tarihi</label>
                    <input type="date" class="form-control" name="bitis_tarih"
                           value="<?= $proje_bul['bitis_tarih'] ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Proje Türü</label>
                    <select class="form-control" name="proje_tur">
                        <option value="<?= $proje_bul['calisma_tur_id'] ?>"><?= $proje_bul['tur'] ?></option>
                        <?php foreach ($calisma_turleri as $calisma) {
                            if ($proje_bul['calisma_tur_id'] != $calisma['id']) { ?>
                                <option value="<?= $calisma['id'] ?>"><?= $calisma['tur'] ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Proje Açıklama</label>
                    <div class="form-group">
                                <textarea id="" cols="30" rows="3" class="form-control ckeditor"
                                          name="proje_aciklama"><?= $proje_bul['aciklama'] ?></textarea>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right" id="genel_kaydet"
                            name="genel_kaydet">KAYDET
                    </button>
                </div>
        </form>
    </div>

    <div class="modal fade " id="proje-gorevliler">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">"<?= $proje_bul['proje_adi'] ?>" Projesi Görevlileri</h4>
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"
                                                                                   aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-bordered" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr>
                            <th>
                                <center>Ad-Soyad</center>
                            </th>
                            <th>
                                <center>Sicil No</center>
                            </th>
                            <th>
                                <center>TC</center>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="myTable">
                        <?php foreach ($proje_gorevlileri_bul as $gorevli_bul) { ?>
                            <tr>
                                <td><?=$gorevli_bul["ad"]?> <?=strtoupper($gorevli_bul["soyad"])?></td>
                                <td><?=$gorevli_bul["sicil_no"]?> </td>
                                <td><?=$gorevli_bul["tc_no"]?> </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</main>

<?php include "footer.php" ?>

