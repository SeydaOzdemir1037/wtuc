<?php
require_once("../../controller/DBController.php");
require_once("../../controller/IlanController.php");
require_once("../../controller/DepartmanController.php");
$departmancont = new DepartmanController();
$departmangetir = $departmancont->departman_getir();
$ilancont = new IlanController();
$ilanbul = $ilancont->ilanBul($ilan['ilanid']);


if ($_POST) {
    $baslik = $_POST['baslik'];
    $departman_id = $_POST['departman'];
    $son_basvuru_tarih = $_POST['son_basvuru_tarih'];
    $aciklama = $_POST['aciklama'];
    $ilanid = $_POST['id'];
    $ilan_duzenle = $ilancont->ilan_guncelle($baslik, $departman_id, $son_basvuru_tarih,$aciklama,$ilanid);
}

?>


<form id='ilan_duzenle<?= $ilan['ilanid'] ?>' action="javascript:void(0);">
    <div class="modal fade " id="duzenle_ilan<?= $ilan['ilanid'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">İlan Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"
                                                                                   aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">İlan Başlık</label>
                        <input class="form-control " type="text" name="baslik" value="<?= $ilanbul['baslik'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Departman Bilgisi</label>
                        <select class="form-control" name="departman" id="departman">
                            <option value="<?= $ilanbul['departman_id'] ?>"><?= $ilanbul['departman'] ?></option>
                            <?php foreach ($departmangetir as $departman) { ?>
                                <option value="<?= $departman['id'] ?>"><?= $departman['departman'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Son Başvuru Tarihi</label>
                        <input type="date" class="form-control" name="son_basvuru_tarih" id="son_basvuru_tarih"
                               value="<?= $ilanbul['son_basvuru_tarih'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Detaylar</label>
                        <textarea name="aciklama" id="aciklama" cols="100" rows="10"
                                  class="form-control"><?=$ilanbul['aciklama']?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $ilanbul['ilanid'] ?>">
                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="dene<?=$ilanbul['ilanid']?>();" class="btn btn-danger btn-lg "
                            style="width: 100%;">Düzenle
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<script type="text/javascript">
    function dene<?=$ilanbul['ilanid']?>() {
        var veriler = $('#ilan_duzenle' + <?=$ilan['ilanid']?>).serializeArray();
        var hata = 0;
        for (i = 0; i < veriler.length; i++) {
            if (veriler[i].value === "") {
                hata++;
            }

        }
        if (hata !== 0) {
            iziToast.error({
                title: 'Hata',
                message: 'Lütfen tüm alanları doldurunuz...',
                position: 'topCenter'
            });
        } else {
            $.ajax({
                type: "POST",
                url: "ilan-duzenle.php",
                data: veriler,
                success: function (cevap) {
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'Bilgiler güncellendi, Sayfaya Yönlendiriliyorsunuz...',
                        position: 'topCenter'
                    });
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 1000);
                }
            })

        }

    };
</script>