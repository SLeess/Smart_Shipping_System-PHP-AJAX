<?php
  session_start();
  if (empty($_SESSION)){
      print("<script>location.href='../../index.html'</script>");
  }
?>
<?php
$relative = isset($_POST['relative']) ? $_POST['relative'] : '';

  echo '<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">3S</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav" style="width: 100%;">';
        
      '<li class=" nav-item">'.
      '<a class="nav-link" id="home-tab" data-toggle="tab" href="'.$relative.'home.php" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Home</a>
    </li>';
  
  if($_SESSION["tipo"] == 1){
    echo '<li class=" nav-item dropdown">
      <a class="nav-link dropdown-toggle" style="padding-bottom: 13px;" id="notas-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notas</a>
      <div class="dropdown-menu" style="background-color: white; padding: 5px 0;">
        <a class="dropdown-item" id="notas-nmonit-tab" href="'.$relative.'3ESSI_NOTAS_MONITORAMENTO/view_get_notas.php">Buscar</a>
        <a class="dropdown-item" id="notas-tab" href="'.$relative.'3SSI_CRUD/view_set_notas.php">Inserir</a>
      </div>
    </li>';
    echo '<li class=" nav-item dropdown">
      <a class="nav-link dropdown-toggle" style="padding-bottom: 13px;" id="notas-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Motoristas</a>
      <div class="dropdown-menu" style="background-color: white; padding: 5px 0;">
        <a class="dropdown-item" id="motoristas-tab" href="'.$relative.'3ESSI_MOTORIST_CAMINHOES/view_set_motorista.php" role="tab" aria-controls="Inserir" aria-selected="false">Cadastrar</a>
        <a class="dropdown-item" id="motoristas-view-tab" href="'.$relative.'">Visualizar</a>
      </div>
    </li>';
  } else{
    echo 
    '<li class=" nav-item">'.
      '<a class="nav-link" id="notas-nmonit-tab" data-toggle="tab" href="'.$relative.'3ESSI_NOTAS_MONITORAMENTO/view_get_notas.php" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Buscar Notas</a>
    </li>';
    echo 
    '<li class=" nav-item">'.
      '<a class="nav-link" id="motoristas-view-tab" data-toggle="tab" href="'.$relative.'" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Visualizar Motoristas</a>
    </li>';
  }
  
  echo
    '<li class=" nav-item">
      <a class="nav-link" id="mapa-tab" data-toggle="tab" href="'.$relative.'3ESSI_MAPA_CARREGAMENTO/view_get_products.php" role="tab" aria-controls="Mapa de Carregamentos" aria-selected="false" style="height: 100%">Mapa de Carregamento</a>
    </li>';
    
  if($_SESSION["tipo"] == 1){
    echo 
    '<li class=" nav-item">'.
      '<a class="nav-link" id="perfis-tab" data-toggle="tab" href="'.$relative.'view_get_perfis.php" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Perfis cadastros</a>
    </li>';
  }
    
  echo '<li class="nav-item ms-auto">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="'.$relative.'view_perfil_configs.php" role="tab" aria-controls="Clientes" aria-selected="false" style="height: 100%">
          <img src="https://cdn-icons-png.flaticon.com/256/6596/6596121.png" alt="" width="32" height="32" class="rounded-circle me-2">';
    if($_SESSION['tipo'] == 1){
      echo '<strong style="color: red;">'.$_SESSION["usuario"].'
          </strong>';
    }
    else{
      echo $_SESSION["usuario"];
    }
    echo
        '</a>
      </li>';

  echo '</ul>
    </div>
  </div>
</nav>';
?>
