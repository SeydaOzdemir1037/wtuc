<?php include "header.php";

?>
    <main class="app-content">
        <div class="app-title">
            <div class="text-center">
                <h1>Ödeme Talep Et</h1>
            </div>
        </div>

        <div style="margin: auto;" class="tile col-md-7">
            <div class=" bs-component ">
                <form action="izin-talep.php" method="post">
                    <div class="col-md-12 row">
                        <div class="col-md-6 form-group">
                            <label>Başlama Tarihi</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Bitiş Tarihi</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Sebep</label>
                            <select class="form-control" name="" id="">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Süre</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Açıklama</label>
                            <textarea cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-danger  form-control mt-3">TALEP ET
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include "footer.php" ?>