<?php
	
	require '../Models/Publicacion.php';
	require 'StarterController.php';

	$is = new StarterController();

	if(empty($_SESSION['email'])){//Si hay sesion
		//echo "Debe loguearse primero";
		$is->redirectlogin();

	}

	class PublicacionAdminController extends Publicacion {
		
		public function AdminView(){
			require '../Views/publicaciones1.php';
		}

		public function DetalleView($id){
			require '../Views/Detalle.php';
		}

		public function RedirectLogin(){
			require '../Views/login.php';
		}

		public function Detalle($id){
			$this->id = $id;
			echo $this->Publicacion();			
		}

		public function Listar(){
			$this->ListPublicaciones = $this->ListPublicaciones();
			echo $this->ListPublicaciones;
		}

		public function closeSession(){
			session_destroy();
			header("location: ../index.php");
			//$this->RedirectLogin();
		}
		

	}


	if(isset($_GET['action']) && $_GET['action']=='admin'){
		$instanciacontrolador = new PublicacionAdminController();
		$instanciacontrolador->AdminView();
	}

	if(isset($_GET['action']) && $_GET['action']=='publicacion'){
		$instanciacontrolador = new PublicacionAdminController();
		$id = $_GET['id'];
		$instanciacontrolador->DetalleView($id);
	}

	if(isset($_GET['action']) && $_GET['action']=='lista'){
		$instanciacontrolador = new PublicacionAdminController();
		$instanciacontrolador->Listar();
	}

	if(isset($_GET['action']) && $_GET['action']=='detalle'){
		$instanciacontrolador = new PublicacionAdminController();
		$id = $_GET['id'];
		$instanciacontrolador->Detalle($id);
	}

	if(isset($_GET['action']) && $_GET['action']=='logout'){
		$instanciacontrolador = new PublicacionAdminController();
		$instanciacontrolador->closeSession();
	}//Lo pongo en este controlador y no en usuarioController porque si esta logueado me redirige aca mismo


?>