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
    SELECT horarios.hora from horarios INNER JOIN profesional ON (horarios.id_prof = profesional.id) WHERE (profesional.usuario = \"$prof\" ) AND (horarios.hora)  ORDER BY horarios.hora     ");

        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sql as $res){
            $todos[] = $res['hora'];
        }
        
        $sql = $db->prepare("
            SELECT turnos.hora FROM turnos WHERE (turnos.fecha = \"$fec\" ) AND (turnos.profesional = \"$prof\" ) ORDER BY turnos.hora
        ");
        
        $sql->execute();
        $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sql as $res){
            $no[] = $res['hora'];
        }
        
        // codigo html para el formulario.html
        echo "
        <select name=\"hora\" required>";
                foreach ($todos as $h){
                    $date = new DateTime($h);
                    $reduc = $date->format('H:i');
                    if (in_array($h, $no)){
                        echo "<option value=\"\" disabled>$reduc - no disponible</option>";
                    } else {
                        echo "<option value=\"$reduc\">$reduc</option>";
                    }
                        
        }
        echo "</select>";
    }
    catch ( PDOException $e ){
        echo "Algo falló en la consulta SQL"; exit;
    }
?>
