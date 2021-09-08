<?php include "header.php";
if (!$yetkiler['anasayfa']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['anasayfa']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    }
}
require_once "../../controller/IlanController.php";
$ilancont = new IlanController();
$guncelilanlar = $ilancont->Ilanlar();
//$suresidolanilanlar = $ilancont->suresiDolanIlanlar();

if ($_GET['sil']) {
    $id = $_GET['sil'];
    $flag = $ilancont->ilan_sil($id);
    if ($flag) {
        header("Location:ilan-ver.php?durum=ok");
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
            <div><h1>İLANLAR</h1></div>
        </div>
        <div class="row tile">
            <div class="col-md-12">
                <a href="ilan-ekle.php" class="btn btn-primary btn-sm  ekle-butonlari">
                    <i
                            class="fa fa-plus"></i>İlan Ekle
                </a>
            </div>
            <?php if ($_GET['ekle'] == "1") { ?>
                <script>
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'İlan Eklendi!',
                        position: 'topCenter'
                    });
                </script>
            <? } ?>
            <div class="col-md-12">
                <h3 class="tile-title">Tüm İlanlar</h3>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#guncel">Güncel İlanlar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dolan">Süresi Dolan İlanlar</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="guncel">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İlan Başlık</th>
                                <th>Departman Bilgisi</th>
                                <th>Detaylar</th>
                                <th>Yayınlanma Tarihi</th>
                                <th>Son Başvuru Tarihi</th>
                                <th>Durum</th>
                                <th></th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($guncelilanlar as $ilan) {

                                if ($ilan['son_basvuru_tarih'] > $bugunun_tarihi->format("Y-m-d")) { ?>
                                    <tr>
                                        <td><?= $ilan['ilanid'] ?></td>
                                        <td><?= $ilan['baslik'] ?></td>
                                        <td><?= $ilan['departman'] ?></td>
                                        <td>
                                            <center>
                                                <button class="btn btn-outline btn-dark btn-sm" data-toggle="modal"
                                                        data-target="#aciklama<?= $ilan['ilanid'] ?>">
                                                    Detay Görüntüle
                                                </button>
                                                <div class="modal fade" id="aciklama<?= $ilan['ilanid'] ?>">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-center">İlan Detayları</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <?= $ilan['aciklama'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </center>
                                        </td>

                                        <td><?= $ilan['tarih'] ?></td>
                                        <td><?= $ilan['son_basvuru_tarih'] ?></td>
                                        <td>
                                            <center>
                                                <div class="toggle lg">
                                                    <label>
                                                        <?php if ($yetkiler['ilan-ver']['duzenleme']) { ?>
                                                            <input type="checkbox" class="ilanDurum_aktifPasif"
                                                                   id="<?= $ilan['ilanid'] ?> "<?= (($ilan['durum']) == "AKTİF" ? 'checked' : null) ?> >
                                                            <span class="button-indecator"></span>
                                                        <?php } else { ?>
                                                            <input type="checkbox"<?= (($ilan['durum']) == "AKTİF" ? 'checked' : null) ?>
                                                                   disabled>
                                                            <span class="button-indecator"></span>
                                                        <?php } ?>
                                                    </label>
                                                </div>
                                            </center>
                                        </td>

                                        <td>
                                            <a href="basvuru-<?= seo($ilan['ilanid']) ?>"
                                               class="btn btn-outline-primary">
                                                Başvuruları Gör
                                            </a>
                                        </td>
                                        <td>
                                            <center>
                                                <?php if ($yetkiler['ilan-ver']['duzenleme']) { ?>
                                                    <a data-toggle="modal" href="#duzenle_ilan<?= $ilan['ilanid'] ?>"
                                                       class="btn btn-success btn-sm">
                                                        Düzenle
                                                    </a>
                                                <?php } else { ?>
                                                    <button class="btn btn-success btn-sm" disabled>Düzenle</button>
                                                <?php }
                                                if ($yetkiler['ilan-ver']['silme']) { ?>
                                                    <button data-url="ilan-ver.php?sil=<?= $ilan['ilanid'] ?>"
                                                            class="btn btn-dark btn-sm sil-sweet">
                                                        Sil
                                                    </button>
                                                <?php } else { ?>
                                                    <button class="btn btn-dark btn-sm" disabled>
                                                        Sil
                                                    </button>
                                                <?php }
                                                include "ilan-duzenle.php" ?>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="dolan">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İlan Başlık</th>
                                <th>Departman Bilgisi</th>
                                <th>Detaylar</th>
                                <th>Yayınlanma Tarihi</th>
                                <th>Son Başvuru Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($guncelilanlar as $ilan) {
                                if ($ilan['son_basvuru_tarih'] < $bugunun_tarihi->format("Y-m-d")) { ?>
                                    <tr>
                                        <td><?= $ilan['ilanid'] ?></td>
                                        <td><?= $ilan['baslik'] ?></td>
                                        <td><?= $ilan['departman'] ?></td>
                                        <td>
                                            <center>
                                                <button class="btn btn-outline btn-dark btn-sm" data-toggle="modal"
                                                        data-target="#aciklama<?= $ilan['ilanid'] ?>">
                                                    Detay Görüntüle
                                                </button>
                                                <div class="modal fade" id="aciklama<?= $ilan['ilanid'] ?>">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-center">İlan Detayları</h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <?= $ilan['aciklama'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </center>
                                        </td>

                                        <td><?= $ilan['tarih'] ?></td>
                                        <td><?= $ilan['son_basvuru_tarih'] ?></td>
                                        <td>
                                            <center>
                                                <div class="toggle lg">
                                                    <label>
                                                        <?php if ($yetkiler['ilan-ver']['duzenleme']) { ?>
                                                            <input type="checkbox" class="ilanDurum_aktifPasif"
                                                                   id="<?= $ilan['ilanid'] ?> "<?= (($ilan['durum']) == "AKTİF" ? 'checked' : null) ?> >
                                                            <span class="button-indecator"></span>
                                                        <?php } else { ?>
                                                            <input type="checkbox"<?= (($ilan['durum']) == "AKTİF" ? 'checked' : null) ?>
                                                                   disabled>
                                                            <span class="button-indecator"></span>
                                                        <?php } ?>
                                                    </label>
                                                </div>
                                            </center>
                                        </td>
                                        <td>
                                            <a href="basvuru-<?= seo($ilan['ilanid']) ?>"
                                               class="btn btn-outline-primary">
                                                Başvuruları Gör
                                            </a>
                                        </td>
                                        <td>
                                            <center>
                                                <?php if ($yetkiler['ilan-ver']['silme']) { ?>
                                                    <button data-url="ilan-ver.php?sil=<?= $ilan['ilanid'] ?>"
                                                            class="btn btn-dark btn-sm sil-sweet">
                                                        Sil
                                                    </button>
                                                <?php } else { ?>
                                                    <button class="btn btn-dark btn-sm" disabled>
                                                        Sil
                                                    </button>
                                                <?php } ?>
                                            </center>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
    </main>
<?php include "footer.php"; ?>