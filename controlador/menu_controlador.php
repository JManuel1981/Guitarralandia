<?php

function usuarioNavbar() {
    require_once('modelo/usuarios_modelo.php');
    $datosUsuario = new Usuarios_modelo();
    $int_user = intval($_SESSION['user']);
    return $array_userName = $datosUsuario->obtener_usuario($int_user);
}


if(isset($_SESSION['user'])){
require_once('modelo/menu_modelo.php');
$notificacionesModelo = new Notificaciones_modelo();
$id_usuario = intval($_SESSION['user']);
$notificaciones = $notificacionesModelo->obtenerNotificaciones($id_usuario);


// PINTAR NOTIFICACIONES   
$notificacion = 'No hay notificaciones que mostrar';
if (is_array($notificaciones) && (count($notificaciones) > 0)) {
    $id_notificacion = $notificaciones[0]['id_notificacion'];
    $_SESSION['id_notificacion'] = $id_notificacion; // Crea la variable de sesión

    $array_notificacion = $notificacionesModelo->obtenerNotificacion($id_notificacion);

    $id_instrumento = $array_notificacion['id_instrumento'];
    $id_interesado = $array_notificacion['id_interesado'];
    $id_usuario = intval($_SESSION['user']);

    require_once('modelo/productos_modelo.php');
    $producto = new Productos_modelo();
    $array_producto_not = $producto->get_datos_prod($id_instrumento);

    require_once('modelo/usuarios_modelo.php');
    $datosOtherUser = new Usuarios_modelo();
    $array_datosUser_not = $datosOtherUser->obtener_usuario($id_usuario);
    $array_datosOtherUser_not = $datosOtherUser->obtener_usuario($id_interesado);
    
    // Acceder al primer elemento del arreglo $array_datosOtherUser_not
    $datosOtherUser_not = isset($array_datosOtherUser_not[0]) ? $array_datosOtherUser_not[0] : null;

    $tipo_notificacion = intval($array_notificacion['tipo_notificacion']);
    
    switch ($tipo_notificacion) {
        case '1':
            $notificacion ="¡Buenas noticias! El usuario " . $datosOtherUser_not['nombre'] . " quiere comprar tu " . $array_producto_not[0]['nombre_instrumento'] . " ";
            echo "<input type='hidden' id='notificacionId' value='$id_notificacion'>"; 
            break;
        case '2':
            $notificacion = "¡Enhorabuena! El usuario " . $datosOtherUser_not['nombre'] . " ha aceptado tu oferta por su " . $array_producto_not[0]['nombre_instrumento'] . ". 
            ¡Aquí tienes su email: ".$datosOtherUser_not['email']." y su teléfono: ".$datosOtherUser_not['telefono']." para que puedas contactarle!";
            echo "<input type='hidden' id='notificacionId' value='$id_notificacion'>"; 
            break;
        case '3':
            $notificacion = "¡Lo sentimos! El usuario " . $datosOtherUser_not['nombre'] . " ha rechazado tu oferta por su " . $array_producto_not[0]['nombre_instrumento'] . " ";
            echo "<input type='hidden' id='notificacionId' value='$id_notificacion'>";
            break;
        
        default:
        
            break;
    }
}

echo "<input type='hidden' id='notificacionText' value='" . htmlspecialchars($notificacion) . "'>";

}
