<?php
    session_start();
    $admin_id = $_SESSION['usu_codigo'];

    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE || $_SESSION['isAdmin'] === FALSE){
        session_destroy();
        header("Location: ../../../public/view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<!--
            Practica04-Mi Agenda Telefónica
            Página para agregar teléfonos a un usuario
            Authors: Bryan Sarmiento, Eduardo Zhizhpon
            Date: 28/05/2020

            Filename: create_phone.php
		-->
		
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<link rel="shortcut icon" href="../../../images/icons/logo.png"/>

		<link href="../../../css/form_layout.css" rel="stylesheet"/>
		<link href="../../../css/main_format.css" rel="stylesheet"/>
		<link href="../../../css/2_col_layout.css" rel="stylesheet"/>
		
		<script src="../../../js/phone_validation.js"></script>
		<script src="../../../js/crud_phones_admin.js"></script>
		<script src="../../../js/resources.js"></script>

		<title>Registrar Teléfonos - Admin</title>
	</head>

	<body>
		<header id="main_header">
			<div id="logo_container">
				<a href="index.php" id="img_logo">
					<img src="../../../images/icons/logo.png" alt="Logo Game Specs"/>
				</a>

				<form id="f_search" action="search_user.php" method="POST">  
					<input type="search" id="index_search" name="index_search" placeholder="Buscar por cédula o correo"/>
				</form>

				<a href="my_account.php" class="nav_icon">
					<img src="../../../images/icons/user.png" alt="account logo"/>
					<span>Cuenta</span>
				</a>

				<a href="#" class="nav_icon">
					<img src="../../../images/icons/mail.png" alt="feedback logo"/>
					<span>Feedback</span>
				</a>

				<a href="../../../config/close_session.php" class="nav_icon">
					<img src="../../../images/icons/team.png" alt="about logo"/>
					<span>Cerrar Sesión</span>
				</a>
			</div>

			<nav id="header_nav">
				<a class="nav_a" href="index.php">Inicio</a>
				<a class="nav_a" href="users.php">Registrar Usuarios</a>
				<a class="nav_a" href="show_users.php">Listar Usuarios</a>
				<a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar Usuarios</a>
				<a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
				<a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
			</nav>
		</header>
		
		<h1 class="main_title">Registrar Teléfonos</h1>

		<main class="main_container center_container">
			<section class="col col-50">
				<div id="main_notice" class="e_hidden">	
					<div id="notice" class="div_notice"></div>
					<img src="../../../images/icons/close.png" class="close_x" onclick="hideNotice()">
				</div>

				<form id="f_phone" name="f_phone" class="form_data" method="POST">
					
					<label for="i_phone_number" class="l_i_text" >Número:</label>
					<input type="text" name="i_phone_number" id="i_phone_number" class="text_input" 
						placeholder="Número"
						onkeypress="return nNumberValidate(event, 10)" 
						onkeyup="return phoneValidate(this, 10)" 
						onblur="phoneError(this, 10)"/>
					
					<br/>
					
					<label class="l_i_text l_r_text">Tipo:</label>
					<div id="type_phone_container" class="i_r_container">
						<input type="radio" id="r_co" name="tel_type" value="CO" class="i_radio"
							onclick="typePhoneError()">
						<label for="r_co" class="l_radio" name="tel_type_label">Convencional</label><br>
						<input type="radio" id="r_ce" name="tel_type" value="CE" class="i_radio"
							onclick="typePhoneError()">
						<label for="r_ce" class="l_radio" name="tel_type_label">Celular</label><br>
					</div>

					<label for="s_company" class="l_i_text">Operadora:</label>
					<select name="s_company" id="s_company" class="text_input sel_form" onclick="companyPhoneError()">
						<option value="NaN">Seleccione...</option>
						<option value="MOVISTAR">Movistar</option>
						<option value="TUENTI">Tuenti</option>
						<option value="CLARO">Claro</option>
						<option value="ETAPA">Etapa</option>
						<option value="CNT">CNT</option>
						<option value="OTROS">Otros</option>
					</select>
					
					<label class='l_i_text l_r_text' >Eliminado:</label>
					<div id='eliminated_phone_container' class='i_c_container'>
						<input type='checkbox' class='i_check' name='i_check_tel_eliminado' value='E' />
					</div>
					<label for='i_user_dni' class='l_i_text' >CI. Usuario:</label>
					<input type='text' name='i_user_dni' id='i_user_dni' class='text_input' 
						placeholder='Ingrese CI.'
						onkeyup='dniPhoneValidation(this)'
						onblur='dniPhoneError(this)'>
					
					<span id="s_phone_notice" class="s_error_validation"></span>
					<br>
					<div class="d_button_container">
						<input type="button" id="i_send_phone" class="submit_input" value="Agregar" onclick="submitAdminForm()"/>
					</div>
				</form>
			</section>
		</main>

		<footer id="pie">
			<div class="cont_pie">
				<div id="logo_pie">
					<a href="https://www.facebook.com/" target="_blank"><img src="../../../images/icons/faceLogo.png" alt="Facebook Logo"></a>
					<a href="https://www.instagram.com/" target="_blank"><img src="../../../images/icons/instaLogo.png" alt="Instagram Logo"></a>
				</div>
				<img class="logo" src="../../../images/icons/logo.png" alt="LOGO">

				<p>
					Universidad Politécnica Salesiana <br />
					<br/>
					Sarmiento Basurto Douglas Bryan <br/>
					<span><strong>Correo :</strong><a href="mailto:dsarmientob1@est.ups.edu.ec"> dsarmientob1@est.ups.edu.ec</a></span> <br />
					<br/>
					Zhizhpon Tacuri Cesar Eduardo <br/>
					<span><strong>Correo :</strong><a href="mailto:czhizhpon@est.ups.edu.ec"> czhizhpon@est.ups.edu.ec</a></span> <br />
					<br/>
					&copy; Todos los derechos reservados
				</p>
			</div>

			<div class="cont_pie">
				<fieldset>
					<legend>Gestión de Usuarios</legend>
					<nav>
					<a class="nav_a" href="users.php">Registrar Usuarios</a>
					<a class="nav_a" href="show_users.php">Listar Usuarios</a>
					<a class="nav_a" href="manage_users.php?readAction=-1&usu_id=-1">Administrar usuarios</a>
					</nav>
				</fieldset>
			</div>

			<div class="cont_pie">
				<fieldset>
					<legend>Gestión de Teléfonos</legend>
					<nav>
						<a class="nav_a" href="create_phone.php">Registrar Teléfonos</a>
						<a class="nav_a" href="manage_phones.php">Administrar Teléfonos</a>
					</nav>
				</fieldset>
			</div>
		</footer>
	</body>
</html>
