<?php

    error_reporting(0);
    $fec = $_GET['fecha'];
    $prof = $_GET['prof'];
    $dbname = "cmaustria";
    $dbhost = "localhost";
    $dbuser = "cmaustria"; $dbpass = "cmaustria";

    $db = new PDO("mysql:dbname=".$dbname.";host=".$dbhost,$dbuser,$dbpass);
    $db->exec("set names utf8");    //  lo desactive porque dejo de funcionar

    $sql = $db->prepare("
        SELECT horarios.hora from horarios INNER JOIN profesional ON (horarios.id_prof = profesional.id)
        WHERE (profesional.usuario = \"$prof\") AND (horarios.hora NOT IN (
            SELECT turnos.hora FROM turnos WHERE (turnos.fecha = \"$fec\") AND (turnos.profesional = \"$prof\")
            )
        )    
    ");

    $sql->execute();
    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sql as $res){
        $resultado[] = $res['hora'];
    }
echo "
<select name=\"hora\" required>";
        foreach ($resultado as $h){
            $date = new DateTime($h);
            $reduc = $date->format('H:i');
            echo "<option value=\"$reduc\">$reduc</option>";
}
echo "</select>";
?>
