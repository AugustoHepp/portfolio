<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>

    <title>DbSeed</title>
    
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

<body class="dbSeed">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
				<h3 class="card-title">Database seeder</h3>
			</div>
            <div class="card-body">
                <?php
                    include "conexao.php";

                    //Limpando a base de dados
                    echo "Excluindo tabelas preexistentes na base de dados..." . ".<br>.<br>";
                    $sucesso = TRUE;
                    
                    $sql = "DROP TABLE IF EXISTS usuarios";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao dropar a tabela usuarios" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    }

                    $sql = "DROP TABLE IF EXISTS cursos";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao dropar a tabela cursos" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    }

                    $sql = "DROP TABLE IF EXISTS categorias";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao dropar a tabela categorias" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    }
                    //Limpando a base de dados

                    //Criando tabelas
                    echo "Criando tabelas..." . " <br><br><br>";
                    $sql = "CREATE TABLE IF NOT EXISTS usuarios
                            (id_usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            email VARCHAR(255) NOT NULL,
                            senha VARCHAR(255) NOT NULL)";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao criar a tabela usuários" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    } else {
                        echo "Tabela usuarios criada com sucesso..." . " <br><br><br>";
                    }

                    $sql = "CREATE TABLE IF NOT EXISTS categorias
                            (id_categoria INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            categoria_nome VARCHAR(255) NOT NULL)";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao criar a tabela categorias" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    } else {
                        echo "Tabela categorias criada com sucesso..." . " <br><br><br>";
                    }

                    $sql = "CREATE TABLE IF NOT EXISTS cursos
                            (id_curso INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            curso_nome VARCHAR(255) NOT NULL,
                            curso_descricao VARCHAR(255) NOT NULL,
                            id_categoria INT(11) NOT NULL,
                            CONSTRAINT fk_curso_categoria FOREIGN KEY (id_categoria)
                            REFERENCES categorias (id_categoria))";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao criar a tabela cursos" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    } else {
                        echo "Tabela cursos criada com sucesso..." . " <br><br><br>";
                    }
                    //Criando tabelas

                    //Populando tabelas
                    echo "Populando as tabelas..." . ".<br>.<br>";
                    $sql = "INSERT INTO categorias(categoria_nome) VALUES
                            ('Programação'),
                            ('Ciência de dados'),
                            ('Banco de dados')";

                    echo "Inserindo registros na tabela categorias..." . " <br><br><br>";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao inserir dados na tabela categorias" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    } else {
                        echo "Registros inseridos..." . " <br><br><br>";
                    }

                    $sql = "INSERT INTO cursos(curso_nome, curso_descricao, id_categoria) VALUES
                            ('PHP', 'Programação back-end com PHP e MySql', 1),
                            ('Python Data Science', 'Python orientado a análise de dados', 2),
                            ('DBA', 'Administração de banco de dados', 3)";

                    echo "Inserindo registros na tabela cursos..." . " <br><br><br>";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Erro ao inserir dados na tabela cursos" . "<br>" . "Erro: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . "<br>";
                        $sucesso = FALSE;
                    } else {
                        echo "Registros inseridos..." . " <br><br><br>";
                    }
                    //Populando tabelas

                    echo "Processo finalizado!" . " <br><br><br>";

                    if ($sucesso) {
                        echo "<a href='login.php'>Acessar o sistema</a>";
                    } else {
                        echo "Verifique os erros gerados e tente novamente";
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
