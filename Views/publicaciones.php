
	<!DOCTYPE html>
	<html>
		<head>
			<title>Publicaciones</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="../Css/Style.css">
		</head>
		<body>
			<header>
				<nav class="navbar navbar-light bg-light">
					<a class="btn btn-primary" href="http://localhost/virtual_muebles/index.php">
						ATRAS
					</a>
				</nav>		
			</header>
			<div class="container mb-3 border" id="all">
				
				<form action="" method="POST" id="myform">

					<input type="hidden" name="action" value="insert">

				  <div class="mb-3 mt-3">				  	
				    <input name="titulo" type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
				  </div>
				  <div class="mb-3">
				    <input name="correo" type="email" class="form-control" id="correo" name="correo" placeholder="Email">
				  </div>
				  <div class="mb-3">
				    <input name="imagen" type="text" class="form-control" id="imagen" name="imagen" placeholder="URL Imagen">
				  </div>
				  <div class="mb-3">
				    <textarea name="contenido" class="form-control" id="contenido" name="contenido" rows="4" cols="50" placeholder="Contenido">
				    </textarea>
				  </div>
				  <div class="mb-3">
	            	<div class="g-recaptcha" data-sitekey="6LfMmuofAAAAAEeeWIwCXd3wPaETGvkHPXxpjqNi"></div>
	              </div>				  
				  <button type="submit" class="btn btn-primary mb-3">Guardar</button>
				</form>

			

				<div class="container">					
					<h3>LISTA DE POSTS</h3>	
					<div id="lista"></div>
				</div>
			</div>

			<!--SCRIPTS-->
			<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script src="https://www.google.com/recaptcha/api.js" async defer></script>
			<script type="text/javascript">
	   			$(document).ready(function () {  
	   				
	   				$.ajax({
					    type: "GET",
					    url: "PublicacionController.php?action=lista",
					    success: function(data) {
					    	//console.log("data");
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

					    	//console.log(data);
					    	data = JSON.parse(data);
					    	pintar(data);
					  		}//fin success

				  		});//fin ajax

	   				$('#myform').on('submit', function(e){
					  e.preventDefault(); // Evitas que haga el submit por default

					  var datosFormulario = $(this).serialize();

					  $.ajax({
					    type: "POST",
					    url: "PublicacionController.php",
					    data: datosFormulario,
					    success: function(data1) {
					    	console.log("dede insert JSON");
					    	data1.replace("	", " ")
					    	.replace(/\\n/g, "\\n")
					    	.replace(/\\'/g, "\\'")
					    	.replace(/\\"/g, '\\"')
					    	.replace(/\\&/g, "\\&")
					    	.replace(/\\r/g, "\\r")
					    	.replace(/\\t/g, "\\t")
					    	.replace(/\\b/g, "\\b")
					    	.replace(/\\f/g, "\\f")
					    	.replace(/[\u0000-\u0019]+/g,"");				    	
					    	data1 = JSON.parse(data1);
					    	console.log(data1);
				    			$("#myform").load(" #myform");
				    			$("#list").load(" #list");
				    			$('#myform').empty();
					    		pintar(data1);
					  		}//fin success

				  		});//fin ajax

		   			});//fin submit

		   			function pintar(data) {
		   				let list=$("#lista");
		   					list.html("");

					    	for(i=0; i < data.length; i++){
		                        var row = data[i];
		                        let html =  `<div class="row mb-3 border">
												<div class="col md-12">
													<div class="row mb-3">
														<div class="col md-1">
															<span class="left"><b>${row.titulo}</b></span>
														</div>
														<div class="col md-10"></div>
														<div class="col md-1">
															<span class="right">${row.fecha}</span>
														</div>								
													</div>
													<div class="row mb-3">
														<div class="col md-3">
															<img src="${row.imagen}">
														</div>
														<div class="col md-8">
															${row.contenido}
														</div>
													</div>
												</div>						
											</div>`;
							    	list.append(html);
						  		}//fin for
						  	}//Fin pintar()

	   			});//fin document ready

	  		</script>
		</body>
	</html>



