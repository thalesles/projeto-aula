<?php
session_start();
include_once "dao/professorDAO.class.php";
include_once "modelo/professores.class.php";
//include_once "util/helper.class.php";
$professorDAO = new professorDAO();
$professor = $professorDAO->buscarProfessores();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta de professores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de Professores!</h1>

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

    <h2>Consulta de Professores!</h2>

    <form name="filtrolivros" method="post" action="">
      <div class="row">
      <div class="form-group col-md-6">
        <input type="text" name="txtfiltro" placeholder="Digite o que deseja buscar" class="form-control animated">
      </div>
      <div class="form-group col-md-6">
        <select class="form-control" name="selfiltro">
          <option value="selecione">idProfessor</option>
          <option value="idProfessor">Código</option>
          <option value="nome">nome</option>
          <option value="idade">idade</option>
          <option value="turma">turma</option>
          <option value="horario">horario</option>
          <option value="telefone">telefone</option>
          <option value="salario">salario</option>
          <option value="beneficios">beneficios</option>

        </select>
        </div>
      </div>

      <div class="form-group" >
        <input type="submit" name="pesquisar" value="Pesquisar" class="form-control animated">
      </div>

    </form>

    <?php
    if (isset($_SESSION['msg'])) {
      Helper::alert($_SESSION['msg']);
      Helper::h2($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if (isset($_POST['pesquisar'])) {
      $filtro = $_POST['selfiltro'];
      $pesquisa = $_POST['txtfiltro'];
      $qtdErro = 0;
      if ($filtro == 'selecione' || $pesquisa == "") {
        $aluno = $aln->buscarProfessores();
        $qtdErro++;
      }

      if ($qtdErro == 0) {
        $query = "";
        if($filtro == 'idProfessor'){
          $query = "where idProfessor = ".$pesquisa;
        }
        else if($filtro == 'nome'){
          $query = "where nome = '".$pesquisa."'";
        }
        else if($filtro == 'idade'){
          $query = "where idade = '".$pesquisa."'";
        }
        else if($filtro == 'turma'){
          $query = "where turma = ".$pesquisa;
        }
        else if($filtro == 'horario'){
          $query = "where horario = '".$pesquisa."'";
        }
        else if($filtro == 'telefone'){
          $query = "where telefone = '".$pesquisa."'";
        }
        else if($filtro == 'salario'){
          $query = "where salario = '".$pesquisa."'";
        }
        else if($filtro == 'beneficios'){
          $query = "where beneficios = '".$pesquisa."'";
        }
        $professores = $pfs->filtrarProfessores($query);
      }
  }



    //var_dump($livros); //SOMENTE PARA TESTES
    if(count($Professores) == 0){
      Helper::alert("Nao ah Professores Cadastrados!");
      echo "<h2>Sem professores no banco!</h2>";
      die();
    } //SQL --> delete from livro;
    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered
                    table-hover table-condensed">
        <thead>
          <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Turma</th>
            <th>Horario</th>
            <th>Telefone</th>
            <th>salario</th>
            <th>beneficios</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Turma</th>
            <th>Horario</th>
            <th>Telefone</th>
            <th>salario</th>
            <th>beneficios</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>

        <tbody>
          <?php
          foreach($aluno as $aln){
            echo "<tr>";
              echo "<td>$pfs->idProfe]</td>";
              echo "<td>$pfs->nome</td>";
              echo "<td>$pfs->idade</td>";
              echo "<td>$pfs->turma</td>";
              echo "<td>$pfs->horario</td>";
              echo "<td>$pfs->telefone</td>";
              echo "<td>$pfs->salario</td>";
              echo "<td>$pfs->beneficios</td>";
              echo "<td><a href='consulta-professores.php?id=$pfs->idProfessores'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Excluir</button></a></td>";
              echo "<td><a href='alterar-professores.php?id=$pfs->idProfessores'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-remove'></span> Alterar</button> </a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div><!-- table responsive -->
  </div>
  <?php
  if (isset($_GET['id'])) {
    $pfs->deletarProfessor($_GET['id']);
    $_SESSION['msg'] = "Professor excluido com sucesso!";
    header("location:consulta-professor.php");
    unset($_GET['id']);
  }
   ?>
</body>
</html>
