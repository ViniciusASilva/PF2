<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Pesquisar</title>
  </head>
  <body>
  
   <?php
   
     $pesquisa = $_POST['busca'] ?? '' ;
   
     include "conexao.php";
   
     $sql = "SELECT * FROM carros WHERE VC01_NM_MODELO LIKE '%$pesquisa%'";
	 
	 $dados = mysqli_query($conexao, $sql);
   ?> 
  
  
    <div class="container">
	  <div class="row">
	    <div class="col">
		  <h1>Pesquisar</h1>
		  <nav class="navbar navbar-light bg-light">
		    <form class="form-inline" action="pesquisaCarro.php" method="POST">
		      <input class="form-control mr-sm-2" type="search" placeholder="Modelo" aria-label="Search" name="busca" autofocus>
			  <button class="btn btn-outline-sucess my-2 my-sm-0" type="submit">Pesquisar</button>
		    </form>
		  </nav>
		
		  <table class="table table-hover">
		    <thead>
			  <tr>
			    <th scope="col">Modelo</th>
			    <th scope="col">Marca</th>
			    <th scope="col">KM</th>
				<th scope="col">ANO</th>
			    <th scope="col">Vaga</th>
				<th scope="col">Placa</th>
				<th scope="col">Funcoes</th>
			  </tr>
		    </thead>
		    <tbody>
			  
			   <?php
				 while ($linha = mysqli_fetch_assoc($dados)) { 
				   $cod_carro = $linha['VC01_CD_CAR'];
				   $modelo = $linha['VC01_NM_MODELO'];
				   $marca = $linha['VC01_NM_MARCA'];
				   $km = $linha['VC01_NR_KM'];
				   $ano = $linha['VC01_DT_ANO'];
				   $vaga = $linha['VC01_NR_PATIO'];
				   $placa = $linha['VC01_NM_CAR'];
				   
				   
				   echo " <tr>
							<th scope='row'>$modelo</th>
							<td>$marca</td>
							<td>$km</td>
							<td>$ano</td>
							<td>$vaga</td>
							<td>$placa</td>
							<td width=150px> 
							     <a href='editaCarro.php?id=$cod_carro' class='btn btn-sucess'>Editar</a>
							     <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#confirma'
								 onclick=" .'"' ."pegar_dados($cod_carro, '$modelo')" .'"' .">Excluir</a>
							</td>
						  </tr>";
				 }
				 
			   ?>  
			  
		    </tbody>
		  </table>
		
		  <a href="index.php" class="btn btn-info">Voltar para o inicio</a>
	    </div>
	  </div>
    </div>
	
	<!-- Modal -->
	<div class="modal fade" id="confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  <form action="excluindo.php" method="POST">
			<p>Deseja realmente excluir <b id="nome_carro"> Nome do carro</b> ?</p>
		  </div>
		  <div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
			  <input type="hidden" name="nome" id="nome_carro_1" value="">
			  <input type="hidden" name="id" id="cod_carro" value="">
			  <input type="submit" class="btn btn-danger" value="Excluir">
			</form>
		  </div>
		</div>
	  </div>
	</div>
	
	<script type="text/javascript">
	  function pegar_dados(id, nome) {
		  document.getElementById('nome_carro').innerHTML = nome;
		  document.getElementById('nome_carro_1').value = nome;
		  document.getElementById('cod_carro').value = id;
	  }
	</script>
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>