<?php
require_once("../../controller/IzinController.php");
$izincont = new IzinController();
$personel_izinler = $izincont->izin_getir($personel['personelid']);
$date = date("d/m/Y");


if ($_GET['iptal']) {
    $id = $_GET['iptal'];
    $flag = $izincont->profilim_izin_iptal($id);
    if ($flag) {
        header("Location:profilim.php?izin-iptal=tamam");
    }
}



?>


<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>
                    <center>Talep Tarihi</center>
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
                    <center>Durumu</center>
                </th>
                <th>
                    <center>İşlemler</center>
                </th>
            </tr>
            </thead>
            <tbody class="myTable">
            <?php foreach ($personel_izinler as $izin) { ?>
                <tr>
                    <td>
                        <center><?= date("d/m/Y", strtotime($izin['talep_tarih'])) ?></center>
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
                            <button class="btn btn-outline btn-dark btn-sm" data-toggle="modal"
                                    data-target="#aciklama<?= $izin['izinlerid'] ?>">
                                Açıklamayı Gör
                            </button>
                            <div class="modal fade" id="aciklama<?= $izin['izinlerid'] ?>">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title text-center">Açıklama</h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span class="fa fa-times" aria-hidden="true"></span>
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
                    <td style="font-weight: bold;">
                        <center>
                            <?= $izin['durum'] ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php if ($izin['durum_id'] == 4) { ?>
                                <i class="fa fa-check" style="color:green"></i>
                            <?php } else if ($izin['durum_id'] == 5) { ?>
                                <i class="fa fa-close" style="color:green"></i>
                            <?php } else { ?>
                                <a data-toggle="modal" href="#profil_izin_islem<?= $izin['izinlerid'] ?>">
                                    <button class="btn btn-primary btn-sm">İşlem Yap</button>
                                </a>
                                <button data-url="profilim.php?iptal=<?= $izin['izinlerid'] ?>"
                                        class="btn btn-danger btn-sm sil-sweet">
                                    İptal Et
                                </button>
                            <?php } ?>
                        </center>
                        <?php include "profilim-izin-duzenle.php"; ?>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div><!-- .widget-body -->

