<?php
require_once("../../controller/OdemeController.php");
$odemecont = new OdemeController();
$odemeler = $odemecont->odeme_turleri_cek();
?>


<form id='personel_odeme_ekle' action="javascript:void(0);">
    <div class="modal fade " id="personel-odeme-ekle">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Ödeme Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="">Ödeme Türü</label>
                            <select name="odeme_turu" id="ekle_tur" class="form-control">
                                <option value="">Seçiniz</option>
                                <?php foreach ($odemeler as $odeme) { ?>
                                    <option value="<?= $odeme['id'] ?>"><?= $odeme['tip'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Miktar</label>
                            <div class="input-group">
                                <input class="form-control " type="text" name="miktar" id="ekle_miktar">
                                <div class="input-group-append"><span class="input-group-text">TL</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="personelOdemeEkleme" value="odemeEkle">
                <input type="hidden" name="id" value="<?=$personel['personelid']?>">
                <div class="modal-footer ">
                    <button name="submit" type="submit"
                            onclick="personelOdemeEkle();" class="btn btn-danger btn-lg"
                            style="width: 100%;">Ekle
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

