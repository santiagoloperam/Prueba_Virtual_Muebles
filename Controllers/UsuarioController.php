<?php
	require '../Models/Usuario.php';
	require_once 'StarterController.php';
	$is = new StarterController(); // Iniciar variables de session

	if(!empty($_SESSION['email'])){
		//echo "Debe loguearse primero";
		$is->redirectPublicacionAdmin();

	}

	class UsuarioController extends Usuario {
		
		public function LoginView(){
			require '../index.php';
		}

		public function VerifyLogin($email,$password){
			$this->email = $email;
			$this->password = $password;
			$infoUsuario = $this->SearchUsuario();
			var_dump("$infoUsuario \n");
			var_dump($infoUsuario);
			foreach ($infoUsuario as $usuario) {}
			var_dump("$usuario->password \n");
			var_dump($usuario->password);
			$verified = ($password == $usuario->password);
			var_dump($verified);
			if($verified){
				$_SESSION['email'] = $usuario->email;
				$_SESSION['rol'] = $usuario->rol;
				$this->RedirectAfterLogin();
				
			}else{
				echo "Contraseña incorrecta";
			}
		}

		public function RedirectAfterLogin(){
			//Redireccionar a la rta principal o dashboard de logueado
			if($_SESSION['rol']==1){
				header("location: PublicacionAdminController.php?action=admin");
			}
			
		}

	}

	if(isset($_GET['action']) && $_GET['action']=='login'){
		$instanciacontrolador = new UsuarioController();
		$instanciacontrolador->LoginView();
	}


	if(isset($_POST['action']) && $_POST['action']=='login'){
		$instanciacontrolador = new UsuarioController();
		$instanciacontrolador->VerifyLogin($_POST['email'], $_POST['password']);
	}
	

?>