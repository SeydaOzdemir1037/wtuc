<?php
require_once("../../controller/DBController.php");
require_once("../../controller/ProjeController.php");
$projecont = new ProjeController();
$projeler = $projecont->devam_eden_projeleri_getir();



?>


<form id='proje_gorevlendirme' action="javascript:void(0);">
    <div class="modal fade " id="projeye-gorevlendir">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Görevlendir</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Aktif Projeler</label>
                        <select class="form-control" name="proje_id" id="proje_id">
                            <option value="">Proje Seçiniz</option>
                            <?php foreach ($projeler as $pro) {
                                $proje_kontrol = $projecont->proje_kontrol($pro['id'], $personel['personelid']);
                                if ($proje_kontrol == null) { ?>
                                    <option value="<?= $pro['id'] ?>"><?= $pro['proje_adi'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="<?= $personel['personelid'] ?>" name="personel_id">
                <input type="hidden" value="gorevlendir" name="projeyeGorevlendir">
                <div class="modal-footer">
                    <button name="submit" type="submit" id="submit"
                            onclick="projeye_gorevlendir();" class="btn btn-danger btn-lg"
                            style="width: 100%;">Ekle
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>