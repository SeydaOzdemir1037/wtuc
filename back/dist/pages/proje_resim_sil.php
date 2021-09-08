<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../../controller/DBController.php");
    require_once("../../controller/ProjeController.php");
    $resim_sil = new ProjeController();
    $flag = $resim_sil->proje_resim_sil($_POST["imagelink"]);
    echo $flag;
}
?>
