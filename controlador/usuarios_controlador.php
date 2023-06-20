<?php
session_start();

require_once('modelo/usuarios_modelo.php');

function home()
{
}

$usuario = new Usuarios_modelo();
$es_admin = false;
if (isset($_SESSION['user'])) {
    $array_usuario = $usuario->get_usuarios();
} else {

    if (isset($_POST['enviar'])) {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

        $usuario = new Usuarios_modelo();
        $resultado = $usuario->login($nombre, $pass);

        if ($resultado['valido']) {
            $_SESSION['user'] = $resultado['id_usuario'];

            require_once('modelo/productos_modelo.php');
            $producto = new Productos_modelo();
            if (isset($_GET['id_instrumento'])) {  
                $id_usuario = intval($_SESSION['user']);
                $id_instrumento = $_GET['id_instrumento'];
            $es_mio = $producto-> es_mio($id_usuario, $id_instrumento);
            }
            
            if (isset($_GET['id_instrumento'])&& !$es_mio) {
                $id_instrumento = $_GET['id_instrumento'];
                //var_dump("El id_instrumento es: " . $id_instrumento);
                require_once('modelo/productos_modelo.php');
                $producto = new Productos_modelo();
                $favorito = new Favoritos_modelo();
                $id_usuario = intval($_SESSION['user']);
                
                if (isset($id_instrumento) && is_numeric($id_instrumento)) {
                    $array_producto = $producto->get_datos_prod($id_instrumento);
                    $array_favoritos = $favorito->favoritos_usuario($id_usuario);
                }
                require_once('vista/producto_vista.php');
            } else {
                header('location: index.php');
                echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Inicio de sesión exitoso!',
                    text: 'Redirigiendo...',
                    timer: 2000,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        icon: 'swal2-icon',
                        confirmButton: 'swal2-confirm'
                    },
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = 'index.php';
                    }
                });
            </script>";
            }
        } else {
        
            echo "
            <script>
            
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciales no válidas',
                    text: 'Por favor, verifica tus datos.',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        icon: 'swal2-icon',
                        confirmButton: 'swal2-confirm'
                    }
                });
            </script>";
        }
    }

    /* borrar usuario */
    if (isset($_POST['btn_borrarNombre'])) {

        if ($usuario->borrar_usuario($_POST['btn_BORRAR'])) {
            echo "<script>alert('Usuario eliminado')</script>";
        } else {
            echo "<script>alert('No se ha podido eliminar el usuario')</script>";
        }
    }

    /* insertar usuario */
    if (isset($_POST['btn_insertarUser'])) {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['pass']) ? $_POST['pass'] : '';
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    
    
        $usuario = new Usuarios_modelo();
    
        $id_usuario = $usuario->insertar_usuario($nombre, $email, $password, $direccion, $telefono);
    
        if ($id_usuario) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Usuario creado correctamente!',
                    text: 'Se ha creado el usuario: $nombre',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        icon: 'swal2-icon',
                        confirmButton: 'swal2-confirm'
                    }
                });
            </script>";
            require_once('controlador/usuarios_controlador.php');
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear el usuario',
                    text: 'No se ha podido crear el usuario Email existente en el sistema',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        icon: 'swal2-icon',
                        confirmButton: 'swal2-confirm'
                    }
                });
            </script>";
        }
    }


    $array_usuarios = $usuario->get_usuarios();
    require_once('vista/usuarios_vista.php');
}



//  AQUÍ EMPIEZAN LAS LLAMADAS DEL PANEL LATERAL

$mostrar_boton_venta = false;
$mostrar_compradas = false;
$mostrar_vendidas = false;

// Obtener los valores de los parámetros 'controlador' y 'action' de la URL
$controlador = isset($_GET['controlador']) ? $_GET['controlador'] : 'usuarios';
$action = isset($_GET['action']) ? $_GET['action'] : 'userDatos';
$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
$id_instrumento = isset($_GET['id_instrumento']) ? $_GET['id_instrumento'] : 'ERES TONTO';

// Crear un switch case para manejar las diferentes acciones que se pueden realizar
$datosUsuario = new Usuarios_modelo();
isset($_SESSION['user']) ? $int_user = intval($_SESSION['user']): $int_user = null; 

switch ($controlador) {
    case 'usuarios':
        switch ($action) {
            case 'userDatos':
                $array_datosUsuario = $datosUsuario->obtener_usuario($int_user);
                require_once('vista/usuarios_vista.php');
                break;

            case 'userEnVenta':
                require_once('modelo/productos_modelo.php');
                $productosVenta = new Productos_modelo();
                $array_productosVenta = $productosVenta->get_user_enVenta($int_user);

                
                if($array_productosVenta == null){
                    $mostrar_boton_venta = true;
                }

                require_once('vista/usuarios_vista.php');
                break;

            case 'userComprados':
                require_once('modelo/productos_modelo.php');
                $productosComprados = new Productos_modelo();

                $array_productosComprados = $productosComprados->get_user_Comprados($int_user);

                if($array_productosComprados == null){
                    $mostrar_compradas = true;
                }

                require_once('vista/usuarios_vista.php');
                break;

            case 'userVendidos':
                require_once('modelo/productos_modelo.php');
                $productosVendidos = new Productos_modelo();

                $array_productosVendidos = $productosVendidos->get_user_Vendidos($int_user);


                if($array_productosVendidos == null){
                    $mostrar_vendidas = true;
                }
                require_once('vista/usuarios_vista.php');
                break;

            case 'userFavoritos':
                require_once('modelo/productos_modelo.php');
                $favoritos = new Favoritos_modelo();
                $array_favoritos = $favoritos->favoritos_usuario($int_user);
                $productos = new Productos_modelo();
                
                $array_productosFavoritos = array(); 
                foreach ($array_favoritos as $value) {
                    $respuesta = $productos->get_datos_prod($value);
                    $array_productosFavoritos = $respuesta;
                }
                require_once('vista/usuarios_vista.php');
                
                break;

            case 'userChats':
                require_once('modelo/chat_modelo.php');
                $mostrar_chats = new Chat_modelo();
                $array_chats_abiertos = $mostrar_chats->mostrarChats($int_user);            

                require_once('vista/usuarios_vista.php');
                break;

                case 'userAjustes':
                    echo "<script>
                        Swal.fire({
                            title: 'Seccion de ajustes en proceso de pruebas',
                            icon: 'info'
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    </script>";
                    break;
                

            case 'otherUsers':            
                require_once('modelo/usuarios_modelo.php');
                $datosOtherUser = new Usuarios_modelo();
                $int_otherUser = intval($id_usuario);

                $array_datosOtherUser = $datosOtherUser->obtener_usuario($int_otherUser);
                require_once('vista/usuarios_vista.php');
                break;

            default:
                // Acción por defecto si no se encuentra ninguna acción correspondiente
                break;
        }
        break;
        // Otros controladores y acciones pueden ser manejados en casos adicionales
    default:
        // Controlador por defecto si no se encuentra ningún controlador correspondiente
        header('location: index.php');
        break;
}




require_once('vista/usuarios_vista.php');
