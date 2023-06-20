<?php
session_start();

if ( isset( $_SESSION[ 'user' ] ) ) {
    require_once( 'modelo/usuarios_modelo.php' );
    $usuario = new Usuarios_modelo();
    require_once( 'modelo/productos_modelo.php' );
    $producto = new Productos_modelo();

    function home() {
    
    }
        /* borrar usuario */
        if (isset($_POST['btn_borrarNombre'])) {
            if ($usuario->borrar_usuario($_POST['btn_BORRAR'])) {
                echo "<script>
                    Swal.fire({
                        text: 'Usuario eliminado',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        text: 'No se ha podido eliminar el usuario',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                </script>";
            }

        } elseif ( isset( $_POST[ 'btn_modificar_user' ] ) ) {
            
            $nombre_original = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $correo = isset( $_POST[ 'email' ] ) ? $_POST[ 'email' ] : '';
            $telefono = isset( $_POST[ 'telefono' ] ) ? $_POST[ 'telefono' ] : '';
            $admin = isset( $_POST[ 'admin' ] ) ? $_POST[ 'admin' ] : '';

            if ($usuario->modifica_usuario($nombre_original, $nombre, $correo, $telefono, $admin)) {
                $error = 'Modificado correctamente';
            } else {
                $error = 'Error al modificar';
            }
            
            echo "<script>
                Swal.fire({
                    text: '".$error."',
                    icon: 'success', // 'success', 'error', 'warning', 'info', 'question'
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        } elseif ( isset( $_POST[ 'btn_borrarProducto' ] ) ) {
            $borrado = $producto->borrar_producto_admin( $_POST[ 'btn_borrar_producto' ] );

            if ( $borrado ) {
                echo "<script>
                Swal.fire({
                    title: 'Producto borrado exitosamente',
                    icon: 'success'
                }).then(function() {
                    window.location.href = 'index.php?controlador=admin&action=adminInstrumentos';
                });
            </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error al borrar el producto',
                    icon: 'error'
                });
            </script>";
            }
        } elseif ( isset( $_POST[ 'btn_modificar_instrumento' ] ) ) {
            $id = isset( $_POST[ 'id_instrumento' ] ) ? $_POST[ 'id_instrumento' ] : '';
            $nombre = isset( $_POST[ 'nombre_instrumento' ] ) ? $_POST[ 'nombre_instrumento' ] : '';
            $estado = isset( $_POST[ 'estado_instrumento' ] ) ? $_POST[ 'estado_instrumento' ] : '';
            $precio_instrumento = isset( $_POST[ 'precio_instrumento' ] ) ? $_POST[ 'precio_instrumento' ] : '';
            $disponible = isset( $_POST[ 'disponible' ] ) ? $_POST[ 'disponible' ] : '';

            $modificado = $producto->modificar_producto_admin($id, $nombre, $precio_instrumento, $disponible, $estado);


            if ( $modificado ) {
            
                echo "<script>
                Swal.fire({
                    title: 'Producto modificado exitosamente',
                    icon: 'success'
                }).then(function() {
                    window.location.href = 'index.php?controlador=admin&action=adminInstrumentos';
                });
            </script>";
            } else {
                
                echo "<script>
                Swal.fire({
                    title: 'Error al modificar el producto',
                    icon: 'error'
                });
            </script>";
            }
        }
    
        require_once( 'vista/usuarios_vista.php' );
}


$action = isset( $_GET[ 'action' ] ) ? $_GET[ 'action' ] : 'adminUsuarios';

switch ( $action ) {
    case 'adminUsuarios':
    require_once( 'modelo/usuarios_modelo.php' );
    $usuarios_admin = new Usuarios_modelo();
    $array_usuarios_admin = $usuarios_admin->get_usuarios();
    require_once( 'vista/admin_vista.php' );
    break;

    case 'adminInstrumentos':
    require_once( 'modelo/productos_modelo.php' );
    $productos_admin = new Productos_modelo();
    $array_productos_admin = $productos_admin->get_datosP();
    require_once( 'vista/admin_vista.php' );
    break;

    default:
    break;
}

require_once( 'vista/admin_vista.php' );