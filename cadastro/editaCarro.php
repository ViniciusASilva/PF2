<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Alteração de cadastro</title>
  </head>
  <body>
    <?php
	  include 'conexao.php';
	
	  $id = $_GET['id'] ?? '';
	  $sql = "SELECT * FROM carros WHERE VC01_CD_CAR = $id";
	  
	  $dados = mysqli_query($conexao, $sql);
	  
	  
	  $linha = mysqli_fetch_assoc($dados);
	?>
  
    <form name="signup" method="post" action="editando.php">
	<center><h1>Alteração de cadastro</h1></center> <br /> <br />
	Nome do proprietário: <input type="text" name="proprietario" required value="<?php echo $linha['VC01_NM_PROP']?>" /> <br /> <br />
	Modelo:               <input type="text" name="modelo" required value="<?php echo $linha['VC01_NM_MODELO']?>" /> <br /> <br />
	Marca:                <input type="text" name="marca" required value="<?php echo $linha['VC01_NM_MARCA']?>" /> <br /> <br />
	Ano: <input type="text" name="ano" required value="<?php echo $linha['VC01_DT_ANO']?>"/> <br /> <br />
	Cor: <input type="text" name="cor" required value="<?php echo $linha['VC01_NM_COR']?>"/> <br /> <br />
	Placa: <input type="text" name="placa" required value="<?php echo $linha['VC01_NM_PROP']?>"/> <br /> <br />
	Qtde. passageiros: <input type="text" name="qtpass" required value="<?php echo $linha['VC01_QT_PASS']?>"/> <br /> <br />
	Vlr. Compra: <input type="text" name="vlrcompra" required value="<?php echo $linha['VC01_VL_COMPRA']?>"/> <br /> <br />
	Nr. vaga: <input type="text" name="nrvaga" required value="<?php echo $linha['VC01_NR_PATIO']?>"/> <br /> <br />
	KM Rodados: <input type="text" name="nrkm" required value="<?php echo $linha['VC01_NR_KM']?>"/> <br /> <br />
	<input type="submit" class="btn btn-primary" value="Salvar alterações" \>
	<input type="hidden" name="id" value="<?php echo $linha['VC01_CD_CAR']?>" \>
	<a href="index.php" class="btn btn-primary">Voltar</a>
	</form>
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>