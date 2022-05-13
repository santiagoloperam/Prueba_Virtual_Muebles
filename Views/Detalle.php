<?php 

	if(empty($_SESSION['email'])){
		//echo "Debe loguearse primero";
		//$is->redirectinsert(); //No funciona porque no se redirecciona desde la carpeta Controllers
		header("location: Controllers/UsuarioController.php?action=login");
	}

 ?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Detalle de Publicaciones</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="../Css/Style.css">
		</head>
		<body>
			<header>
				<nav class="navbar navbar-light bg-light">
					<a class="btn btn-primary" href="http://localhost/virtual_muebles/Controllers/PublicacionAdminController.php?action=logout">
						LOGOUT <!-- NO LO ENVIO A UsuarioController SINO A OTRO PORQUE LOGUEADO NO PERMITE ENTRAR -->
					</a>
				</nav>		
			</header>
			<div class="container mb-3 border" id="all">
				<div class="container">					
					<h3>DETALLE DEL POST</h3>	
					<div id="detalle"></div>
				</div>
			</div>
			

			<!--SCRIPTS-->
			<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script type="text/javascript">
	   			$(document).ready(function () { 

	   				let params = new URLSearchParams(location.search);
					var id = params.get('id'); 
					console.log("id");
					console.log(id);
	   				
	   				$.ajax({
					    type: "GET",
					    url: `PublicacionAdminController.php?action=detalle&id=${id}`,
					    success: function(data) {
					    	console.log("data");
					    	data.replace("	", " ")
					    	.replace(/\\n/g, "\\n")
					    	.replace(/\\'/g, "\\'")
					    	.replace(/\\"/g, '\\"')
					    	.replace(/\\&/g, "\\&")
					    	.replace(/\\r/g, "\\r")
					    	.replace(/\\t/g, "\\t")
					    	.replace(/\\b/g, "\\b")
					    	.replace(/\\f/g, "\\f")
					    	.replace(/[\u0000-\u0019]+/g,"");
					    	console.log("data succes");
					    	console.log(data);
					    	data = JSON.parse(data);
					    	pintar(data);
					  		}//fin success

				  		});//fin ajax

	   				

		   			function pintar(data) {
		   				let detalle=$("#detalle");
		   					detalle.html("");
		                        var row = data[0];
		                        let html =  `<div class="row mb-3 detalle">
		                        				<div class="col md-12">
													<img class="img_detalle" src="${row.imagen}">
												</div>
												<div class="col md-12">
													<div class="row mb-3">
														<div class="col md-1">
															<span class="left"><b>${row.titulo}</b></span>
														</div>
														<div class="col md-10">
															<h6><b>Autor</b></h6>
															<b>${row.correo}</b>
														</div>
														<div class="col md-1">
															<span class="right">${row.fecha}</span>
														</div>								
													</div>
													<div class="row mb-3">														
														<div class="col md-11">
															${row.contenido}
														</div>
													</div>
												</div>						
											</div>
											<div class="row mb-3">
	                        					<nav class="navbar navbar-light bg-light">			                        						
													<a class="btn btn-secondary" href="http://localhost/virtual_muebles/Controllers/PublicacionAdminController.php?action=admin">
														Atras
													</a>
												</nav>	
											</div>`;
							    	detalle.append(html);
						  	}//Fin pintar()

	   			});//fin document ready

	  		</script>
		</body>
	</html>

