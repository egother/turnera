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

    error_reporting(0);
        include('../app/connect.php'    );
        $report="Nada que reportar";

        $error = false;
        if (sizeof($_POST) > 0){

            $n = sanitizar($_POST["nombre"]);
            $c = sanitizar($_POST["email"]);
            $t = sanitizar($_POST["telefono"]);
            $p = sanitizar($_POST["profesional"]);
            $e = sanitizar($_POST["especialidad"]);
            $msj = sanitizar($_POST["mensaje"]);
            $msj = "Especialidad: " . $e . " - Mensaje: " . $msj;
            $f = sanitizar($_POST["fecha"]);
            $h = sanitizar($_POST["hora"]);
            $h = $h . ":00";
            
            //cambiar formato a la hora para que funcione en SQL
            $fecha = DateTime::createFromFormat('d/m/Y', $f);
            $f = $fecha->format('Y-m-d');
            
            $hoy = new DateTime("now");
            if ($fecha < $hoy){
                $error = true;
                $report = "La fecha que eligió no está permitida.";
            }
        } else {
            $error = true;
            $report = "No se han ingresado datos.";
        }
        if (! $error) {
            try {
                $sql = $db->prepare(
                    "insert into turnos (fecha, hora, mensaje, profesional, paciente, email, telefono, especialidad)
                     values (:f, :h, :m, :p, :n, :c, :t, :e)
                 ");
                 $sql->bindParam(':f', $f, PDO::PARAM_STR);
                 $sql->bindParam(':h', $h, PDO::PARAM_STR);
                 $sql->bindParam(':m', $msj, PDO::PARAM_STR);
                 $sql->bindParam(':p', $p, PDO::PARAM_STR);
                 $sql->bindParam(':n', $n, PDO::PARAM_STR);
                 $sql->bindParam(':c', $c, PDO::PARAM_STR);
                 $sql->bindParam(':t', $t, PDO::PARAM_STR);
                 $sql->bindParam(':e', $e, PDO::PARAM_STR);
                 $sql->execute();
                print_r($sql); exit;
                 $report = "Genial! Su turno ya ha sido reservado.";
                 $sub = "A la brevedad le llegará un correo electrónico confirmando su solicitud.";
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
										<p>&nbsp; &nbsp; &nbsp; &nbsp; 
                                            <?php echo $sub; ?>
                                        </p>
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