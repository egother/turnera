<!DOCTYPE HTML>

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
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt" style="padding: 15px">
						<span class="logo"><img src="images/logo.png" alt="" style="max-width: 30%"/></span>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">

								<!-- Text -->
									<section>
										<h2 style="text-align: right;">Solicite aquí su turno &nbsp; &nbsp;<i class="far fa-calendar-check fa-2x"></i></h2>
                                        <br />
										<hr />
										<p>&nbsp; &nbsp; &nbsp; &nbsp; Para obtener un diagnóstico preciso es imprescindible evaluar cada caso en detalle, valorando aspectos que varían de persona a persona, como la calidad de su piel, las proporciones anatómicas, etc. Para ello, será necesaria una visita a nuestro consultorio, donde se te facilitará la información específica de tu tratamiento. La naturalidad de los resultados es el objetivo principal en todas las intervenciones estéticas.</p>
										<hr />
									</section>

								<!-- Form -->
									<section>
										<form method="post" action="../app/enviarSolicitud.php ">
											<div class="row uniform">
												<div class="6u 12u$(xsmall)">
													<input type="text" name="nombre" id="nombre" value="" placeholder="Nombre y Apellido *" required/>
												</div>
												<div class="6u$ 12u$(xsmall)">
													<input type="email" name="email" id="email" value="" placeholder="Email *" required/>
												</div>
												<div class="6u 12u$">
													<input type="text" name="telefono" id="telefono" value="" placeholder="Teléfono (Opc.)" />
												</div>
												<div class="6u 12u$(xsmall)">
													<div class="select-wrapper">
														<select name="especialidad" id="especialidad" onchange=actualizarProf(this.value)>
															<option value="">- Especialidad -</option>
															<option value="cirugiaplastica">Cirugía Plástica</option>
															<option value="cirugiageneral">Cirugía General</option>
															<option value="medicinaestetica">Medicina Estética</option>
															<option value="flebotomia">Flebotomía</option>
															<option value="cirugialaparoscopica">Cirugía Laparoscópica</option>
															<option value="dermatologiaclinica">Dermatología Clínica</option>
															<option value="dermatologiaestetica">Dermatología Estética</option>
															<option value="ginecologia">Ginecología y Obstreticia</option>
															<option value="esteticagenitalfemenina">Estética Genital Femenina</option>
															<option value="psicologia">Psicología</option>
															<option value="cosmetologia">Cosmetología</option>
															<option value="cirugiapediatrica">Cirugía Pediátrica</option>
														</select>
													</div>
												</div>
												<div class="6u 12u$(xsmall)">
													<div class="select-wrapper">
														<select name="profesional" id="profesional" onchange=habilitarDias(this.value) required>
															<option value="">- Profesional -</option>
															<option value="ramallo">Dr. Ramallo Julián</option>
															<option value="lamas">Dra. Lamas Cecilia</option>
															<option value="dejuana">Dr. De Juana Gastón P.</option>
															<option value="cardozo">Dra. Cardozo Gutiérrez Romina</option>
															<option value="parisi">Dr. Parisi Ricardo</option>
															<option value="espil">Lic. Espil Clara</option>
															<option value="peralta">Lic. Peralta Francisca</option>
															<option value="reusmann">Dra. Reusmann Aixa</option>
														</select>
													</div>
												</div>
												<div class="6u 12u$(small)">
                                                    <input type="text" name="fecha" id="fecha" style="width:200px;" readonly="true" disabled="true" placeholder="Fecha" required />
												</div>
												<div id="txtHint" class="3u 12u$(small)">
                                                    <!-- acá van a aparecer los horarios disponibles--><input type="text" placeholder="Horarios disponibles" disabled required />
                                                </div>
												<div class="12u$">
													<textarea name="mensaje" id="mensaje" placeholder="Consulta" rows="6"></textarea>
												</div>
												<div class="12u$ 12u$(small)">
													<label style="text-align: right; color: orange">* Requerido</label>
												</div>
												<div class="12u$">
													<ul class="actions">
														<li><input type="submit" value="Reservar" class="special" /></li>
														<li><input type="reset" value="Vaciar" /></li>
														<li><input type="button" value="Cancelar" onclick="window.location = 'index.html'"/></li>
													</ul>
												</div>
											</div>
										</form>
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
        
        <!-- Scripts para el datepicker -->
            <script src="assets/js/formulario.js"></script>
            <script src="dist/js/glDatePicker.min.js"></script>

	</body>
</html>

<!-- Info Doctores y Especialidades

    Dr. Ramallo Julian
        Cirugia Plastica, Cirugia General, Medicina Estetica, Flebotomia, Cirugia Laparoscopica
        Jueves 14-20hs; 
    Dra. Lamas Cecilia
        Dermatologia Clinica, Dermatologia Estetica, Medicina Estetica
        Martes 12-20hs
    Dr. De Juana Gastón P.
        Cirugia Plastica, Cirugia General
        Miércoles 14-16hs
    Dra. Cardozo Gutierrez Romina
        Ginecologia y Obstetricia, Estetica Genital Femenina
        Lunes 16-18hs
    Dr. Parisi Ricardo
        Cirugia General
        Jueves 16-18hs
    Lic. Espil Clara
        Psicologia
        Lunes 17-20hs
    Lic. Peralta Francisca
        Cosmetologia
        Sabados 9-13hs
    Dra. Reusmann Aixa
        Cirugia Pediatrica
        Lunes 14-17hs

-->