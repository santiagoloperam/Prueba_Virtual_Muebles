<?php 

class StarterController{

	public function __construct(){
		session_start();
	}

	public function redirectlogin(){
		header("location: UsuarioController.php?action=login");
	}

	public function redirectPublicacionAdmin(){ // o redirect cualquier pagina con logueo
		header("location: PublicacionController.php?action=admin");// No funciona por eso lo puse directo en el login
	}


}


 ?>