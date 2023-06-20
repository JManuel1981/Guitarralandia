<?php

class Productos_modelo {
    private $db;
    private $datosP;
    private $datos_cat;
    private $datos_prod;
    private $datos_userVenta;
    private $datos_userComprados;
    private $datos_userVendidos;
    

    public function __construct() {
        require_once( 'modelo/conectar.php' );
        $this->db = Conectar::conexion();
        $this->datosP = array();
    }

    public function get_datosP() {
        $sql = 'SELECT * FROM instrumentos';
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datosP[] = $registro;
        }
        return $this->datosP;
    }

    public function get_datos_cat($id) {
        $sql = "SELECT * FROM `instrumentos` WHERE id_categoria = '$id' AND disponible = 1 ORDER BY fecha_publicacion_instrumento DESC";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_cat[] = $registro;
        }
        return $this->datos_cat;
    }
    
    public function get_datos_prod($id_prod) {
        $sql = "SELECT i.*, u.nombre
        FROM instrumentos AS i
        JOIN usuarios AS u ON i.id_usuario = u.id_usuario
        WHERE i.id_instrumento = '$id_prod'
        ";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_prod[] = $registro;
        }
        return $this->datos_prod;
    }

    public function get_datos_prod_like($id_instrumento, $id_usuario) {;
        $sql = "SELECT i.*, 
        IF(f.id_favoritos IS NULL, 0, 1) AS es_favorito 
        FROM instrumentos i 
        LEFT JOIN favoritos f ON i.id_instrumento = f.id_instrumento 
        AND f.id_usuario = [ID_USUARIO] 
        WHERE i.id_instrumento = [ID_INSTRUMENTO]
 
        ";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_prod[] = $registro;
        }
        return $this->datos_prod;
    }

    public function modificar_producto($id, $nombre, $precio, $descripcion, $estado) {
        $id = $this->db->real_escape_string($id);
        $nombre = $this->db->real_escape_string($nombre);
        $precio = $this->db->real_escape_string($precio);
        $descripcion = $this->db->real_escape_string($descripcion);
        $estado = $this->db->real_escape_string($estado);

        $sql = "UPDATE instrumentos SET nombre_instrumento = '$nombre', precio_instrumento = '$precio', descripcion_instrumento = '$descripcion', estado_instrumento = '$estado' WHERE id_instrumento = $id";
        $resultado = $this->db->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    public function borrar_producto($id) {
        $id = $this->db->real_escape_string($id);

        $sql = "DELETE FROM instrumentos WHERE id_instrumento = $id";
        $resultado = $this->db->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    public function modificar_producto_admin($id, $nombre, $precio, $disponible, $estado) {
        $id = $this->db->real_escape_string($id);
        $nombre = $this->db->real_escape_string($nombre);
        $precio = $this->db->real_escape_string($precio);
        $disponible = $this->db->real_escape_string($disponible);
        $estado = $this->db->real_escape_string($estado);

        $sql = "UPDATE instrumentos SET nombre_instrumento = '$nombre', estado_instrumento = '$estado', precio_instrumento = '$precio', disponible = '$disponible' WHERE id_instrumento = $id";
        $resultado = $this->db->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    public function borrar_producto_admin($nombre) {
        $nombre = $this->db->real_escape_string($nombre);

        $sql = "DELETE FROM instrumentos WHERE nombre_instrumento = '$nombre'";
        $resultado = $this->db->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }


    //LLAMADAS PARA LA VISTA USER
    public function get_user_enVenta($int_user) {
        $sql = "SELECT * FROM `instrumentos` WHERE id_usuario = $int_user AND disponible = 1 ORDER BY fecha_publicacion_instrumento DESC";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_userVenta[] = $registro;
        }
        return $this->datos_userVenta;
    }
    
    
    public function get_user_Comprados($int_user) {
        $sql = "SELECT u_vendedor.nombre AS nombre_vendedor, i.nombre_instrumento, i.imagenes_instrumento, t.precio_transaccion, i.fecha_publicacion_instrumento, t.fecha_transaccion
        FROM transacciones t
        INNER JOIN usuarios u_vendedor ON t.id_vendedor = u_vendedor.id_usuario
        INNER JOIN instrumentos i ON t.id_instrumento = i.id_instrumento
        WHERE t.id_comprador = $int_user ORDER BY fecha_transaccion DESC";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_userComprados[] = $registro;
        }
        return $this->datos_userComprados;
    }

    public function get_user_Vendidos($int_user) {
        $sql = "SELECT u_comprador.nombre AS nombre_comprador, i.nombre_instrumento, i.imagenes_instrumento, t.precio_transaccion, i.fecha_publicacion_instrumento, t.fecha_transaccion
        FROM transacciones t
        INNER JOIN usuarios u_comprador ON t.id_comprador = u_comprador.id_usuario
        INNER JOIN instrumentos i ON t.id_instrumento = i.id_instrumento
        WHERE t.id_vendedor = $int_user ORDER BY fecha_transaccion DESC";
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datos_userVendidos[] = $registro;
        }
        return $this->datos_userVendidos;
    }

    public function es_mio($id_usuario, $id_instrumento) {
        $sql = "SELECT * FROM `instrumentos` WHERE id_instrumento = ? AND id_usuario = ?";
        $consulta = $this->db->prepare($sql);
        $consulta->bind_param("ii", $id_instrumento, $id_usuario);
        if ($consulta->execute()) {
            $consulta->store_result();
            return ($consulta->num_rows > 0);
        }
        return false;
    }

    //COMPROBAR QUE ESTA SE ESTÁ UTILIZANDO
    public function borrar_imagen( $fichero ) {
        $sql = "DELETE FROM instrumentos where fichero='$fichero'";
        $consulta = $this->db->query( $sql );
        return $consulta;
    }

    public function insertarProducto($id_usuario, $id_categoria, $nombre_instrumento, $marca_instrumento, $modelo_instrumento, $descripcion_instrumento, $estado_instrumento, $precio_instrumento, $imagenes_instrumento) {

        $sql = "INSERT INTO instrumentos (id_usuario, id_categoria, nombre_instrumento, marca_instrumento, modelo_instrumento, descripcion_instrumento, estado_instrumento, precio_instrumento, imagenes_instrumento)
        VALUES ('$id_usuario', '$id_categoria', '$nombre_instrumento', '$marca_instrumento', '$modelo_instrumento', '$descripcion_instrumento', '$estado_instrumento', '$precio_instrumento', '$imagenes_instrumento');
        ";
        $consulta = $this->db->query( $sql );
        return $consulta;
    }


    function insertarNuevaTransaccion($id_instrumento, $precio_transaccion, $id_vendedor, $id_comprador) {
        $id_instrumento=intval($id_instrumento);
            $precio_transaccion=intval($precio_transaccion);
            $id_vendedor=intval($id_vendedor);
            $id_comprador=intval($id_comprador);
        
        $sql = "INSERT INTO transacciones (id_instrumento, precio_transaccion, id_vendedor, id_comprador)
        VALUES ($id_instrumento, $precio_transaccion, $id_vendedor, $id_comprador)";
        $consulta = $this->db->query( $sql );
        return $consulta;
    }
    
    function actualizarInstrumento($id_instrumento) {
        $sql = "UPDATE instrumentos SET disponible = '1' WHERE id_instrumento = ?";
        
        $consulta = $this->db->prepare($sql);
        $consulta->bind_param("s", $id_instrumento);
        $consulta->execute();
    
        if ($consulta->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    

    
}


class Favoritos_modelo {
    private $conexion;
    private $datosF;

    public function __construct() {
        require_once( 'modelo/conectar.php' );
        $this->conexion = Conectar::conexion();
        $this->datosF = array();
    }

    public function agregar_favorito($id_usuario, $id_instrumento) {
        $query = "INSERT INTO favoritos (id_usuario, id_instrumento) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ii', $id_usuario, $id_instrumento);
        return $stmt->execute();
    }

    public function eliminar_favorito($id_usuario, $id_instrumento) {
        $query = "DELETE FROM favoritos WHERE id_usuario = ? AND id_instrumento = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ii', $id_usuario, $id_instrumento);
        return $stmt->execute();
    }

    public function existe_favorito($id_usuario, $id_instrumento) {
        $query = "SELECT * FROM favoritos WHERE id_usuario = ? AND id_instrumento = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ii', $id_usuario, $id_instrumento);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function favoritos_usuario($id_usuario) {
        $query = "SELECT id_instrumento FROM favoritos WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id_usuario); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $instrumentos = array();
        
        while ($row = $result->fetch_assoc()) {
            $instrumentos[] = $row['id_instrumento'];
        }
        
        return $instrumentos;
    }

}



class Categoria_modelo {
    private $db;
    private $datosC;

    public function __construct() {
        require_once( 'modelo/conectar.php' );
        $this->db = Conectar::conexion();
        $this->datosC = array();
    }

    public function get_datosC() {
        $sql = 'SELECT * FROM categorias where id_categoria_padre > 0';
        $consulta = $this->db->query( $sql );
        while ( $registro = $consulta->fetch_assoc() ) {
            $this->datosC[] = $registro;
        }
        return $this->datosC;
    }

}

?>