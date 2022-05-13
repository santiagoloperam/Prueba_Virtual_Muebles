<?php 
	require '../Config/Conexion.php';
	class Publicacion{
		protected $id;
		protected $titulo;
		protected $contenido;
		protected $imagen;
		protected $correo;

		protected $publicaciones;
		protected $publicacion;

		protected function insertPublicacion(){

			$con = new Conexion();

			$sql = "INSERT INTO publicaciones (titulo,contenido,imagen,correo) VALUES (?,?,?,?)";

			$insertar = $con->db->prepare($sql);
			$insertar->bindParam(1,$this->titulo);
			$insertar->bindParam(2,$this->contenido);
			$insertar->bindParam(3,$this->imagen);
			$insertar->bindParam(4,$this->correo);
			$insertar->execute();

			//echo $lista = $this->ListPublicaciones();

		}

		public function Publicacion(){
			$con = new Conexion();

			$sql = "SELECT * FROM publicaciones WHERE id='$this->id'";

			$consulta = $con->db->prepare($sql);
			$consulta->execute();
			$objetoconsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
		    return json_encode($objetoconsulta);
		}

		protected function ListPublicaciones(){
			$con = new Conexion();

			$sql = "SELECT * FROM publicaciones ORDER BY fecha DESC";

			$consulta = $con->db->prepare($sql);
			$consulta->execute();
			$objetoconsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
		    return json_encode($objetoconsulta);
		}
	}

 ?>