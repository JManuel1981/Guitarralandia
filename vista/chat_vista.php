<?php
include 'menu_vista.php';

if (isset($_SESSION['user'])) {
    $username = 'USUARIO';
    $array_username = usuarioNavbar();
    $username = $array_username[0]['nombre'];

    include 'menu_vista.php';

    echo '<h1 class="title">¡A CHATEAR!</h1>';

    if (isset($array_mensajes)) {
        echo '<div id="chat-container">';
        echo '<ul class="chat-list">';

        require_once('modelo/usuarios_modelo.php');
        $usuarios_modelo = new Usuarios_modelo();

        if (count($array_mensajes) > 0) {
            foreach ($array_mensajes as $value) {
                $emisor_id = $value['id_emisor'];
                $nombre_emisor = $usuarios_modelo->obtenerNombreUsuario($emisor_id);

                if ($nombre_emisor) {
                    $nombre_emisor = $nombre_emisor[0]['nombre'];
                } else {
                    $nombre_emisor = 'Usuario Desconocido';
                }

                echo '<li class="chat-item emisor_' . $emisor_id . '">';
                echo '<div class="chat-bubble">';
                echo '<div class="avatar">';
                echo '<img src="../img/chatAvatar.png" alt="Avatar">';
                echo '</div>';
                echo '<div class="mensaje">';
                echo '<span class="nombre-usuario">' . $nombre_emisor . '</span>: ' . $value['mensaje'];
                echo '</div>';
                echo '</div>';
                echo '</li>';
                $id_chat = $value['id_chat'];
            }
        }

        echo '</ul>';
        echo '</div>';

        echo '<form id="form-mensaje" action="" method="POST">';
        echo '<input type="text" name="mensaje" id="mensaje" placeholder="Mensaje guitarreros🎸...">';
        echo '<input type="hidden" name="id_chat" value="' . $id_chat . '">';
        echo '<button type="submit">ENVIAR</button>';
        echo '</form>';
    }
}
?>
</main>
</div>