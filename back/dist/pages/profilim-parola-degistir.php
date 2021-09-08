<?php

?>
<form id='yeni_veri' action="javascript:void(0);">

    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Parolayı Değiştir</h4>
                    <button type="button" class="close" data-dismiss="modal"> <span class="fa fa-times" aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
<!--                    <div class="form-group">-->
<!--                        <label for="">Eski Şifreniz</label>-->
<!--                        <input class="form-control " type="password" name="sifre_eski" id="sifre_eski" >-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="">Yeni Şifreniz</label>
                        <input class="form-control " type="password" name='sifre_yeni' id="sifre_yeni">
                    </div>
                    <div class="form-group">
                        <label for="">Yeni Şifreniz(Tekrar)</label>
                        <input class="form-control " type="password" name='sifre_yeni_tekrar' id="sifre_yeni_tekrar">
                    </div>
                    <input type="hidden" name="personel_id" value="<?= $personel['personelid'] ?>">
                    <input type="hidden" name="profilParolaDegistir" value="parolaDegistir">

                </div>
                <div class="modal-footer">
                    <button name="submit" type="submit" id="submit"
                            onclick="profilim_parola_degistir();" class="btn btn-danger btn-lg "
                            style="width: 100%;">DÜZENLE
                    </button>
                </div>

            </div>
        </div>
    </div>

</form>
