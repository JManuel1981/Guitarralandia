<?php
if (isset($_SESSION['user'])) {  //VISTA LOGUEADO

    include 'menu_vista.php';
    $mostrar_boton_venta = false;
    $mostrar_compradas = false;
    $mostrar_vendidas = false;


?>

    <main>
        <?php
        if (isset($array_producto) && $array_producto) {
            foreach ($array_producto as $value) {
                if (is_array($value)) {
                }
            }
        }
        ?>

        <?php

        //DATOS DEL USER
        if (isset($array_datosUsuario)) {

            echo '<div class="card2 user">';
            echo '<div class="user-content">';
            echo '<div class="avatar-container2">';
            echo '<img src="../img/avatardefault_92824.png" alt="Avatar" class="avatar-image2">';
            echo '</div>';

            echo '<div class="info-container__user">';
            echo '<h1>MIS DATOS</h1>';
            foreach ($array_datosUsuario as $value) {
                if (is_array($value)) {
                    echo '<h3>Nombre: ' . $value['nombre'] . '</h3>';
                    echo '<h3>Email: ' . $value['email'] . '</h3>';
                    echo '<h3>Teléfono: ' . $value['telefono'] . '</h3>';
                    echo '<h5>Dirección: ' . $value['direccion'] . '</h5>';

                    echo "<form action='' method='POST'>
                <input type='hidden' value=" . $value['nombre'] . " name='btn_BORRAR'>
                <input type='submit' value='Borrar' name='btn_borrarNombre' id='boton_User'>
                </form>";
                } else {
                    echo '<h1 class="title">NO HAY DATOS QUE MOSTRAR</h1>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }


        $mostrar_error_venta = true;

        //PRODUCTOS EN VENTA USUARIO

        if (isset($array_productosVenta)) {

            echo '<div id="modif"></div>';
            echo '<h1 class="title">PRODUCTOS A LA VENTA</h1>';
            echo '<div class="subir__producto">';
            echo '<button>';
            echo '<a href="index.php?controlador=producto&vista=formulario">¡SUBE UN PRODUCTO!</a>';
            echo '</button>';
            echo '</div>';

            echo '<div class="container__venta">';
            if (empty($array_productosVenta)) {
                echo '<p>No tienes productos a la venta en este momento.</p>';
            } else {
                foreach ($array_productosVenta as $value) {
                    if (is_array($value)) {
                        echo '<div class="card__venta">';
                        $imagenesArray = json_decode($value['imagenes_instrumento']);
                        if (is_array($imagenesArray)) {
                            echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                        } else {
                            echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                        }
                        echo '<h2>Nombre: ' . $value['nombre_instrumento'] . '</h2>';
                        echo '<h2>Precio: ' . $value['precio_instrumento'] . ' €</h2>';
                        echo '<h3>Descripción: ' . $value['descripcion_instrumento'] . '</h3>';
                        echo '<h3>Estado: ' . $value['estado_instrumento'] . '</h3>';
                        echo '<form id="form_' . $value['id_instrumento'] . '" action="" method="POST">';
                        echo '<input type="hidden" name="id_instrumento" value="' . $value['id_instrumento'] . '">';
                        echo '<input type="hidden" name="nombre_instrumento" value="' . $value['nombre_instrumento'] . '">';
                        echo '<input type="hidden" name="precio_instrumento" value="' . $value['precio_instrumento'] . '">';
                        echo '<input type="hidden" name="descripcion_instrumento" value="' . $value['descripcion_instrumento'] . '">';
                        echo '<input type="hidden" name="estado_instrumento" value="' . $value['estado_instrumento'] . '">';
                        echo '<a href="#" onclick="editarProducto(' . $value['id_instrumento'] . ');"><button type="button">EDITAR</button></a>';
                        echo '</form>';
                        echo '</div>';
                    }
                }
            }
            echo '</div>';
        }

            echo '<script>
        function editarProducto(id) {
            var form = document.getElementById("form_" + id);
            var nombre = form.elements["nombre_instrumento"].value;
            var precio = form.elements["precio_instrumento"].value;
            var descripcion = form.elements["descripcion_instrumento"].value;
            var estado = form.elements["estado_instrumento"].value;
    
            // Mostrar el formulario de edición con los datos prellenados
            var modifDiv = document.getElementById("modif");
            modifDiv.innerHTML = `
                
                <form class="upload-form" id="form_editar" action="index.php?controlador=producto" method="POST">
                <h2 class="title">Modifica tu Producto✅</h2>
                    <input type="hidden" name="id_instrumento" value="${id}">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="${nombre}">
                    <label for="precio">Precio:</label>
                    <input type="text" name="precio" value="${precio}">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" value="${descripcion}">
                    <label for="estado">Estado:</label>
                    <input type="text" name="estado" value="${estado}">
                    <input type="submit" value="Modificar" name="btn_modificar"></input>
                    <input type="submit" value="Eliminar" name="btn_eliminar"></input>
                </form>
            `;
        }
    </script>';

        if ($mostrar_boton_venta) {
            echo '<h2 class="title">NO TIENES PRODUCTOS A LA VENTA</h2>';
            echo '<div class="subir__producto">';
            echo '<button>';
            echo '<a href="index.php?controlador=producto&vista=formulario">¡SUBE UN PRODUCTO!</a>';
            echo '</button>';
            echo '</div>';
        }

        echo '<script>';
        echo 'document.getElementById("enVenta").addEventListener("click", function(event) {';
        echo 'event.preventDefault();';
        echo 'document.getElementById("errorVentaContainer").style.display = "block";';
        echo '});';
        echo '</script>';


        //PRODUCTOS COMPRADOS POR USUARIO
        if (isset($array_productosComprados)) {
            echo '<h1 class="title">PRODUCTOS COMPRADOS</h1>';
            if (!empty($array_productosComprados)) {

                echo '<div class="container__venta">';
                foreach ($array_productosComprados as $value) {
                    if (is_array($value)) {
                        echo '<div class="card__venta">';
                        $imagenesArray = json_decode($value['imagenes_instrumento']);
                        if (is_array($imagenesArray)) {
                            echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                        } else {
                            echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                        }
                        echo '<h3>' . $value['nombre_instrumento'] . ' €</h3>';
                        echo '<h4>Vendedor: ' . $value['nombre_vendedor'] . '</h4>';
                        echo '<h4>Precio: ' . $value['precio_transaccion'] . '€</h4>';
                        echo '<h4>Fecha Transacción: ' . $value['fecha_transaccion'] . '</h4>';
                        echo '</div>';
                    }
                }
                echo '</div>';
            }
        }

        if ($mostrar_compradas) {
            echo '<h1 class="title">PRODUCTOS COMPRADOS</h1><br/>';
            echo '<h2 class="title">TODAVÍA NO HAS HECHO NINGUNA COMPRA</h2>';
        }


        if (isset($array_productosVendidos)) {
            echo '<h1 class="title">PRODUCTOS VENDIDOS</h1>';
            if (!empty($array_productosVendidos)) {
                echo '<div class="container__venta">';
                foreach ($array_productosVendidos as $value) {
                    if (is_array($value)) {
                        echo '<div class="card__venta__vendidos">';
                        $imagenesArray = json_decode($value['imagenes_instrumento']);
                        if (is_array($imagenesArray)) {
                            echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                        } else {
                            echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                        }
                        echo '<h3>' . $value['nombre_instrumento'] . ' €</h3>';
                        echo '<h4>Comprador: ' . $value['nombre_comprador'] . '</h4>';
                        echo '<h4>Precio: ' . $value['precio_transaccion'] . '€</h4>';
                        echo '<h4>Fecha Publicación: ' . $value['fecha_publicacion_instrumento'] . '</h4>';
                        echo '<h4>Fecha Transacción: ' . $value['fecha_transaccion'] . '</h4>';
                        echo '</div>';
                    }
                }
                echo '</div>';
            }
        }
        if ($mostrar_vendidas) {
            echo '<h1 class="title">PRODUCTOS VENDIDOS</h1><br/>';
            echo '<h2 class="title">TODAVÍA NO HAS HECHO NINGUA VENTA</h2>';
        }

        //MENSAJES

        if (isset($array_chats_abiertos)) {
            echo '<h1 class="title">CHATS ABIERTOS</h1>';
            if (!empty($array_chats_abiertos)) {
                foreach ($array_chats_abiertos as $value) {
                    echo '<div class="chat-container">';
                    echo '<a href="index.php?controlador=chat&action=mostrarMensajesChat_porId&id_chat=' . $value['id_chat'] . '">';
                    echo '<h3 class="chat-username">Usuario: ' . $value['nombre_otro_usuario'] . '</h3>';
                    echo '<h2 class="chat-instrument">Instrumento: ' . $value['nombre_instrumento'] . '</h2>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<h2 class="title">NO TIENES CHATS ABIERTOS</h2>';
            }
        }

        //FAVORITOS
        if (isset($array_productosFavoritos)) {
            echo '<h1 class="title">LISTA DE FAVORITOS</h1>';
            if (!empty($array_productosFavoritos)) {
                if (!empty($array_productosFavoritos)) {
                    echo '<div class="container__venta">';
                    foreach ($array_productosFavoritos as $value) {
                        if (is_array($value)) {

                            echo '<div class="card__venta__favoritos">';
                            $imagenesArray = json_decode($value['imagenes_instrumento']);
                            if (is_array($imagenesArray)) {
                                echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                            } else {
                                echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                            }
                            echo '<div class="info-producto">';
                            echo '<h2>Nombre: ' . $value['nombre_instrumento'] . '</h2>';
                            echo '<h2>Precio: ' . $value['precio_instrumento'] . ' €</h2>';
                            echo '<a href="#" onclick="addFavorite(' . $value['id_instrumento'] . '); return false;"><i id="heart_' . $value['id_instrumento'] . '" class="fas fa-heart favorite-btn text-danger"></i></a>';
                            echo '<h3>Descripción: ' . $value['descripcion_instrumento'] . '</h3>';
                            echo '<h3>Estado: ' . $value['estado_instrumento'] . '</h3>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
            } else {
                echo '<h2 class="title">NO HAY PRODUCTOS FAVORITOS</h2>';
            }
        }


        //VISTA OTROS USUARIOS   //FUNCIÓN VISTA ANTIGUO TESTAMENTO
        if (isset($array_datosOtherUser)) {

            $mostrar_error = false;
            echo '<div class="card" style="background-color: limegreen;">';
            echo '<div style = "align: left";>';
            if (!$mostrar_error) echo '<h1>DATOS DEL USUARIO</h1><br/><br/>';
            echo '<h3>Nombre: ' . $array_datosOtherUser['nombre'] . '</h3><br/>';
            echo '<h3>Email: ' . $array_datosOtherUser['email'] . '</h3><br/>';
            echo '';
            echo '</div>';
            echo '</div>';
            if ($mostrar_error) {
                echo '<h1>NO HAY DATOS QUE MOSTRAR DEL USUARIO SELECCIONADO</h1>';
            }
        }

        ?>

    </main>
    </div>

<?php

} else { //VISTA LOGIN

?>

    <body class="body">
        <header class="header">
            <div class="container__header">
                <div class="logo__header">
                    <h1>GUITARRALANDIA</h1>
                </div>

                <div class="boton__header">
                    <label for="btn-menu">MENU</label>
                </div>
                <input type="checkbox" id="btn-menu">
                <nav class="menu">
                    <a href="index.php">HOME</a>
                    <a href="index.php?controlador=correo">CONTACT US</a>
                    <a href="index.php?controlador=principal&action=desconectar">LOGOUT</a>
                </nav>
            </div>
        </header>

        <main id="registro-login">
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Registrate para iniciar sesión</p>
                        <button id="btn__registrarse">Registrarse</button>
                    </div>
                </div>
                <!--Formulario de login y Registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input class='controls' type='text' name='nombre' id='usuario' placeholder='Nombre usuario'>
                        <input class='controls' type='password' name='pass' id='pass' placeholder='Contraseña'>
                        <button type="submit" name="enviar" id="btn_entrar">Entrar</button>
                    </form>
                    <!--Registro-->
                    <form action="" method="POST" class="formulario__register">
                        <h2>Registrarse</h2>
                        <div class="input-container">
                            <input type="text" placeholder="Nombre" name="nombre" id="nombreInput">
                            <span class="error"></span>
                            <span class="icon"></span>
                        </div>
                        <div class="input-container">
                            <input type="email" placeholder="Correo Electrónico" name="email" id="emailInput">
                            <span class="error"></span>
                            <span class="icon"></span>
                        </div>
                        <div class="input-container">
                            <input type="password" placeholder="Password" name="pass" id="passInput">
                            <span class="error"></span>
                            <span class="icon"></span>
                        </div>
                        <div class="input-container">
                            <input type="text" placeholder="Dirección" name="direccion" id="direccionInput">
                            <span class="error"></span>
                            <span class="icon"></span>
                        </div>
                        <div class="input-container">
                            <input type="text" placeholder="Teléfono" name="telefono" id="telefonoInput">
                            <span class="error"></span>
                            <span class="icon"></span>
                        </div>
                        <button type="submit" name="btn_insertarUser">Registrarse</button>
                    </form>

                </div>
            </div>
        </main>

    </body>

    </html>

<?php
}

?>