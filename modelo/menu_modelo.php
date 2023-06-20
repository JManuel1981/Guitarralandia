<?php

class Notificaciones_modelo {
    private $db;
    private $datosN;
    private $notificaciones;

    public function __construct() {
        require_once( 'modelo/conectar.php' );
        $this->db = Conectar::conexion();
        $this->datosN = array();
    }


    function obtenerNotificaciones($id_usuario) {
        $sql = "SELECT *
        FROM notificaciones
        WHERE id_usuario = '$id_usuario' AND leida = '0'
        ORDER BY fecha_creacion ASC;
        ";
        $consulta = $this->db->query($sql);
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->notificaciones[] = $registro;
        }
        return $this->notificaciones;
    }

    function obtenerNotificacion($id_notificacion){
        $sql = "SELECT *
        FROM notificaciones
        WHERE id_notificacion = '$id_notificacion' AND leida = '0'
        ORDER BY id_notificacion DESC";

        $consulta = $this->db->query($sql);
        $notificacion = $consulta->fetch_assoc();

        return $notificacion;
    }

    function marcarNotificacionLeida($id_notificacion) {
        $sql = "UPDATE notificaciones
                SET leida = '1'
                WHERE id_notificacion = '$id_notificacion'";
        
        $consulta = $this->db->query($sql);
        return $consulta;
    }


    function enviarNotificacion($id_usuario, $id_instrumento, $id_interesado, $tipo_notificacion) {
        $sql = "INSERT INTO notificaciones (id_usuario, id_instrumento, id_interesado, tipo_notificacion) VALUES ('$id_usuario', '$id_instrumento', '$id_interesado', '$tipo_notificacion')";
        $consulta = $this->db->query( $sql );
        return $consulta;
    }
    
}

?>