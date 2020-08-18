<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Editando...</title>
  </head>
  <body>
    
	<?php
	include "conexao.php";
    $id=$_POST['id'];
	$proprietario=$_POST['proprietario'];
	$modelo=$_POST['modelo']; 
	$marca=$_POST['marca']; 
	$ano=$_POST['ano']; 
	$cor=$_POST['cor']; 
	$placa=$_POST['placa']; 
	$qtpass=$_POST['qtpass']; 
	$vlrcompra=$_POST['vlrcompra']; 
	$nrvaga=$_POST['nrvaga'];
    $nrkm=$_POST['nrkm'];

	$sql = "UPDATE carros set VC01_NM_PROP = '$proprietario', VC01_NM_MARCA = '$marca', VC01_NM_COR = '$cor', VC01_NM_CAR = '$placa', VC01_QT_PASS = '$qtpass', VC01_NM_MODELO = '$modelo', VC01_VL_COMPRA = '$vlrcompra', VC01_DT_ANO = $ano, VC01_NR_PATIO = $nrvaga, VC01_NR_KM = $nrkm WHERE VC01_CD_CAR = $id";
	 
	 if(mysqli_query($conexao, $sql)) { 
	   echo "<center><h1>Alterado com sucesso!</h1></center>";
	 } else
	   echo "<center><h1>Erro ao alterar!</h1></center>"; 
	?>

	<center><a href="index.php" class="btn btn-primary">Voltar</a></center>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>