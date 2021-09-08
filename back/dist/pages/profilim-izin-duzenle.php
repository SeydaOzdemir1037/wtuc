<?php
require_once("../../controller/IzinController.php");
$izincont = new IzinController();
$izin_bul = $izincont->izin_bul($izin['izinlerid']);
$izin_sebepleri = $izincont->izin_sebepler_getir();


?>


<form id='profil_izin_duzenle<?= $izin_bul['izinlerid'] ?>' action="javascript:void(0);">
    <div class="modal fade" id="profil_izin_islem<?= $izin['izinlerid'] ?>">
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
                                  name="aciklama"><?= $izin_bul['aciklama'] ?></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Talep Tarihi</label>
                        <input type="text" class="form-control"
                               value="<?= date("d/m/Y", strtotime($izin_bul['talep_tarih'])) ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Sebep</label>
                        <select name="sebep" class="form-control">
                            <option value="<?= $izin_bul['sebep_id'] ?>"><?= $izin_bul['sebep'] ?></option>
                            <?php foreach ($izin_sebepleri as $sebep) {
                                if ($izin_bul['sebep_id'] != $sebep['id']) {
                                    ?>
                                    <option value="<?= $sebep['id'] ?>"><?= $sebep['sebep'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Başlama Tarihi</label>
                        <input type="date" class="form-control " name="baslangic"
                               value="<?= $izin_bul['baslama_tarih'] ?>" min="<?= $bugunun_tarihi->format("Y-m-d") ?>">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Bitiş Tarihi</label>
                        <input type="date" class="form-control" name="bitis"
                               value="<?= $izin_bul['bitis_tarih'] ?>">
                    </div>
                </div>
                <input type="hidden" name="izin_id" value="<?= $izin_bul['izinlerid'] ?>">
                <input type="hidden" name="profilimizin" value="izin">

                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="profilim_izin<?= $izin_bul['izinlerid'] ?>();" class="btn btn-primary btn-lg"
                            style="width: 100%;">Güncelle
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>


<script>
    function profilim_izin<?=$izin_bul['izinlerid']?>() {
        var veriler = $('#profil_izin_duzenle<?= $izin_bul['izinlerid'] ?>').serializeArray();
        var hata = 0;
        for (i = 0; i < veriler.length; i++) {
            if (veriler[i].name === "baslangic") {
                var baslangic = veriler[i].value;

            }
            if (veriler[i].name === "bitis") {
                var bitis = veriler[i].value;
            }
            if (veriler[i].value === "") {
                hata++;
            }
        }
        if(baslangic>bitis){
            iziToast.error({
                title: 'Hata',
                message: 'Bitiş tarihi,Başlangıç tarihinden büyük olamaz!!',
                position: 'topCenter'
            });
        }else{
            if (hata !== 0) {
                iziToast.error({
                    title: 'Hata',
                    message: 'Lütfen Tüm Alanları Doldurunuz...',
                    position: 'topCenter'
                });
            } else {
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

            }
        }





    };


</script>