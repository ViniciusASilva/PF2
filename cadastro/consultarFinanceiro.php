<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Financeiro</title>
  </head>
  <body>
    <?php
      include "conexao.php";
    ?>
    
    
    <?php 
      $vendedor = $_POST['vendedor'] ?? null;
      $cliente = $_POST['cliente'] ?? null;
    ?>
    
	<div class="container">
	  <div class="row">
	    <div class="col">
		  <h1>Financeiro</h1>
		  <nav class="navbar navbar-light bg-light">
		    <form action="consultarFinanceiro.php" method="POST">
		      <select name="vendedor" id="vendedor">    
            <option value="" selected = selected>Selecione um vendedor</option>
            <?php
              $result_func = "SELECT * FROM VC03 WHERE VC03_CD_SETOR = 1 ORDER BY VC03_NM_FUNC DESC";
              $resultado_func = mysqli_query($conexao, $result_func);
              while ($row_func = mysqli_fetch_assoc($resultado_func)) {
                $func = $row_func['VC03_CD_FUNC'];
                $descri = $row_func['VC03_NM_FUNC'];
                
                if(!is_null ($vendedor) && !empty($vendedor)){
                  echo '<option value="'.$func.'" selected = selected>'.$descri.'</option>';
                }else {
                  echo '<option value="'.$func.'">'.$descri.'</option>';
                }
                
                
              }
            ?> 
          </select>
          <select name="cliente" id="cliente">    
            <option value="" selected = selected >Selecione um cliente</option>
            <?php
              $result_client = "SELECT * FROM VC02 ORDER BY VC02_NM_CLIENT DESC";
              $resultado_client = mysqli_query($conexao, $result_client);
              while ($row_client = mysqli_fetch_assoc($resultado_client)) {
                $cdClient = $row_client['VC02_CD_CLIENT'];
                $nmClient = $row_client['VC02_NM_CLIENT'];
                
                if(!is_null ($cliente) && !empty($cliente)){
                  echo '<option value="'.$cdClient.'" selected = selected>'.$nmClient.'</option>';
                }else {
                  echo '<option value="'.$cdClient.'">'.$nmClient.'</option>';
                }
              }
            ?>
          </select>
			  <button class="btn btn-primary" type="submit">Pesquisar</button>
		    </form>
		  </nav>
		
		  <table class="table table-hover">
      
        <?php
          if (!is_null ($vendedor) && !empty($vendedor)){
             $sql = "SELECT VC04_NR_VENDA, VC04_DT_VENDA, COALESCE(CONCAT(VC01_NM_MODELO, ' ', VC01_NM_COR, ' ', VC01_DT_ANO, ' - ', VC01_NM_MARCA), 'Carro não cadastrado') AS VC01_DS_CAR, VC10_VL_PAGO, COALESCE(VC02_NM_CLIENT, 'Cliente não cadastrado') AS VC02_NM_CLIENT FROM VC04 INNER JOIN VC10 ON (VC10_NR_VENDA = VC04_NR_VENDA) LEFT JOIN carros ON (VC01_CD_CAR = VC10_CD_CAR) LEFT JOIN VC02 ON (VC02_CD_CLIENT = VC04_CD_CLIENT) WHERE VC04_CD_FUNC = $vendedor";
          }elseif(!is_null ($cliente) && !empty($cliente)){
             $sql = "SELECT VC04_NR_VENDA, VC04_DT_VENDA, COALESCE(CONCAT(VC01_NM_MODELO, ' ', VC01_NM_COR, ' ', VC01_DT_ANO, ' - ', VC01_NM_MARCA), 'Carro não cadastrado') AS VC01_DS_CAR, VC10_VL_PAGO, COALESCE(VC02_NM_CLIENT, 'Cliente não cadastrado') AS VC02_NM_CLIENT FROM VC04 INNER JOIN VC10 ON (VC10_NR_VENDA = VC04_NR_VENDA) LEFT JOIN carros ON (VC01_CD_CAR = VC10_CD_CAR) LEFT JOIN VC02 ON (VC02_CD_CLIENT = VC04_CD_CLIENT) WHERE VC04_CD_CLIENT = $cliente";
          }elseif((!is_null ($vendedor) && !empty($vendedor)) && (!is_null ($cliente) && !empty($cliente))){
             $sql = "SELECT VC04_NR_VENDA, VC04_DT_VENDA, COALESCE(CONCAT(VC01_NM_MODELO, ' ', VC01_NM_COR, ' ', VC01_DT_ANO, ' - ', VC01_NM_MARCA), 'Carro não cadastrado') AS VC01_DS_CAR, VC10_VL_PAGO, COALESCE(VC02_NM_CLIENT, 'Cliente não cadastrado') AS VC02_NM_CLIENT FROM VC04 INNER JOIN VC10 ON (VC10_NR_VENDA = VC04_NR_VENDA) LEFT JOIN carros ON (VC01_CD_CAR = VC10_CD_CAR) LEFT JOIN VC02 ON (VC02_CD_CLIENT = VC04_CD_CLIENT) WHERE VC04_CD_FUNC = $vendedor AND VC04_CD_CLIENT = $cliente";
          }else {
             $sql = "SELECT VC04_NR_VENDA, VC04_DT_VENDA, COALESCE(CONCAT(VC01_NM_MODELO, ' ', VC01_NM_COR, ' ', VC01_DT_ANO, ' - ', VC01_NM_MARCA), 'Carro não cadastrado') AS VC01_DS_CAR, VC10_VL_PAGO, COALESCE(VC02_NM_CLIENT, 'Cliente não cadastrado') AS VC02_NM_CLIENT FROM VC04 INNER JOIN VC10 ON (VC10_NR_VENDA = VC04_NR_VENDA) LEFT JOIN carros ON (VC01_CD_CAR = VC10_CD_CAR) LEFT JOIN VC02 ON (VC02_CD_CLIENT = VC04_CD_CLIENT)";
          }
        
           $dados = mysqli_query($conexao, $sql);
        ?>
      
      
		    <thead>
			  <tr>
			    <th scope="col">Venda</th>
			    <th scope="col">Data</th>
          <th scope="col">Produto</th>
			    <th scope="col">Valor Pago</th>
				  <th scope="col">Cliente</th>
			  </tr>
		    </thead>
		    <tbody>
			  
			   <?php
				 while ($linha = mysqli_fetch_assoc($dados)) { 
				   $nrVenda = $linha['VC04_NR_VENDA'];
				   $dtVenda = $linha['VC04_DT_VENDA'];
				   $car = $linha['VC01_DS_CAR'];
				   $vlrPago = $linha['VC10_VL_PAGO'];
				   $cliente = $linha['VC02_NM_CLIENT'];
				   
				   
				   echo " <tr>
							<td>$nrVenda</td>
							<td>$dtVenda</td>
							<td>$car</td>
							<td>$vlrPago</td>
              <td>$cliente</td>
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