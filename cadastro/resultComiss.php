<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Comissões</title>
  </head>
  
	<div class="container">
	  <div class="row">
	    <div class="col">
		  <h1>Comissões</h1>
		  <nav class="navbar navbar-light bg-light">
		    <form class="form-inline" action="pesquisaCarro.php" method="POST">
          <?php
             $setor = $_POST['setor'] ?? '' ;
             $funcionario = $_POST['funcionario'] ?? '' ;
             include "conexao.php";
             $sql = "SELECT VC04_NR_VENDA, VC04_DT_VENDA, VC10_CD_CAR, VC10_VL_PAGO, VC10_VL_COMISS,  COALESCE(CONCAT(VC01_NM_MODELO, ' ', VC01_NM_COR, ' ', VC01_DT_ANO, ' - ', VC01_NM_MARCA), 'Carro não cadastrado') AS VC01_DS_CAR, SUM(VC10_VL_COMISS) AS  COMISS_TOTAL  FROM VC04 INNER JOIN VC10 ON ( VC10_NR_VENDA = VC04_NR_VENDA) LEFT JOIN CARROS ON ( VC01_CD_CAR = VC10_CD_CAR ) WHERE VC04_CD_FUNC = $funcionario";
             
             $dados = mysqli_query($conexao, $sql);
             echo ""
          ?> 

		    </form>
		  </nav>
		  
		  <table class="table table-hover">
		    <thead>
			  <tr>
			    <th scope="col">Venda</th>
			    <th scope="col" placeholder="Ex.: dd/mm/aaaa" data-mask="00/00/0000" maxlength="10" autocomplete="off">Data</th>
          <th scope="col">Produto</th>
			    <th scope="col">Valor</th>
				  <th scope="col">Comissao venda</th>
          <th scope="col">Toal Comissao</th>
			  </tr>
		    </thead>
		    <tbody>
			  
			   <?php
           while ($linha = mysqli_fetch_assoc($dados)) {
             $nrVenda = $linha['VC04_NR_VENDA'];
             $dtVenda = $linha['VC04_DT_VENDA'];
             $car = $linha['VC01_DS_CAR'];
             $vlrPago = $linha['VC10_VL_PAGO'];
             $comiss = $linha['VC10_VL_COMISS'];
             $comiss_total = $linha['COMISS_TOTAL'];
             
             echo " <tr>
                <td>$nrVenda</td>
                <td>$dtVenda</td>
                <td>$car</td>
                <td>$vlrPago</td>
                <td>$comiss</td>
                <td>$comiss_total</td>
                </tr>";
           }
			   ?>  
			  
		    </tbody>
		  </table>
      
      
		
		  <a href="index.php" class="btn btn-info">Voltar para o inicio</a>
	    </div>
	  </div>
    </div>
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>