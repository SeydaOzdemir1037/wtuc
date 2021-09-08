<?php include "header.php";


if (!$yetkiler['anasayfa']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}else{
    if(!$yetkiler['anasayfa']['icerik_goruntuleme']){
        header("Location:yetkiYok.php");
    }
}



require_once("../../controller/DBController.php");
require_once("../../controller/SosyalMedyaController.php");
require_once("../../controller/DurumController.php");
$sosyalmedyacont = new SosyalMedyaController();
$durumcont = new DurumController();
$sosyalmedya = $sosyalmedyacont->sosyal_medya_getir();


if ($_GET['sil']) {
    $id = $_GET['sil'];
    $flag = $sosyalmedyacont->sosyal_medya_sil($id);
    if ($flag) {
        header("Location:sosyal-medya-ayar.php?durum=ok");
    }
}

?>

<?php if ($_GET['durum'] == "ok") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Silindi!',
            position: 'topCenter'
        });
    </script>
<?php } ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>SOSYAL MEDYA</h1>
        </div>
    </div>
    <div class="row tile">
        <div class="table-responsive">
            <?php if($yetkiler['anasayfa']['ekleme']){ ?>
                <button style="margin: 10px" type="button" class="btn btn-sm btn-primary ekle-butonlari"
                        data-toggle="modal" data-target="#sosyal-medya-ekle"><i class="fa fa-plus"></i> Sosyal medya
                    ekle
                </button>
            <?php } else { ?>
                <button style="margin: 10px" class="btn btn-sm btn-primary ekle-butonlari" disabled><i
                            class="fa fa-plus"></i> Sosyal medya ekle
                </button>
            <?php } ?>
            <li class="app-search pull-right">
                <input width="150px" style="border: 1px solid;" class="form-control arama-cubugu" type="search"
                       placeholder="Sosyal meyda ara">
            </li>

            <table class="table table-striped table-bordered" id="dataTable" width="100%"
                   cellspacing="0">
                <thead>
                <tr>
                    <th>
                        <center>Sosyal Medya adı</center>
                    </th>
                    <th>
                        <center>Link</center>
                    </th>
                    <th>
                        <center>İcon</center>
                    </th>
                    <th>
                        <center>Durum</center>
                    </th>
                    <th width="20%">
                        <center>İşlemler</center>
                    </th>
                </tr>
                </thead>
                <tbody class="myTable">
                <?php foreach ($sosyalmedya

                               as $medya) { ?>
                    <tr>
                        <td>
                            <center><?= $medya['isim'] ?></center>
                        </td>
                        <td>
                            <center><?= $medya['link'] ?></center>
                        </td>
                        <td>
                            <center><i style="font-size: 25px" class="fa fa-<?= $medya['icon'] ?>"></i></center>
                        </td>
                        <td>
                            <center>
                                <div class="toggle lg">
                                    <label>
                                        <?php if($yetkiler['anasayfa']['duzenleme']){ ?>
                                            <input type="checkbox" class="sosyal_medya_aktifPasif"
                                                   id="<?= $medya['id'] ?> "<?= (($medya['durum']) == "AKTİF" ? 'checked' : null) ?> >
                                            <span
                                                    class="button-indecator"></span>
                                        <?php } else { ?>
                                            <input type="checkbox"<?= (($medya['durum']) == "AKTİF" ? 'checked' : null) ?>
                                                   disabled>
                                            <span class="button-indecator"></span>
                                        <?php } ?>
                                    </label>
                                </div>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php if($yetkiler['anasayfa']['duzenleme']){ ?>
                                <a data-toggle="modal" href="#duzenle_sosyal<?= $medya['id'] ?>">
                                    <button class="btn btn-success btn-sm">Düzenle
                                    </button>
                                </a>
                                <?php } else { ?>
                                    <button class="btn btn-success btn-sm" disabled>Düzenle</button>
                                <?php }   if($yetkiler['anasayfa']['silme']){ ?>
                                <button data-url="sosyal-medya-ayar.php?sil=<?= $medya['id'] ?>"
                                        class="btn btn-dark btn-sm sil-sweet">
                                    Sil
                                </button>
                                <?php } else { ?>
                                    <button class="btn btn-dark btn-sm " disabled>
                                        Sil
                                    </button>
                                <?php } include "sosyal-medya-duzenle.php" ?>
                            </center>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include "sosyal-medya-ekle.php" ?>


<?php include "footer.php"; ?>
