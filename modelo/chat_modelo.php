<?php
require_once('conectar.php');

class Chat_modelo {
    private $db;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    //string(2) "55" string(10) "hola chato" string(2) "55" string(1) "3" int(1)

    public function abrir_chat($id_instrumento, $id_propietario, $id_interesado) {
        // Primero, verificamos si ya existe un chat abierto para estos usuarios y este instrumento
        $sql = "SELECT id_chat FROM chats WHERE id_instrumento = $id_instrumento AND id_propietario = $id_propietario AND id_interesado = $id_interesado";

        $consulta = $this->db->query($sql);
    
        // Si ya existe un chat abierto, lo devolvemos
        if ($consulta->num_rows > 0) {
            $chat = $consulta->fetch_assoc();
            return $chat['id_chat'];
        }
    
        // Si no existe un chat abierto, lo creamos
        $sql = "INSERT INTO chats (id_instrumento, id_propietario, id_interesado) VALUES ($id_instrumento, $id_propietario, $id_interesado)";
        $this->db->query($sql);
    
        // Obtenemos el ID del chat recién creado
        $id_chat = $this->db->insert_id;
    
        // Devolvemos el ID del chat
        return $id_chat;
    }


//ESTO VENDRÁ DESPUÉS

public function get_mensajes_chat($id_chat) {
    $sql = "SELECT * FROM mensajes WHERE id_chat = $id_chat";
    $consulta = $this->db->query($sql);
    $mensajes = array();
    while ($mensaje = $consulta->fetch_assoc()) {
        $mensajes[] = $mensaje;
    }
    return $mensajes;
}

public function insertar_mensaje($id_chat, $usuario, $mensaje) {
    $sql = "INSERT INTO mensajes (id_chat, id_emisor, mensaje) VALUES ('$id_chat', '$usuario', '$mensaje')";
    $this->db->query($sql);
}


//funcion para mostrar chats abiertos
function mostrarChats($id_usuario){
//   $sql = "SELECT * from chats where id_interesado = $id_usuario OR id_interesado = $id_usuario";
    $sql = "
    SELECT c.id_chat, CASE WHEN c.id_interesado = $id_usuario THEN propietario.nombre WHEN c.id_propietario = $id_usuario 
    THEN interesado.nombre END AS nombre_otro_usuario, i.nombre_instrumento FROM chats c 
    JOIN usuarios propietario ON c.id_propietario = propietario.id_usuario JOIN usuarios interesado 
    ON c.id_interesado = interesado.id_usuario JOIN instrumentos i 
    ON c.id_instrumento = i.id_instrumento WHERE c.id_interesado = $id_usuario OR c.id_propietario = $id_usuario;
    ";
    $consulta = $this->db->query($sql);
    $chats_abiertos = array();
    while ($chat = $consulta->fetch_assoc()) {
        $chats_abiertos[] = $chat;
    }
    return $chats_abiertos;
}

function get_id_chat($id_instrumento, $id_interesado) {
    $sql = "SELECT id_chat FROM chats WHERE id_interesado = $id_interesado AND id_instrumento = $id_instrumento";
    $consulta = $this->db->query($sql);
    $id_chat = $consulta->fetch_assoc()['id_chat'];
    return $id_chat;
    }
}