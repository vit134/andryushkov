<?php
    session_start();
    unset($_SESSION['login']);
    //var_dump($_SESSION['login']);


    header("location:/admin_v2");

?>