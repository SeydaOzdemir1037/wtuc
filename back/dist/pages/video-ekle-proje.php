<?php include "header.php";



if (!$yetkiler['projeler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['projeler']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    } else {
        if (!$yetkiler['projeler']['duzenleme']) {
            header("Location:yetkiYok.php");
        }
    }
}



//require_once("../../controller/ResimController.php");
//$resimcont = new ResimController();
//$slider_sira=$resimcont->slider_sira_cek();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $sira=$_POST['sira'];
//    $sira++;
//    $uploads_dir = 'slider_resimler';
//    @$tmp_name = $_FILES['file']["tmp_name"];
//    @$name = $_FILES['file']["name"];
//
//    $benzersizsayi1 = rand(20000, 32000);
//    $benzersizsayi2 = rand(20000, 32000);
//    $benzersizsayi3 = rand(20000, 32000);
//    $benzersizsayi4 = rand(20000, 32000);
//
//    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
//    $refimgyol = $uploads_dir . "/" . $benzersizad . $name;
//    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
//    if (strlen($refimgyol) > 0) {
//        $flag = $resimcont->slider_resim_ekle($refimgyol,$sira);
//    }


}
?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Resim Ekle</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">Proje Videoları</h3>
                        <a href="">
                            <button class="btn btn-primary pull-right"><i class="fa fa-file"></i>Yüklü Resimleri Gör</button>
                        </a>
                    </div>
                    <div class="tile-body">
                        <h4>Resim Seç</h4>
<!--                        <form action="/file-upload" class="dropzone" id="myawesomedropzone"></form>-->
                        <form action="slider-resim-ekle.php" enctype="multipart/form-data" class="dropzone" id="myawesomedropzone"
                              data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
                            <div class="dz-message">
                                <h3 class="m-h-lg">Projeye Videolar Ekle</h3>
                                <p class="m-b-lg text-muted">Video eklemek için tıklayın/sürükleyin ve istediğiniz resimleri
                                    projenize ekleyin</p>

                                <input type="hidden" name="sira" value="<?php echo $slider_sira['sira'] ?>"
                                       class="form-control">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

<?php include "footer.php"; ?>

