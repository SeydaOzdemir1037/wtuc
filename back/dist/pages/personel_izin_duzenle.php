<?php
require_once("../../controller/IzinController.php");
$izincont = new IzinController();
$izin_bul = $izincont->izin_bul($izin['izinlerid']);


?>


<form id='izin_duzenle<?= $izin_bul['izinlerid'] ?>' action="javascript:void(0);">
    <div class="modal fade" id="personel_izin_duzenle<?= $izin['izinlerid'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">İşlem Yap</h4>
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"
                                                                                   aria-hidden="true"></span></button>
                </div>

                <div class="modal-body row">
                    <div class="col-md-12 form-group">
                        <label>Açıklama</label>
                        <textarea cols="30" rows="5" class="form-control"
                                  disabled><?= $izin_bul['aciklama'] ?></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Talep Tarihi</label>
                        <input type="text" class="form-control"
                               value="<?= date("d/m/Y", strtotime($izin_bul['talep_tarih'])) ?>" disabled>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Sebep</label>
                        <input type="text" class="form-control" value="<?= $izin_bul['sebep'] ?>" disabled>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Süre</label>
                        <input type="text" class="form-control" value="<?
                        $izin_hesapla = $menulercont->sure_hesaplama($izin['baslama_tarih'], $izin['bitis_tarih']);
                        echo  $izin_hesapla ."gün"; ?>" disabled>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Başlama Tarihi</label>
                        <input type="text" class="form-control"
                               value="<?= date("d/m/Y", strtotime($izin_bul['baslama_tarih'])) ?>" disabled>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bitiş Tarihi</label>
                        <input type="text" class="form-control"
                               value="<?= date("d/m/Y", strtotime($izin_bul['bitis_tarih'])) ?>" disabled>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>İşlem Seçiniz</label>
                        <select name="durum" class="form-control">
                            <option value="4">ONAYLA</option>
                            <option value="5">REDDET</option>
                        </select>
                    </div>

                </div>
                <input type="hidden" name="id" value="<?= $izin_bul['izinlerid'] ?>">
                <input type="hidden" name="izinonay" value="izinonay">
                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="izin<?= $izin_bul['izinlerid'] ?>();" class="btn btn-primary btn-lg"
                            style="width: 100%;">İşlemi Tamamla
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>


<script>
    function izin<?=$izin_bul['izinlerid']?>() {
        var veriler = $('#izin_duzenle<?= $izin_bul['izinlerid'] ?>').serialize();
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
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

    };

</script>