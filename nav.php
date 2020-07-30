<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar_bgColor">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    <div class="navbar-collapse collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="busca.php">Busca <span class="sr-only">(página atual)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastroUsuario.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastroCategoria.php">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastroCurso.php">Cursos</a>
        </li>
      </ul>

      <?php
        if(isset($_SESSION['email'])){
          echo "<span class='navbar-text'>" . $_SESSION['email'] . "</span>";
        }
      ?>

      <a class="nav-link" href="logout.php">Sair</a>
      <!--
      <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
      </form>
      -->
    </div>
</nav>