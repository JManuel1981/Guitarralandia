<?php
session_start();

    if (isset($_POST['mensaje']) && isset($_POST['id_chat'])) {
    
    $mensaje = $_POST['mensaje'];
    $idChat = $_POST['id_chat'];
    $usuario = intval($_SESSION['user']);

    
    require_once('chat_modelo.php');
    $chat_modelo = new Chat_modelo();
    $chat_modelo->insertar_mensaje($idChat, $usuario, $mensaje);

    
    require_once('usuarios_modelo.php');
    $usuarios_modelo = new Usuarios_modelo();
    $nombreUsuarioArray = $usuarios_modelo->obtenerNombreUsuario($usuario);

    
    if (!empty($nombreUsuarioArray)) {
        $nombreUsuario = $nombreUsuarioArray[0]['nombre'];

        
        $nuevoMensaje = '<li class="chat-item emisor_' . $usuario . '">';
        $nuevoMensaje .= '<div class="chat-bubble">';
        $nuevoMensaje .= '<div class="avatar">';
        $nuevoMensaje .= '<img src="../img/chatAvatar.png" alt="Avatar">';
        $nuevoMensaje .= '</div>';
        $nuevoMensaje .= '<div class="mensaje">';
        $nuevoMensaje .= '<span class="nombre-usuario">' . $nombreUsuario . '</span>: ' . $mensaje;
        $nuevoMensaje .= '</div>';
        $nuevoMensaje .= '</div>';
        $nuevoMensaje .= '</li>';

        echo $nuevoMensaje;
    } else {
        
        echo 'Error: no se pudo obtener el nombre de usuario.';
    }
}
