<?php
require_once("../../controller/OdemeController.php");
$odemecont = new OdemeController();
$odeme_bul = $odemecont->odeme_bul($odeme['odemeid']);

?>


<form id='odeme_duzenle<?= $odeme['odemeid'] ?>' action="javascript:void(0);">
    <div class="modal fade " id="odeme_islem<?= $odeme['odemeid'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">İşlem Yap</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 form-group">
                        <label>Talep Tarihi</label>
                        <input type="text" class="form-control" value="<?= $odeme_bul['talep_tarihi'] ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>İşlem</label>
                        <input type="text" class="form-control" value="<?= $odeme_bul['tip'] ?>" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Miktar</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="miktar" id="miktar<?= $odeme_bul['odemeid'] ?>"
                                   value="<?= $odeme_bul['odenen_miktar'] ?>">
                            <div class="input-group-append"><span class="input-group-text">TL</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>İşlem Seçiniz</label>
                        <select name="durum" class="form-control">
                            <option value="4">ONAYLA</option>
                            <option value="5">REDDET</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id"  value="<?= $odeme_bul['odemeid'] ?>">
                <input type="hidden" name="odemeonay" value="odemeonay">
                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="odeme<?= $odeme_bul['odemeid'] ?>();" class="btn btn-primary btn-lg"
                            style="width: 100%;">İşlemi Tamamla
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</form>


<script type="text/javascript">
    function odeme<?=$odeme_bul['odemeid'] ?>() {
        var veriler = $('#odeme_duzenle' + <?=$odeme['odemeid']?>).serialize();
        var miktar = $('#miktar'+<?= $odeme_bul['odemeid'] ?>).val();
        if (miktar === "" || miktar < 0) {
            iziToast.error({
                title: 'Hata',
                message: 'Geçerli bir miktar giriniz',
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
    };
</script>

