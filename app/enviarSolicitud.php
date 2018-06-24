<?php
	function sanitizar($str){
        $comment = trim($str);
		$comment = strip_tags($comment);
        return $comment;
    }

    function confirmacion($msj, $sub){
        
        
    }

    error_reporting(0);
        $msj="";

        $error = false;

        if (sizeof($_POST) > 0){

            $p = sanitizar($_POST["nombre"]);
            $m = sanitizar($_POST["email"]);
            $e = sanitizar($_POST["especialidad"]);
            $msj = sanitizar($_POST["mensaje"]);
            $msj = "Especialidad: " . $e . " - Mensaje: " . $msj;
            $f = sanitizar($_POST["fecha"]);
            $h = sanitizar($_POST["hora"]);
            $h = $h . ":00";

            $fecha = new DateTime($fec);
            $hoy = new DateTime("now");
            if ($fecha < $hoy){
                $error = true;
            } else { $error = true; }
        } else { $error = true; }

        if (! error) {
            $sql = $this->conexion->prepare(
                "insert into turnos (fecha, hora, mensaje, profesional)
                 values (:f, :h, :m, :p)
             ");
             $sql->bindParam(':f', $n, PDO::PARAM_STR);
             $sql->bindParam(':h', $m, PDO::PARAM_STR);
             $sql->bindParam(':m', $t, PDO::PARAM_STR);
             $sql->bindParam(':p', $f, PDO::PARAM_STR);
             $sql->execute();
             $msj = "Genial! Su turno ya ha sido reservado.";
             $sub = "A la brevedad le llegará un correo electrónico confirmando su solicitud.";
             confirmacion($msj, $sub);
        } else {
             $msj = "Hubo un problema con los datos ingresados.";
             $sub = "Por favor, revise los datos ingresados y vuelva a intentarlo. Gracias.";
             confirmacion($msj, $sub);
        }
?>