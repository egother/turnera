<?php
    error_reporting(0);
    include('../app/connect.php');
    $fec = $_GET['fecha'];
    $prof = $_GET['prof'];

    // cambiar formato a la hora para que funcione en sql
    $fec = DateTime::createFromFormat('d/m/Y', $fec);
    $fec = $fec->format('Y-m-d');

    try {
        $sql = $db->prepare("
    SELECT horarios.hora from horarios INNER JOIN profesional ON (horarios.id_prof = profesional.id) WHERE (profesional.usuario = \"$prof\" ) AND (horarios.hora) NOT IN ( SELECT turnos.hora FROM turnos WHERE (turnos.fecha = \"$fec\" ) AND (turnos.profesional = \"$prof\" ) ) ORDER BY horarios.hora     ");

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
    }
    catch ( PDOException $e ){
        echo "Algo falló en la consulta SQL"; exit;
    }
?>
