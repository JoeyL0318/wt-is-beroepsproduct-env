<?php

session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'Personnel') {
        header('location: insite.php');
    } else {header('location: login.php');}
} else {header('location: login.php');}