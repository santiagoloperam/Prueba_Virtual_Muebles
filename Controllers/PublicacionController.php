<?php
	
	require '../Models/Publicacion.php';

	class PublicacionController extends Publicacion {
		
		
		public function NormalView(){
			require '../Views/publicaciones.php';
		}

		public function Listar(){
			$this->ListPublicaciones = $this->ListPublicaciones();
			echo $this->ListPublicaciones;
		}


		public function saveInfoForModel($titulo,$imagen,$contenido,$correo){
			$this->titulo = $titulo;
			$this->imagen = $imagen;
			$this->contenido = $contenido;
			$this->correo = $correo;
			
			$this->insertPublicacion();
			return $this->ListPublicaciones();
			
		}
		

	}


	if(isset($_GET['action']) && $_GET['action']=='normal'){
		$instanciacontrolador = new PublicacionController();
		$instanciacontrolador->NormalView();
	}

	if(isset($_GET['action']) && $_GET['action']=='lista'){
		$instanciacontrolador = new PublicacionController();
		$instanciacontrolador->Listar();
	}

	if(isset($_POST['action']) && $_POST['action']=='insert'){
		$instanciacontrolador = new PublicacionController();

		var_dump($_POST);
		$titulo = $_POST['titulo'];
		$imagen = $_POST['imagen'];
		$contenido = $_POST['contenido'];
		$correo = $_POST['correo'];

		//Validacioón reCAPTCHA
		$ip = $_SERVER['REMOTE_ADDR'];
		$captcha = $_POST['g-recaptcha-response'];
		$secretkey = "6LfMmuofAAAAANCiI15-LkC-vVdUdJNeqHsiCjNm";

		$respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

		$atributos = json_decode($respuesta, TRUE);

		if (!$atributos['success']) {
			$errors[] = 'Verificar Captcha';
			header("location: ../Views/publicaciones.php"); //Lo devuelve a Login
		}else {
			$instanciacontrolador->saveInfoForModel(
				$titulo,
				$imagen,
				$contenido,
				$correo
			);
		}
	}


?>