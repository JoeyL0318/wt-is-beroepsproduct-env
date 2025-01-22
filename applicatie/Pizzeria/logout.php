<?php
session_start();
if (isset($_SESSION['login'])) {
    unset($SESSION['login']);
    session_destroy();
    header("location: index.php");
}

?>