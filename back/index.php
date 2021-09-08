<?php

ob_start();
session_start();
if ($_SESSION['sicil_no'] == null) {
    header("Location:dist/pages/login.php");
}
else{
    header("Location:dist/pages/index.php");
}