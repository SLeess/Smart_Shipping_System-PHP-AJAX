<?php
session_start();
if (empty($_SESSION)){
    print("<script>location.href='../../index.html'</script>");
}
?>
<?php
$relative = isset($_POST['relative']) ? $_POST['relative'] : '';

echo "<ul class='nav nav-tabs nav-pills flex-col flex-sm-row flex-md-row' id='myTab' role='tablist' >".
  "<li class='nav-item'>".
    "<a class='nav-link' id='home-tab' data-toggle='tab' href='".$relative."home.php' role='tab' aria-controls='home' aria-selected='false' style='height: 100%'>Home</a>
  </li>";

if($_SESSION['tipo'] == 1)
  echo "<li class='nav-item dropdown'>
    <a class='nav-link dropdown-toggle' style='padding-bottom: 15px;' id='notas-dropdown' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Notas</a>
    <div class='dropdown-menu' style='background-color: white; padding: 5px 0;'>
      <a class='dropdown-item' id='notas-nmonit-tab' href='".$relative."3ESSI_NOTAS_MONITORAMENTO/notas.php'>Buscar Notas</a>
      <a class='dropdown-item' id='notas-tab' href='".$relative."3SSI_CRUD/notas.php'>Inserir Notas</a>
    </div>
  </li>";

echo
  "<li class='nav-item'>
    <a class='nav-link' id='motoristas-tab' data-toggle='tab' href='".$relative."3ESSI_MOTORIST_CAMINHOES/motoristas_caminhoes.php' role='tab' aria-controls='Motoristas e Caminhoes' aria-selected='false' style='height: 100%'>Motoristas & Caminhões</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' id='mapa-tab' data-toggle='tab' href='".$relative."3ESSI_MAPA_CARREGAMENTO/view_get_products.php' role='tab' aria-controls='Mapa de Carregamentos' aria-selected='false' style='height: 100%'>Mapa de Carregamento</a>
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
