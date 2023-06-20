<?php
session_start();

if (isset($_GET['id_chat'])) {
    $id_chat = intval($_GET['id_chat']);
    mostrarMensajesChat($id_chat);
    } elseif (isset($_GET['id_instrumento'])) {
    abrirChat();
    }

    function mostrarMensajesChat_porId(){
    $id_chat = $_GET['id_chat'];
    mostrarMensajesChat($id_chat);
    }

    function mostrarMensajesChat($id_chat){
    require_once('modelo/chat_modelo.php');
    $chat_modelo = new Chat_modelo();

    $array_mensajes = $chat_modelo->get_mensajes_chat($id_chat);
    
    //AQUÍ METER UN SET INTERVAL

    require_once( 'vista/chat_vista.php' );
    }


    function abrirChat(){
        $id_instrumento = intval($_GET['id_instrumento']);
        $id_interesado = intval($_SESSION['user']);
        
        require_once('modelo/productos_modelo.php');
        $producto_venta = new Productos_modelo();
        $array_producto_venta = $producto_venta-> get_datos_prod($id_instrumento);
        $id_propietario = intval($array_producto_venta[0]['id_usuario']);

        require_once('modelo/chat_modelo.php');
        $chat_modelo = new Chat_modelo();

    $result = $chat_modelo->abrir_chat($id_instrumento, $id_propietario,  $id_interesado);

    $id_chat = $chat_modelo->get_id_chat($id_instrumento,  $id_interesado);

    mostrarMensajesChat($id_chat);
    
    require_once('vista/chat_vista.php');
    }


    
    if (isset($_POST['mensaje'])) {
        // Obtenemos los datos de la solicitud
        $id_chat = isset($_POST['id_chat']) ? intval($_POST['id_chat']) : '';
        $usuario = intval($_SESSION['user']);
        $mensaje = $_POST['mensaje'];

        // Llamamos a la función enviar_mensaje
        require_once('modelo/chat_modelo.php');
        $chat_modelo = new Chat_modelo();
        $chat_modelo->insertar_mensaje($id_chat, $usuario, $mensaje);
    }


require_once( 'vista/chat_vista.php' );
