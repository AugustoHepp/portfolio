<?php
    session_start();
    //include "conexao.php";

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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	
	<title>Categorias</title>
	
	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
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
                <h3 class="card-title">Cadastrar categoria</h3>
                <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
				?>
			</div>
			<div class="card-body">
				<form name="categoria" method="POST" action="cadastrarCategoria.php">
					<div class="input-group form-group">
						<input type="text" name="categoria" required="" class="form-control" placeholder="categoria">
					</div>
					<div class="form-group">
						<input type="submit" value="Cadastrar" class="btn btn-block login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>