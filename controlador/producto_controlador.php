<?php
session_start();

require_once('modelo/productos_modelo.php');

function home(){}

$mostrar_formulario = false;

if (isset($_GET['vista']) && $_GET['vista'] === 'formulario') {
    $mostrar_formulario = true;
    require_once('vista/producto_vista.php');
} else {
    $producto = new Productos_modelo();

    if (isset($_POST['id_instrumento'])) {

        $id_instrumento = $_POST['id_instrumento'];
    
        if (is_numeric($id_instrumento) && intval($id_instrumento) == $id_instrumento) {

            require_once('modelo/productos_modelo.php');
            $producto = new Productos_modelo();
            $favorito = new Favoritos_modelo();


            $id_usuario = intval($_SESSION['user']);
            if (isset($id_instrumento) && is_numeric($id_instrumento)) {
                $array_producto = $producto->get_datos_prod($id_instrumento);
                $array_favoritos = $favorito->favoritos_usuario($id_usuario);
                
            }


            if (isset($_POST['btn_modificar'])) {
                // Obtener los valores del formulario
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
                $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
                $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
        
                $modificado = $producto->modificar_producto($id_instrumento, $nombre, $precio, $descripcion, $estado);
        
                if ($modificado) {
                    // Producto modificado exitosamente
                    echo "<script>
                        Swal.fire({
                            title: 'Producto modificado exitosamente',
                            icon: 'success'
                        }).then(function() {
                            window.location.href = 'index.php?controlador=usuarios&action=userEnVenta';
                        });
                    </script>";
                } else {
                    // Error al modificar el producto
                    echo "<script>
                        Swal.fire({
                            title: 'Error al modificar el producto',
                            icon: 'error'
                        });
                    </script>";
                }
            } elseif (isset($_POST['btn_eliminar'])) {
                $borrado = $producto->borrar_producto($id_instrumento);
        
                if ($borrado) {
                    // Producto borrado exitosamente
                    echo "<script>
                        Swal.fire({
                            title: 'Producto borrado exitosamente',
                            icon: 'success'
                        }).then(function() {
                            window.location.href = 'index.php?controlador=usuarios&action=userEnVenta';
                        });
                    </script>";
                } else {
                    // Error al borrar el producto
                    echo "<script>
                        Swal.fire({
                            title: 'Error al borrar el producto',
                            icon: 'error'
                        });
                    </script>";
                }
            }
    
        
        } else {
            // La variable $id_instrumento no es un número entero
            echo "<script>alert('NO ES NUMERO ENTERO')</script>";
        }
    }
    
    //SOLICITAR

    function enviarNotificacion($id_instrumento, $id_usuario, $tipo_notificacion)
    {
        require_once('modelo/menu_modelo.php');
        $notificacion = new Notificaciones_modelo();
        $id_remitente = intval($_SESSION['user']);
    
        if ($notificacion->enviarNotificacion($id_usuario, $id_instrumento, $id_remitente, $tipo_notificacion)) {
            if ($tipo_notificacion === 2) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '¡Notificación enviada!',
                            text: 'Se ha enviado una petición de compra al usuario. ¡Ahora toca esperar a que conteste!',
                        }).then(function() {
                            window.location.href = 'index.php?controlador=principal';
                        });
                    </script>";

                    // Redirigir solo después de mostrar el mensaje
            header('Location: index.php?controlador=principal');
            exit();
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '!Transación cancelada!',
                            text: 'Gracias por confiar en GUITARRALANDIA. Informaremos al usuario',
                        }).then(function() {
                            window.location.href = 'index.php?controlador=principal';
                        });
                    </script>";
            }
    
            // Redirigir solo después de mostrar el mensaje
            header('Location: index.php?controlador=principal');
            exit();
    
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo no ha salido como debía...',
                    });
                    window.location.href = 'index.php?controlador=principal';
                </script>";
        }
    }
    

    if ( isset( $_POST[ 'notificacion_id_instrumento' ] ) ) {
        $id_instrumento = $_POST[ 'notificacion_id_instrumento' ];
        $id_usuario = $_POST[ 'notificacion_id_usuario' ];
        $tipo_notificacion = 1;
        enviarNotificacion( $id_instrumento, $id_usuario, $tipo_notificacion );
    }
    
}

//valorar si meter dentro del else
if (isset($_POST['btn_insertarProducto'])) {
    $dato = new Productos_modelo();

    // Asignar valores a las variables $_POST con operadores ternarios
    $id_usuario = intval($_SESSION['user']);
    $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : '';
    $nombre_instrumento = isset($_POST['nombre_instrumento']) ? $_POST['nombre_instrumento'] : '';
    $marca_instrumento = isset($_POST['marca_instrumento']) ? $_POST['marca_instrumento'] : '';
    $modelo_instrumento = isset($_POST['modelo_instrumento']) ? $_POST['modelo_instrumento'] : '';
    $precio_instrumento = isset($_POST['precio_instrumento']) ? $_POST['precio_instrumento'] : '';
    $descripcion_instrumento = isset($_POST['descripcion_instrumento']) ? $_POST['descripcion_instrumento'] : '';
    $estado_instrumento = isset($_POST['estado_instrumento']) ? $_POST['estado_instrumento'] : '';

    // CODIGO DE LA SUBIDA DE IMAGENES
    // Verificar si se han subido imágenes
    if (isset($_FILES['imagenes_instrumento'])) {
        $errores = [];

        // Directorio de destino
        $directorio_destino = dirname(dirname(__DIR__)) . '/GUITARRALANDIA_DIAMANTE/img/';
        //$directorio_destino = dirname(dirname(__DIR__)) . '/public/img/' ;

        // Tamaños máximo de archivo en bytes ( 1MB )
        $tamaño_maximo = 1048576;

        // Tipos de archivo permitidos
        $tipos_permitidos = ['jpg', 'jpeg', 'png'];

        // Crear el nombre base de archivo para cada imagen
        $nombre_base = $_SESSION['user'] . '_' . time() . '_';

        // Inicializar array para almacenar nombres de archivo subidos
        $nombres_archivos_subidos = [];
        $i = 1;
        foreach ($_FILES['imagenes_instrumento']['tmp_name'] as $key => $tmp_name) {
            // Obtener información del archivo subido
            $nombre_original = basename($_FILES['imagenes_instrumento']['name'][$key]);
            $tamaño_archivo = $_FILES['imagenes_instrumento']['size'][$key];
            $tipo_archivo = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

            // Verificar si el archivo es del tipo permitido
            if (!in_array($tipo_archivo, $tipos_permitidos)) {
                $errores[] = "El archivo $nombre_original no es un tipo de archivo permitido.";
            }

            // Verificar si el archivo excede el tamaño máximo permitido
            if ($tamaño_archivo > $tamaño_maximo) {
                $errores[] = "El archivo $nombre_original excede el tamaño máximo permitido.";
            }

            // Verificar si hubo errores en la validación del archivo
            if (count($errores) == 0) {
                // Generar nombre de archivo único con el nombre base y la extensión del archivo original
                // $nombre_archivo = $nombre_base . $nombre_original;
                $ext = pathinfo($nombre_original, PATHINFO_EXTENSION);
                $ext = '.' . $ext;
                $nombre_archivo = $nombre_base . $i . $ext;

                // Agregar el nombre de archivo generado al array de nombres de archivo subidos
                $nombres_archivos_subidos[] = $nombre_archivo;

                // Mover el archivo subido al directorio de destino
                move_uploaded_file($tmp_name, $directorio_destino . $nombre_archivo);

                // Redimensionar la imagen
                $ruta_imagen = $directorio_destino . $nombre_archivo;
                $ancho_maximo = 225;
                $alto_maximo = 300;
                $ruta_guardado = $directorio_destino . $nombre_archivo;
                redimensionar_imagen($ruta_imagen, $ancho_maximo, $alto_maximo, $ruta_guardado);
            }
            $i++;
        }

        // Verificar si se produjeron errores en la validación de archivos
        if (count($errores) > 0) {
            // Mostrar los errores al usuario
            foreach ($errores as $error) {
                echo "<p>Error: $error</p>";
            }
        } else {
            echo "<script>console.log('Los archivos se subieron correctamente.</script>";
        }
    }

    $imagenes_instrumento = json_encode($nombres_archivos_subidos);
    if ($dato->insertarProducto($id_usuario, $id_categoria, $nombre_instrumento, $marca_instrumento, $modelo_instrumento, $descripcion_instrumento, $estado_instrumento, $precio_instrumento, $imagenes_instrumento)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Producto subido correctamente!',
                    text: 'El producto ha sido registrado exitosamente.',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'index.php?controlador=usuarios&action=userEnVenta';
                });
            </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: '¡Error al subir la imagen!',
                    text: 'No se ha podido subir la imagen del producto.',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'index.php?controlador=usuarios&action=userEnVenta';
                });
            </script>";
    }
    
}

function redimensionar_imagen($ruta_imagen, $ancho_maximo, $alto_maximo, $ruta_guardado)
{
    // Obtener información de la imagen original
    $info_imagen = getimagesize($ruta_imagen);
    $ancho_original = $info_imagen[0];
    $alto_original = $info_imagen[1];
    $tipo_imagen = $info_imagen[2];

    // Calcular las nuevas dimensiones de la imagen
    $ratio_original = $ancho_original / $alto_original;
    $ratio_maximo = $ancho_maximo / $alto_maximo;

    if ($ratio_maximo > $ratio_original) {
        $ancho_nuevo = $alto_maximo * $ratio_original;
        $alto_nuevo = $alto_maximo;
    } else {
        $ancho_nuevo = $ancho_maximo;
        $alto_nuevo = $ancho_maximo / $ratio_original;
    }

    // Crear una imagen en blanco con las nuevas dimensiones
    $imagen_nueva = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);

    // Cargar la imagen original
    switch ($tipo_imagen) {
        case IMAGETYPE_JPEG:
            $imagen_original = imagecreatefromjpeg($ruta_imagen);
            break;
        case IMAGETYPE_PNG:
            $imagen_original = imagecreatefrompng($ruta_imagen);
            break;
        case IMAGETYPE_GIF:
            $imagen_original = imagecreatefromgif($ruta_imagen);
            break;
    }

    // Redimensionar la imagen original a la nueva imagen
    imagecopyresampled($imagen_nueva, $imagen_original, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_original, $alto_original);

    // Guardar la nueva imagen en el directorio de destino
    switch ($tipo_imagen) {
        case IMAGETYPE_JPEG:
            imagejpeg($imagen_nueva, $ruta_guardado, 100);
            break;
        case IMAGETYPE_PNG:
            imagepng($imagen_nueva, $ruta_guardado);
            break;
        case IMAGETYPE_GIF:
            imagegif($imagen_nueva, $ruta_guardado);
            break;
    }

    // Liberar memoria
    imagedestroy($imagen_original);
    imagedestroy($imagen_nueva);
}

function add_favorito()
{
    if (isset($_SESSION['user'])) {
        $id_usuario = intval($_SESSION['user']);
        $id_instrumento = $_POST['id_instrumento'];

        require_once('modelo/productos_modelo.php');
        $favoritos = new Favoritos_modelo();

        if ($favoritos->existe_favorito($id_usuario, $id_instrumento)) {
            $favoritos->eliminar_favorito($id_usuario, $id_instrumento);
        } else {
            $favoritos->agregar_favorito($id_usuario, $id_instrumento);
        }
    }
}

function vender_instrumento()
{
    $idNotificacion = $_SESSION['id_notificacion'];
    require_once('modelo/menu_modelo.php');
    $modeloNotificacion = new Notificaciones_modelo();
    $arrayNotificacion = $modeloNotificacion->obtenerNotificacion($idNotificacion);

    $id_producto =  intval($arrayNotificacion['id_instrumento']);
    $id_vendedor =  intval($arrayNotificacion['id_usuario']);
    $id_comprador = intval($arrayNotificacion['id_interesado']);
    require_once('modelo/productos_modelo.php');
    $producto_venta = new Productos_modelo();
    $array_producto_venta = $producto_venta->get_datos_prod($id_producto);
    $precio_instrumento = $array_producto_venta[0]['precio_instrumento'];

    if (($producto_venta->insertarNuevaTransaccion($id_producto, $precio_instrumento, $id_vendedor, $id_comprador)) && (($modeloNotificacion->marcarNotificacionLeida($idNotificacion)))) {

        $producto_venta->actualizarInstrumento($id_producto);
        $tipo_notificacion = 2;
        enviarNotificacion($id_producto, $id_comprador, $tipo_notificacion);

        echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Venta realizada con éxito!',
            text: 'Se enviarán tus datos al comprador para que se ponga en contacto contigo.',
        }).then(function() {
            setTimeout(function() {
                location.reload(); 
            }, 1000); 
        });
    </script>";



        unset($_SESSION['id_notificacion']);
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Ooops! Parece que algo ha salido mal.',
        });
    </script>";
    }

    // function enviarNotificacion( $id_instrumento, $id_usuario, $tipo_notificacion )
}

function noVender_instrumento()
{
    $idNotificacion = $_GET['id_notificacion'];
    $idNotificacion = $_SESSION['id_notificacion'];
    require_once('modelo/menu_modelo.php');
    $modeloNotificacion = new Notificaciones_modelo();
    $arrayNotificacion = $modeloNotificacion->obtenerNotificacion($idNotificacion);
    $id_instrumento = intval($arrayNotificacion['id_instrumento']);
    $id_interesado = intval($arrayNotificacion['id_interesado']);
    $tipo_notificacion = 3;
    $modeloNotificacion->marcarNotificacionLeida($idNotificacion);
    enviarNotificacion($id_instrumento, $id_interesado, $tipo_notificacion);
    unset($_SESSION['id_notificacion']);
}

function limpiar_notificacion()
{
    //$idNotificacion = $_GET['id_notificacion']; // O $_SESSION['id_notificacion'], dependiendo de tus necesidades
    $idNotificacion = $_SESSION['id_notificacion'];
    require_once('modelo/menu_modelo.php');
    $modeloNotificacion = new Notificaciones_modelo();
    $modeloNotificacion->marcarNotificacionLeida($idNotificacion);
}

require_once('vista/producto_vista.php');
