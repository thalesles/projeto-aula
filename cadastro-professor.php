<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de Professores</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Cadastro de Professores</h1>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-aluno.php">Cadastro de aluno</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-professor.php">Cadastro de professor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-aluno.php">Consulta de aluno</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consulta-professor.php">Consulta de professor</a>
              </li>
            </ul>
          </div>
        </nav>

        <form name="cadaluno" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numidade" placeholder="Idade" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtturma" placeholder="Turma" class="form-control">
          </div>
          <div class="form-group">
            <select name="selhorario" class="form-control">
              <option value="integral">Integral (7:00 as 19:00 hrs)</option>
              <option value="meioTurno">Meio turno (7:00 as 13:00 hrs ou 13:00 as 19:00)</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="txttel" placeholder="Telefone para contato" class="form-control">
          </div>

          <div class="form-group">
            <input type="text" name="txtsalario" placeholder="Salario : " class="form-control">
          </div>

          <div class="form-group">
            <input type="text" name="txtbeneficios" placeholder="beneficios: " class="form-control">
          </div>

          <div class="form-group">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <!-- FALTA CÓDIGO -->
        <?php
        //AQUI....
        if(isset($_POST['cadastrar'])){
          include_once "modelo/aluno.class.php";
          include_once "dao/professorDAO.class.php";
          include_once "util/helper.class.php";
          include_once "util/padronizacao.class.php";
          include_once "util/validacao.class.php";

          $qtdErros=0;

          if(!Validacao::validarProfessor($_POST['txtnome'])){
            $qtdErros++;
            Helper::alert("Nome inválido!");
          }
          //demais ifs
          if($qtdErros == 0){
            $pfs = new Professor();
            $pfs->titulo =  Padronizacao::padronizarMainMin($_POST['txttitulo']);
            $pfs->editora = Padronizacao::padronizarMainMin($_POST['txteditora']);
            $pfs->autor =   Padronizacao::padronizarMainMin($_POST['txtautor']);
            $pfs->anoLanc = $_POST['txtanolanc'];
            $pfs->genero = $_POST['selgenero'];
            $professorDAO = new professorDAO();
            $professorDAO->cadastrarProfessor($pfs);
            unset($_POST);
            Helper::alert("Professor cadastrado com sucesso!");
          }//fecha if validacao
        }//fecha if isset
        ?>
      </div>
  </body>
</html>
