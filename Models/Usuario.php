<?php 
	require '../Config/Conexion.php';
	class Usuario{
		protected $id;
		protected $email;
		protected $password;		

		protected function SearchUsuario(){
			$con = new Conexion();

			$sql = "SELECT * FROM users WHERE email='$this->email'";

			$consulta = $con->db->prepare($sql);
			$consulta->execute();
			$objetoconsulta = $consulta->fetchAll(PDO::FETCH_OBJ);


			return $objetoconsulta;
		}
	}

 ?>