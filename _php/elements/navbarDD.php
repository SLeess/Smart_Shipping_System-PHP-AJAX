<?php
    session_start();
    if(empty($_SESSION)){
        print("<script>location.href='../../index.html'</script>");
    }
?>
<?php
$relative = isset($_POST['relative']) ? $_POST['relative'] : '';

echo "<ul class='nav nav-tabs nav-pills flex-column flex-sm-row' id='myTab' role='tablist'>".
  "<li class='nav-item'>".
    "<a class='nav-link' id='home-tab' data-toggle='tab' href='".$relative."home.php' role='tab' aria-controls='home' aria-selected='false' style='height: 100%'>Home</a>".
  "</li>
  <li class='nav-item'>
    <a class='nav-link' id='notas-nmonit-tab' data-toggle='tab' href='".$relative."3ESSI_NOTAS_MONITORAMENTO/notas.php' role='tab' aria-controls='Clientes' aria-selected='false' style='height: 100%'>Buscar Notas</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' id='notas-tab' data-toggle='tab' href='".$relative."3SSI_CRUD/notas.php' role='tab' aria-controls='notas fiscais' aria-selected='false' style='height: 100%'>Inserir Notas</a>
  </li>"."
  <li class='nav-item'>
    <a class='nav-link' id='motoristas-tab' data-toggle='tab' href='".$relative."3ESSI_MOTORIST_CAMINHOES/motoristas_caminhoes.php' role='tab' aria-controls='Motoristas e Caminhoes' aria-selected='false' style='height: 100%'>Motoristas & Caminhões</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' id='mapa-tab' data-toggle='tab' href='".$relative."3ESSI_MAPA_CARREGAMENTO/get_products.php' role='tab' aria-controls='Mapa de Carregamentos' aria-selected='false' style='height: 100%'>Mapa de Carregamento</a>
  </li>
  <li class='flex-sm-fill nav-item'>
  </li>".
  "<li class='nav-item'>
    <a class='nav-link' id='profile-tab' data-toggle='tab' href='".$relative."perfil_configs.php' role='tab' aria-controls='Clientes' aria-selected='false' style='height: 100%'>
        <img src='https://cdn-icons-png.flaticon.com/256/6596/6596121.png' alt='' width='32' height='32' class='rounded-circle me-2'>
        <strong>".$_SESSION['usuario']."
        </strong>
    </a>
  </li>
</ul>";
?>
<!-- <li class='nav-item'>
  <a class='nav-link' id='produtos-tab' data-toggle='tab' href='#' role='tab' aria-controls='Produtos' aria-selected='false' style='height: 100%'>Produtos</a>
</li>
<li class='nav-item'>
  <a class='nav-link' id='clientes-tab' data-toggle='tab' href='#' role='tab' aria-controls='Clientes' aria-selected='false' style='height: 100%'>Visualizar Clientes</a>
</li> -->