<!DOCTYPE html>
<html>
	<head>
		<title>Turno Online - CMA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <link rel="shortcut icon" type="image/x-icon" href="icon.png" />

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

        <!-- Styles para el datepicker -->        
        <link href="dist/css/glDatePicker.default.css" rel="stylesheet" type="text/css">
        <link href="dist/css/glDatePicker.darkneon.css" rel="stylesheet" type="text/css">
        <link href="dist/css/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">

        
    </head>
<?php
	function sanitizar($str){
        $comment = trim($str);
		$comment = strip_tags($comment);
        return $comment;
    }
    
    function enviarMailProfesional($db, $prof, $turno_id){
        $sql = $db->prepare("
            select full_name, email from profesional where (usuario = \"$prof\")
        ");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        $to = $res[0]["email"];
        $d = $res[0]["full_name"];
        
        $sql = $db->prepare("
            select * from turnos inner join pacientes on (turnos.id_paciente = pacientes.id) where (turnos.id = \"$turno_id\")
        ");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        $n = $res[0]["nombre"];
        $f = $res[0]["fecha"];
        $h = $res[0]["hora"];
        $c = $res[0]["mensaje"];
        $e = $res[0]["especialidad"];
        
        $subject = "CMA - Turno Online [#" . $turno_id . "]";

        $message = "
            <html>
                <head>
                    <title>Nuevo Turno Online</title>
                </head>
                <body>
                    <h1>Se ha confirmado un nuevo turno online</h1>
                    <p>A continuación los detalles:<br><br>
                        Nombre y Apellido: <strong>$n</strong><br>
                        Fecha: <strong>$f</strong><br>
                        Hora: <strong>$h</strong><br>
                        Profesional: <strong>$d</strong><br>
                        Especialidad: <strong>$e</strong><br>
                        Consulta: <strong>$c</strong><br>
                    </p>
                    <h3>InfoMail - Consultorio Médico Austria</h3>
                </body>
            </html>        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Info CMAustria<info@cmaustria.com.ar>' . "\r\n";
//        $headers .= 'Cc: laulamas@hotmail.com' . "\r\n";

        $to = "egomez.ogg@gmail.com";
        mail($to,$subject,$message,$headers);
    }
    
    function enviarMailPaciente($db, $prof, $turno_id){
        $sql = $db->prepare("
            select full_name, email from profesional where (usuario = \"$prof\")
        ");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        $d = $res[0]["full_name"];
        
        $sql = $db->prepare("
            select * from turnos inner join pacientes on (turnos.id_paciente = pacientes.id) where (turnos.id = \"$turno_id\")
        ");
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        $n = $res[0]["nombre"];
        $f = $res[0]["fecha"];
        $h = $res[0]["hora"];
        $to = $res[0]["email"];
        
        $subject = "CMA - Turno Online [#" . $turno_id . "]";

        $message = "
            <html>
                <head>
                    <title>Nuevo Turno Online</title>
                </head>
                <body>
                    <h1>Su turno online ha sido confirmado</h1>
                    <p>A continuación los detalles:<br><br>
                        Nombre y Apellido: <strong>$n</strong><br>
                        Fecha: <strong>$f</strong><br>
                        Hora: <strong>$h</strong><br>
                        Profesional: <strong>$d</strong><br>
                    </p>
                    <p>Recuerde llevar a la cita médica sus últimos estudios en caso de ser necesarios. <br /><br />
                        Solicitamos su presencia con una antelación de 10 minutos a la hora del turno. Muchas gracias.</p>
                        <hr />
							<h2>Nos encontramos en</h2>
							<dl>
								<dt><a href=\"https://goo.gl/maps/VgnZfq5Hkx42\" target=\"_blank\">Austria 2174  7°A &bull; C.A.B.A. &bull; Argentina</a></dd>
								<dt>(011) 4802-6891</dd>
								<dt><a href=\"mailto:info@cmaustria.com.ar\">info@cmaustria.com.ar</a></dd>
                                <img src=\"http://www.cmaustria.com.ar/images/logo.png\" />
							</dl>
                </body>
            </html>        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Info CMAustria<info@cmaustria.com.ar>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }    

    
        // codigo principal //
        
        include('../app/connect.php');
        $report="Nada que reportar";

        $error = false;
        if (sizeof($_POST) > 0){

            $nombrePaciente = sanitizar($_POST["nombre"]);
            $email = sanitizar($_POST["email"]);
            $tel = sanitizar($_POST["telefono"]);
            $prof = sanitizar($_POST["profesional"]);
            $espec = sanitizar($_POST["especialidad"]);
            $msj = sanitizar($_POST["mensaje"]);
            $fecha = sanitizar($_POST["fecha"]);
            $hora = sanitizar($_POST["hora"]);
            $hora = $hora . ":00";
            
            //cambiar formato a la hora para que funcione en SQL
            $fechaReservada = DateTime::createFromFormat('d/m/Y', $fecha);
            $fecha = $fechaReservada->format('Y-m-d');
            
            $hoy = new DateTime("now");
            if ($fechaReservada < $hoy){
                $error = true;
                $report = "La fecha que eligió no está permitida.";
            }
        } else {
            $error = true;
            $report = "No se han ingresado datos.";
        }
        if (! $error) {
            try {
                // verifcamos si ya existe un paciente con este email
                $consulta = $db->prepare("
                    select id, nombre, email, telefono
                    from pacientes
                    where (email = :e)
                ");
                $consulta->bindParam(':e', $email, PDO::PARAM_STR);
                $consulta->execute();
                
                $pacientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
                if (sizeof($pacientes)==1){
                    $paciente = $pacientes[0];
                    $paciente_id = $paciente["id"];
                    
                    // actualizo telefono si antes no lo habia ingresado
                    if ($paciente["telefono"]==""){
                        $actualizar = $db->prepare("
                            update pacientes
                            set (telefono = :t)
                            where (id = :id)
                        ");
                        $sql->bindParam(':t', $telefono, PDO::PARAM_STR);
                        $sql->bindParam(':id', $paciente_id, PDO::PARAM_STR);
                        $actualizar->execute();
                    }
                    
                } else {
                    // agregamos los datos del paciente a nuestro sistema
                    $sql = $db->prepare("
                        insert into pacientes (nombre, email, telefono)
                        values (:n, :e, :t)
                    ");
                    $sql->bindParam(':e', $email, PDO::PARAM_STR);
                    $sql->bindParam(':t', $tel, PDO::PARAM_STR);
                    $sql->bindParam(':n', $nombrePaciente, PDO::PARAM_STR);

                    $sql->execute();
                    $paciente_id = $db->lastInsertId();
                }
                
                // agregamos el turno al sistema
                $sqlTurnos = $db->prepare(
                    "insert into turnos (fecha, hora, mensaje, profesional, id_paciente, especialidad)
                     values (:f, :h, :m, :p, :i, :e)
                 ");
                 $sqlTurnos->bindParam(':f', $fecha, PDO::PARAM_STR);
                 $sqlTurnos->bindParam(':h', $hora, PDO::PARAM_STR);
                 $sqlTurnos->bindParam(':m', $msj, PDO::PARAM_STR);
                 $sqlTurnos->bindParam(':p', $prof, PDO::PARAM_STR);
                 $sqlTurnos->bindParam(':i', $paciente_id, PDO::PARAM_STR);
                 $sqlTurnos->bindParam(':e', $espec, PDO::PARAM_STR);
                 $sqlTurnos->execute();
                 $turno_id = $db->lastInsertId();
                 $report = "Su turno ha sido confirmado.";
                 $sub = "A la brevedad le llegará un correo electrónico confirmando su reserva. <br /><br />
                        Recuerde llevar a la cita médica sus últimos estudios en caso de ser necesarios. <br /><br />
                        Solicitamos su presencia con una antelación de 10 minutos a la hora del turno. Muchas gracias.";
                
                
                // envío automático de e-mails
                enviarMailProfesional($db, $prof, $turno_id);
                enviarMailPaciente($db, $prof, $turno_id);
            }
            catch( PDOException $Exception ) {
                $report = "Hubo un problema al intentar ejecutar la instrucción SQL.";
                $sub = "Por favor, revise los datos ingresados y vuelva a intentarlo. Gracias.";
            }
        } else {
             $sub = "Por favor, revise los datos ingresados y vuelva a intentarlo. Gracias.";
        }
?>
    <body>
        
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt" style="padding: 15px"> 
						<span class="logo"><img src="images/logo.png" alt="" style="max-width: 30%;"/></span>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">

								<!-- Text -->
									<section>
										<h2 style="text-align: right;">
                                            <?php echo $report; ?>
                                            &nbsp; &nbsp;<i class="far fa-calendar-check fa-2x"></i></h2>
                                        <br />
										<hr />
										<h3> 
                                            <?php echo $sub; ?>
                                        </h3>
										<hr />
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <button onclick="window.location.href='./formulario.html'">Volver</button>
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <button class="special" onclick="window.location.href='./index.html'">Inicio</button>
                                            </div>
                                        </div>
									</section>

							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
                        <p class="copyright">&copy; Consultorio Médico Austria.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
        
	</body>
</html>