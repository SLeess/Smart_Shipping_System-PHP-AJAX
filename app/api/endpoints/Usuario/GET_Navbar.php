<?php
session_start();
if ($_SESSION['tipo'] == 1) {
$navbarHTML = '<nav class="navbar navbar-expand-md bg-body-tertiary">' .
    '<div class="container-fluid" style="margin: -8px 0;">' .
    '<a class="navbar-brand" href="home.html">3S</a>' .
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">' .
    '<span class="navbar-toggler-icon"></span>' .
    '</button>' .
    '<div class="collapse navbar-collapse mt-0" id="navbarNav">' .
    '<ul class="navbar-nav" style="width: 100%;">' .
    '<li class="nav-item dropdown">' .
    '<a class="nav-link dropdown-toggle" style="padding-bottom: 13px;" id="notas-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notas</a>' .
    '<div class="dropdown-menu" style="background-color: white; padding: 5px 0; margin-top: -7px;">' .
    '<a class="dropdown-item" id="notas-nmonit-tab" href="getNotas.html">Buscar</a>' .
    '<a class="dropdown-item" id="notas-tab" href="setNotas.html">Inserir</a>' .
    '</div>' .
    '</li>' .
    '<li class="nav-item dropdown">' .
    '<a class="nav-link dropdown-toggle" style="padding-bottom: 13px;" id="notas-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Motoristas</a>' .
    '<div class="dropdown-menu" style="background-color: white; padding: 5px 0; margin-top: -7px;">' .
    '<a class="dropdown-item" id="motoristas-tab" href="setMotorista.html" role="tab" aria-controls="Inserir" aria-selected="false">Cadastrar</a>' .
    '<a class="dropdown-item" id="motoristas-view-tab" href="getMotorista.html">Visualizar</a>' .
    '</div>' .
    '</li>' .
    '<li class="nav-item">' .
    '<a class="nav-link" id="mapa-tab" href="getProdutos.html" role="tab" aria-controls="Mapa de Carregamentos" aria-selected="false" style="height: 100%">Mapa de Carregamento</a>' .
    '</li>' .
    '<li class="nav-item">' .
    '<a class="nav-link" id="perfis-tab" href="getPerfis.html" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Perfis cadastros</a>' .
    '</li>' .
    '<li class="nav-item ms-auto">' .
    '<a class="nav-link" id="profile-tab" href="perfilConfiguracoes.html" role="tab" aria-controls="Clientes" aria-selected="false" style="height: 100%">' .
    '<img src="https://cdn-icons-png.flaticon.com/256/6596/6596121.png" alt="" width="28" height="28" class="rounded-circle me-2">' .
    '<strong style="color: red;">'. $_SESSION['usuario'] . '</strong>' .
    '</a>' .
    '</li>' .
    '</ul>' .
    '</div>' .
    '</div>' .
    '</nav>';
} else {
$navbarHTML = '<nav class="navbar navbar-expand-md bg-body-tertiary">' .
    '<div class="container-fluid" style="margin: -8px 0;">' .
    '<a class="navbar-brand" href="home.html">3S</a>' .
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">' .
    '<span class="navbar-toggler-icon"></span>' .
    '</button>' .
    '<div class="collapse navbar-collapse mt-0" id="navbarNav">' .
    '<ul class="navbar-nav" style="width: 100%;">' .
    '<li class="nav-item">' .
    '<a class="nav-link" id="notas-nmonit-tab" data-toggle="tab" href="getNotas.html" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Buscar Notas</a>' .
    '</li>' .
    '<li class="nav-item">' .
    '<a class="nav-link" id="motoristas-view-tab" data-toggle="tab" href="getMotorista.html" role="tab" aria-controls="home" aria-selected="false" style="height: 100%">Visualizar Motoristas</a>' .
    '</li>' .
    '<li class="nav-item">' .
    '<a class="nav-link" id="mapa-tab" data-toggle="tab" href="getProdutos.html" role="tab" aria-controls="Mapa de Carregamentos" aria-selected="false" style="height: 100%">Mapa de Carregamento</a>' .
    '</li>' .
    '<li class="nav-item ms-auto">' .
    '<a class="nav-link" id="profile-tab" data-toggle="tab" href="perfilConfiguracoes.html" role="tab" aria-controls="Clientes" aria-selected="false" style="height: 100%">' .
    '<img src="https://cdn-icons-png.flaticon.com/256/6596/6596121.png" alt="" width="28" height="28" class="rounded-circle me-2">' . $_SESSION['usuario'] .
    '</a>' .
    '</li>' .
    '</ul>' .
    '</div>' .
    '</div>' .
    '</nav>';
}

$style = ".nav-pills .nav-link.active{" .
    "background-color: #042ba314;" .
"}" .
"nav{" .
    "background-color: #333;" .
    "box-shadow: 0 1px 4px 0 rgba(0,0,0,.2);".
    "margin-bottom: 2em;" .
"}" .

"nav li{" .
    "display: inline-block;" .
"}" .

"nav li a{" .
    "color: #fff;" .
    "text-decoration: none;" .
    "padding: 15px;" .
    "display: inline-block;" .
    "transition: all 0.5s;" .
"}" .

"nav li a:hover{" .
    "background-color: #042ba314;" .
"}" .

".dropdown-menu{" .
    "position: absolute;" .
    "display: none;" .
"}" .

".dropdown-menu a{" .
    "display: block;" .
"}" .

".dropdown:hover .dropdown-menu{" .
    "display: block;" .
    "margin-top: 2px;" .
    "transition: all 0.7s ease-in-out;" .
"}".
".table-primary{".
    "background-color: red;".
"}";

    echo json_encode(["navbar" => $navbarHTML, "style" => $style]);
?>