<?php

class Usuarios_modelo {
    private $db;
    private $datos;

    public function __construct() {
        require_once( 'conectar.php' );
        $this->db = Conectar::conexion();
        $this->datos = array();
    }

    public function get_usuarios() {
        $sql = 'SELECT * FROM usuarios';
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }


    public function login($user, $pass) {

        $sql = "SELECT id_usuario, pass FROM usuarios WHERE nombre='$user'";

        if ($consulta = $this->db->query($sql)) {

            $resultado = $consulta->fetch_assoc();
            
            if ($resultado && isset($resultado['pass']) && password_verify($pass, $resultado['pass'])) {
                return array('valido' => true, 'id_usuario' => $resultado['id_usuario']);
            } else {
                return array('valido' => false);
            }
        }
        return $this->datos;
    }
    
public function insertar_usuario($nombre, $email, $pass, $direccion, $telefono) {
        $fecha_creacion = date('Y-m-d H:i:s');
        
        
        $sql_verificar = "SELECT COUNT(*) as total FROM usuarios WHERE email = '$email'";
        $result_verificar = $this->db->query($sql_verificar);
        $row_verificar = $result_verificar->fetch_assoc();
        $total_usuarios = $row_verificar['total'];
        
        if ($total_usuarios > 0) {
        
            return false;
        } else {
            
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        
            $sql = "INSERT INTO usuarios (nombre, email, pass, direccion, telefono, fecha_creacion) VALUES ('$nombre', '$email', '$hashed_pass', '$direccion', '$telefono', '$fecha_creacion')";
            
            if ($this->db->query($sql)) {
                return $this->db->insert_id;
            } else {
                return false;
            }
        }
    }

    public function borrar_usuario( $user ) {
        $sql = "DELETE FROM usuarios where nombre='$user'";
        return $consulta = $this->db->query( $sql );
    }

    public function obtener_usuario($id) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
        $consulta = $this->db->query($sql);
        $datos = array(); // Array para almacenar los registros
        
        while ($registro = $consulta->fetch_assoc()) {
            $datos[] = $registro; // Agregar el registro al array
        }
        
        return $datos; // Devolver el array con todos los registros
    }

    public function obtenerNombreUsuario($id_emisor) {
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = $id_emisor";
        $consulta = $this->db->query($sql);
        $datos = array(); 
        
        while ($registro = $consulta->fetch_assoc()) {
            $datos[] = $registro; 
        }
        
        return $datos; 
    }
    

    public function es_admin( $id ) {
        $sql = "SELECT admin FROM usuarios where id_usuario = $id";
        if ( $consulta = $this->db->query( $sql ) ) {
            return ( $consulta->num_rows>0 );
        }
        return $this->datos;
    }

   public function modifica_usuario($nombre_original, $nombre, $correo, $telefono, $admin) {
        $sql = "UPDATE usuarios SET nombre='$nombre', email='$correo', telefono='$telefono', admin='$admin' WHERE nombre='$nombre_original'";
        return $this->db->query($sql);
    }
    


}
