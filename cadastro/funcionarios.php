<?php include_once("conexao.php");
  $setor = $_REQUEST['setor'];
  
  $result_func = "SELECT * FROM VC03 WHERE VC03_CD_SETOR = $setor ORDER BY VC03_NM_FUNC";
  $resultado_func = mysqli_query($conexao, $result_func);
  while ($row_func = mysqli_fetch_assoc($resultado_func)) {
    $funcionarios[] = array(
      'VC03_CD_FUNC' => $row_func['VC03_CD_FUNC'],
      'VC03_NM_FUNC' => utf8_encode($row_func['VC03_NM_FUNC']),
    );
  }
  
  echo (json_encode($funcionarios));
  
?>