<?php include "header.php";

if (!$yetkiler['yetkiler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}

require_once("../../controller/DepartmanController.php");
$departmancont = new DepartmanController();
$departmanlar = $departmancont->departman_getir();


?>
<?php if ($_GET["yetki-duzenleme"] == "ok") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Yetkiler güncellendi',
            position: 'topCenter'
        });
    </script>
<?php } ?>
    <main class="app-content">
        <div class="app-title">
            <div class="text-center">
                <h1>DEPARTMANLAR</h1>
            </div>
        </div>
        <div class="row">
            <?php foreach ($departmanlar as $departman) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="tile-title-w-btn text-center">
                            <h3 class="title"><?= $departman['departman'] ?></h3>
                        </div>

                        <p class="text-center">
                            <?php if ($yetkiler['yetkiler']['icerik_goruntuleme']) { ?>
                                <a class="btn btn-primary icon-btn" href="yetki-<?= seo($departman['departman']) ?>">
                                    Yetkileri Gör
                                </a>
                            <?php } else { ?>
                                <a class="btn btn-primary icon-btn" disabled>
                                    Yetkiniz YOK
                                </a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            <?php } ?>

        </div>
    </main>

<?php include "footer.php" ?>