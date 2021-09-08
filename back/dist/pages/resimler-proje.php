<?php include "header.php";
$error = "";
$message = "";
if ($_GET['projeResim']) {
    $id = $_GET['projeResim'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $allowed_extension = array("jpg", "jpeg", "png", "pdf", "doc", "docx");//JPEG YÜKLEMİYOR!!!
    $count = 0;
    if (!empty($_FILES['galeri']['name'][0])) {
        if (!file_exists('../../../documents/projeler/' . $id)) {
            mkdir('../../../documents/projeler/' . $id, 0777, true);
        }
        foreach ($_FILES['galeri']['name'] as $filename) {
            $temp = '../../../documents/projeler/' . $id . '/';
            $tmp = $_FILES['galeri']['tmp_name'][$count];
            $file_extension = pathinfo($_FILES['galeri']['name'][$count], PATHINFO_EXTENSION);
            if (in_array($file_extension, $allowed_extension)) {
                $count = $count + 1;
                $temp = $temp . basename($filename);
                move_uploaded_file($tmp, $temp);
            } else {
                $error .= "<b>" . $_FILES["galeri"]["name"][$count] . "</b> ----- Desteklenen Formatlar:png,jpg,jpeg,pdf,doc,docx";
            }
            $temp = '';
            $tmp = '';
        }
        $count = 0;
    }
}


?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Proje Resimleri</h1>
        </div>
    </div>
    <div class="row tile">
        <div class="container-fluid">
            <?php if ($error != "") { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <?php if ($message != "") { ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php } ?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <form class="form-horizontal " enctype='multipart/form-data' method="POST"
                      action="resimler-proje.php?projeResim=<?= $id ?>">
                    <h1 class="h3 mb-0 text-gray-800">
                        <label for="" class="form-group">Resim Ekle
                            <input type="file" class="form-control" name="galeri[]" multiple>
                            <input type="hidden" value="<?= $id ?>" name="id">
                        </label>
                        <button class="btn btn-primary">Ekle</button>
                    </h1>
                </form>
            </div>

            <div class=" row">
                <?php foreach (glob("../../../documents/projeler/" . $id . "/*.*") as $file) {
                    $endimg = explode('/', $file);
                    $link = $endimg[3] . "/" . $endimg[4] . "/" . $endimg[5] . "/" . $endimg[6];
                    ?>
                    <div class="col-sm-4 col-md-3 mt-3 filtre ">
                        <div class="sil" id="<?= $link ?>">
                            <span class="fa fa-window-close "></span>
                        </div>
                        <?php if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg" || pathinfo($file, PATHINFO_EXTENSION) == "png") { ?>
                            <img width="90%" height="150px" src="<?= $file ?>">
                        <?php } else { ?>
                            <a href="<?php echo $file; ?>" style="color:black;"><?php echo $endimg[6]; ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php include "footer.php" ?>


<script>
    $(document).ready(function (e) {
        $(".sil").on('click', (function (e) {
            e.preventDefault();
            var el = $(this);
            var imagelink = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: 'proje_resim_sil.php',  //işlem yaptığımız sayfayı belirtiyoruz
                data: {imagelink: imagelink}, //datamızı yolluyoruz
                success: function (data) {
                    if (data == 1) {
                        iziToast.success({
                            title: 'Başarılı',
                            message: 'Silindi',
                            position: 'topRight'
                        });
                        el.parent().remove();
                    } else {
                        iziToast.error({
                            title: 'HATA',
                            message: 'Silinmedi',
                            position: 'topRight'
                        });
                    }
                },
            });
        }));
    });
</script>