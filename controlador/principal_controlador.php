<?php
session_start();

require_once('modelo/productos_modelo.php');

function home() {
    $datoC = new Categoria_modelo();
    $array_datosC = $datoC->get_datosC();
    $mostrar_principal = true;

    require_once('vista/principal_vista.php');
}

function desconectar() {
    session_destroy();
    header('location: index.php');
}

function mostrarGalerias($id_cat) {
    $datoC = new Categoria_modelo();
    $array_datosC = $datoC->get_datosC();

    $datoP = new Productos_modelo();
    $favorito = new Favoritos_modelo();
    if(isset($_SESSION['user'])){
        $id_usuario = intval($_SESSION['user']);
        $array_favoritos = $favorito->favoritos_usuario($id_usuario);
    }
    
    if (isset($id_cat) && is_numeric($id_cat)) {
        $array_datos_cat = $datoP->get_datos_cat($id_cat);
    }

    require_once('vista/principal_vista.php');
}

if (isset($_POST['id_categoria'])) {
    $numero_int = intval($_POST['id_categoria']);
    if (isset($numero_int) && is_numeric($numero_int)) {
        $mostrar_principal = false;
        mostrarGalerias($numero_int);
    }
}


