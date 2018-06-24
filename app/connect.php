<?php
    $dbname = "cmaustria";
    $dbhost = "192.168.0.10";
    $dbuser = "cmaustria"; $dbpass = "cmaustria";

    $db = new PDO("mysql:dbname=".$dbname.";host=".$dbhost,$dbuser,$dbpass);
    $db->exec("set names utf8");    //  lo desactive porque dejo de funcionar

?>