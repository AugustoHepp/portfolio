<?php
	session_start();
	include "conexao.php";

	if (!isset($_SESSION['email'])) {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
            				Área restrita. Faça login! </div>";
		header("Location: login.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8" />
	<title>Busca</title>

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
	<?php
		include "nav.php"
	?>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Busca</h3>
					<?php
						if (isset($_SESSION['msg'])) {
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					?>
				</div>
				<div class="card-body">
					<form name="busca" method="POST" action="pesquisaCursos.php">
						
						<div class="input-group">
							<span class="input-group-btn btn_busca">
								<button class="btn btn-default btn_busca" type="submit"><i class="fa fa-search fa-lg"></i></button>
							</span>
							<input type="text" class="form-control" name="campoBusca" placeholder="Pesquisar...">
						
							<select name = "categoria" class="form-control ml-2" style="margin-inline: 10px !important;">
								<option value = "">Categoria</option>

								<?php

									$sql = "SELECT id_categoria, categoria_nome FROM categorias";

									$rsCategorias = mysqli_query($conn, $sql) or die(mysqli_error($conn));

									while($registrosCategorias = mysqli_fetch_array($rsCategorias)){

										$id_categoria = $registrosCategorias['id_categoria'];
										$categoria_nome = $registrosCategorias['categoria_nome'];

										echo "<option value = '$id_categoria'>$categoria_nome</option>";

									}

								?>
							</select>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>