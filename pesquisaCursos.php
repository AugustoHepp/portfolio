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
	<title>Resultado busca</title>

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
                                AND cursos.id_categoria = '$categoria'";

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