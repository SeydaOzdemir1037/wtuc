
<form id='sosyal_medya' action="javascript:void(0);">
    <div class="modal fade " id="sosyal-medya-ekle">
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
                        <input class="form-control " type="text" name="ad" id="ad">
                    </div>
                    <div class="form-group">
                        <label for="">Link</label>
                        <input class="form-control " type="text" name='link' id="link">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">İcon Adı</label>
                            <div class="input-group">
                                <input class="form-control " type="text" name='icon' id="icon">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i id="icon_resim"
                                                                      class=""></i></span>
                                </div>
                            </div>
                        </div>
<!--                        <div class="form-group col-md-6">-->
<!--                            <label for="">Medya Durumu</label>-->
<!--                            <select name="durum" id="" class="form-control">-->
<!--                                --><?php //foreach ($durumlar as $durum) { ?>
<!--                                    <option value="--><?//= $durum['id'] ?><!--">--><?//= strtoupper($durum['durum']) ?><!--</option>-->
<!--                                --><?php //} ?>
<!--                            </select>-->
<!--                        </div>-->
                    </div>
                </div>
                <input type="hidden" name="sosyalMedyaEkle" value="ekle">
                <div class="modal-footer ">
                    <button name="submit" type="submit" id="submit"
                            onclick="sosyalmedyaekle();" class="btn btn-danger btn-lg"
                            style="width: 100%;">Ekle
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<script>
    function sosyalmedya_iconekle_kontrol(){
        var a=document.getElementById("icon").value;
        var icon="fa fa-"+a;
        document.getElementById("icon_resim").className=icon;
    }
    setInterval("sosyalmedya_iconekle_kontrol()",100);
</script>

