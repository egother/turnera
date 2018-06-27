<?php
    $dbname = "cmaustria";
    $dbhost = "192.168.0.10";
    $dbuser = "cmaustria"; $dbpass = "MentaPenta951";
    
    try {
        $db = new PDO("mysql:dbname=".$dbname.";host=".$dbhost,$dbuser,$dbpass);
        $db->exec("set names utf8");    //  lo desactive porque dejo de funcionar
    }
    catch (PDOException $e){
        echo "No se pudo conectar con la base de datos"; exit;
    }
?>