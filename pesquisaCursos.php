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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
    
	<title>Resultado busca</title>

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
					<h3 class="card-title">Resultado da busca</h3>
					<?php
						if (isset($_SESSION['msg'])) {
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					?>
				</div>
				<div class="card-body">   
                    <?php
                        $campoBusca=$_POST['campoBusca'];
                        $categoria=$_POST['categoria'];

                        $sql = "SELECT id_curso, curso_nome, curso_descricao, categoria_nome FROM cursos INNER JOIN categorias
                                ON cursos.id_categoria = categorias.id_categoria WHERE curso_descricao LIKE '%" . $campoBusca . "%'   
                                AND cursos.id_categoria = '$categoria' ORDER BY id_curso";

                        $resultado = mysqli_query($conn, $sql);
                        $NumRegistros = mysqli_num_rows($resultado);
                        
                        if ($NumRegistros > 0) {?>
                            <table class="table m-4">
                                <thead class="thead_custom">
                                    <tr class="trow_custom">
                                        <th class="card-text">Id</th>
                                        <th class="card-text">Nome</th>
                                        <th class="card-text">Descrição</th>
                                        <th class="card-text">Categoria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                while($cursosRegistro = mysqli_fetch_array($resultado)){
                                    
                                    $id = $cursosRegistro['id_curso'];
                                    $nome = $cursosRegistro['curso_nome'];
                                    $descricao = $cursosRegistro['curso_descricao'];
                                    $categoria = $cursosRegistro['categoria_nome'];
                               
                                ?>
                                
                                <tr class="trow_custom">
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $nome ?></td>
                                    <td><?php echo $descricao ?></td>
                                    <td><?php echo $categoria ?></td>

                                </tr> 
                            <?php
                                }
                            ?>
                            </tbody></table>
                            <?php
                                } else {
                                    $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>
                                                        Nenhum registro encontrado</div>";
                                    header("Location: busca.php");
                                }
                                mysqli_close($conn);
                            ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>