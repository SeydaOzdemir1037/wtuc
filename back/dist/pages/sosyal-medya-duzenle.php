<?php
require_once("../../controller/DBController.php");
require_once("../../controller/SosyalMedyaController.php");
$sosyalmedyacont = new SosyalMedyaController();
$sosyal_bul = $sosyalmedyacont->sosyal_medya_bul($medya['id']);

if ($_POST) {
    $id = $_POST['id'];
    $ad = $_POST['ad'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $sosyal_duzenle = $sosyalmedyacont->sosyal_medya_guncelle($ad, $link, $icon, $id);
}


?>


<form id='sosyal_medya_duzenle<?= $medya['id'] ?>' action="javascript:void(0);">
    <div class="modal fade " id="duzenle_sosyal<?= $medya['id'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">İşlem Yap</h4>
                    <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"
                                                                                   aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Medya adı</label>
                        <input class="form-control " type="text" name="ad"  value="<?= $sosyal_bul['isim'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Link</label>
                        <input class="form-control " type="text" name='link'   value="<?= $sosyal_bul['link'] ?>">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">İcon Adı</label>
                            <div class="input-group">
                                <input class="form-control " type="text" name='icon' id="icon<?= $sosyal_bul['id'] ?>"
                                       value="<?= $sosyal_bul['icon'] ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i id="icon_resim<?= $sosyal_bul['id'] ?>"
                                                                      class="fa fa-<?= $sosyal_bul['icon'] ?>"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $sosyal_bul['id'] ?>">
                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="dene<?= $sosyal_bul['id'] ?>();" class="btn btn-danger btn-lg "
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
    function dene<?=$sosyal_bul['id']?>() {
        var veriler = $('#sosyal_medya_duzenle' + <?=$medya['id']?>).serializeArray();
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
                url: "sosyal-medya-duzenle.php",
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


    function duzenle<?= $medya['id'] ?>() {
        var a = document.getElementById("icon" + <?= $sosyal_bul['id'] ?>).value;
        var icon = "fa fa-" + a;
        document.getElementById("icon_resim" + <?= $sosyal_bul['id'] ?>).className = icon;
    }

    setInterval("duzenle<?= $medya['id'] ?>()", 100);

</script>