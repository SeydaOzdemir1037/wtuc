
<form  action="post_islemleri.php" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="profil-resim-guncelle">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Resmi Değiştir</h4>
                    <button type="button" class="close" data-dismiss="modal"> <span class="fa fa-times" aria-hidden="true"></span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <input class="form-control "type="file" name="resim">
                    </div>
                </div>
                <input type="hidden" name="personel_id" value="<?= $personel['personelid'] ?>">
                <input type="hidden" name="eski_resim" value="<?= $personel['resim'] ?>">
                <div class="modal-footer ">
                    <button type="submit" name="profilim_resim_degis"
                           class="btn btn-danger btn-lg" style="width: 100%;">DÜZENLE</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

