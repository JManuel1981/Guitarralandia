<?php
session_start();
if (isset($_GET['id_chat'])) {

    $idChat = $_GET['id_chat'];
    $usuario = intval($_SESSION['user']);

    
    require_once('chat_modelo.php');
    $chat_modelo = new Chat_modelo();
    $array_mensajes = $chat_modelo->get_mensajes_chat($idChat);

    
    $htmlMensajes = '';
    foreach ($array_mensajes as $mensaje) {
    
    require_once('usuarios_modelo.php');
    $usuarios_modelo = new Usuarios_modelo();
    $nombreUsuarioArray = $usuarios_modelo->obtenerNombreUsuario($mensaje['id_emisor']);
    $nombreUsuario = $nombreUsuarioArray[0]['nombre'];

    $htmlMensajes .= '<li class="chat-item emisor_' . $mensaje['id_emisor'] . '">';
    $htmlMensajes .= '<div class="chat-bubble">';
    $htmlMensajes .= '<div class="avatar">';
    $htmlMensajes .= '<img src="../img/chatAvatar.png" alt="Avatar">';
    $htmlMensajes .= '</div>';
    $htmlMensajes .= '<div class="mensaje">';
    $htmlMensajes .= '<span class="nombre-usuario">' . $nombreUsuario . '</span>: ' . $mensaje['mensaje'];
    $htmlMensajes .= '</div>';
    $htmlMensajes .= '</div>';
    $htmlMensajes .= '</li>';
    }

    echo $htmlMensajes;
}
