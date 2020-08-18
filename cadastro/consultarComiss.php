<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style type="text/css">
      .carregando{
        color:#ff0000;
        display:none;
      }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Comissões</title>
  </head>
  <body>
  <?php include_once "conexao.php"; ?>
  
    <div class="container">
      <div class="row">
        <div class="col">
        <h1>Comissões</h1>
        <nav class="navbar navbar-light bg-light">
          <form action="resultComiss.php" method="POST">
            <select name="setor" id="setor">    
              <option value="" selected = selected>Selecione uma área</option>
              <?php
               
                 $sql = "SELECT * FROM VC11 ORDER BY VC11_DS_SETOR";
               
                 $dados = mysqli_query($conexao, $sql);
               
                while($row = mysqli_fetch_assoc($dados)) {
                  $setor = $row['VC11_CD_SETOR'];
                  $descri = $row['VC11_DS_SETOR'];
                  echo '<option value="'.$setor.'">'.$descri.'</option>';
                }
              ?> 
            </select><br><br>
            
            <span class="carregando">Aguarde, carregando... </span>
            <select name="funcionario" id="funcionario">    
              <option value="" selected = selected checked disabled>Selecione o funcionário</option>
            </select><br><br>
          <button class="btn btn-primary" type="submit">Pesquisar</button>
          </form>
        </nav>

      
        <a href="index.php" class="btn btn-info">Voltar para o inicio</a>
        </div>
      </div>
    </div>
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $('#setor').change(function(){
          if($(this).val()) {
            $('#funcionario').hide();
            $('.carregando').show();
            
            $.getJSON('funcionarios.php?search=',{setor: $(this).val(), ajax: 'true'}, function(j){
              var options = '<option value=""> Escolha o funcionario</option>';
              for(var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].VC03_CD_FUNC + '">' + j[i].VC03_NM_FUNC + '</option>';
              }
              $('#funcionario').html(options).show();
              $('.carregando').hide();
            });
          } else {
              $('#funcionario').html('<option value=""> - Escolha o funcionário - </option>');
          }
        });
      });
    </script>
  </body>
</html>