<?php require_once('controlador/menu_controlador.php'); ?>


<div id="modif"></div>
<div class="folder-container">
    <div class="folder active" id="folder1">
        <a href="index.php?controlador=admin&action=adminUsuarios">
            <h3>USUARIOS</h3>
        </a>
    </div>
    <div class="folder" id="folder2">
        <a href="index.php?controlador=admin&action=adminInstrumentos">
            <h3>INSTRUMENTOS</h3>
        </a>
    </div>
</div>

<div class="content active" id="content1">
    <section>
        <?php if (isset($array_usuarios_admin)): ?>
            
            <h2 class="admin">Administrar Usuarios</h2>
            <table class="tabla">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Es Admin</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php foreach ($array_usuarios_admin as $value): ?>
                    <?php if (is_array($value)): ?>
                        <tr>
                            <td><?= $value['nombre'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['telefono'] ?></td>
                            <td><?= $value['admin'] ?></td>
                            <td class="button-cell">
                                <form id="form_borrar_<?= $value['nombre'] ?>" action="" method="POST">
                                    <input type="hidden" value="<?= $value['nombre'] ?>" name="btn_BORRAR">
                                    <input class="delete-button" type="submit" value="Borrar" name="btn_borrarNombre">
                                </form>
                            </td>
                            <td class="button-cell">
                                <form id="form_editar_<?= $value['id_usuario'] ?>" action="index.php?controlador=admin" method="POST">
                                    <input type="hidden" name="id_usuario" value="<?= $value['id_usuario'] ?>">
                                    <input type="hidden" name="nombre" value="<?= $value['nombre'] ?>">
                                    <input type="hidden" name="email" value="<?= $value['email'] ?>">
                                    <input type="hidden" name="telefono" value="<?= $value['telefono'] ?>">
                                    <input type="hidden" name="admin" value="<?= $value['admin'] ?>">
                                    <button class='modify-button' type="button" onclick="editarUser(<?= $value['id_usuario'] ?>)">Modificar</button>
                                    
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>
</div>

<script>
    function editarUser(id) {
        var form = document.getElementById("form_editar_" + id);
        var nombre = form.elements["nombre"].value;
        var email = form.elements["email"].value;
        var telefono = form.elements["telefono"].value;
        var admin = form.elements["admin"].value;

        // Mostrar el formulario de edición con los datos prellenados
        var modifDiv = document.getElementById("modif");
        modifDiv.innerHTML = `
            <form class="upload-form" id="form_editar" action="index.php?controlador=admin" method="POST">
                <h2 class="title">Administración de Usuarios✅</h2>
                <input type="hidden" name="id_usuario" value="${id}">
                <input type="hidden" name="nombre_original" value="${nombre}">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="${nombre}">
                <label for="email">Email:</label>
                <input type="text" name="email" value="${email}">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" value="${telefono}">
                <label for="admin">Admin:</label>
                <input type="text" name="admin" value="${admin}">
                <input type="submit" value="Modificar" name="btn_modificar_user">
                <input type="button" value="Cancelar" onclick="cancelarEdicion()">
            </form>
        `;
    }

    function cancelarEdicion() {
        var modifDiv = document.getElementById("modif");
        modifDiv.innerHTML = '';  
    }
</script>

<div class="content active" id="content2">
    <section>
        <?php if (isset($array_productos_admin)): ?>
            
            <h2 class="admin">Administrar Productos</h2>
            <table class="tabla">
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Disponible</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php foreach ($array_productos_admin as $value): ?>
                    <?php if (is_array($value)): ?>
                        <tr>
                            <td><?= $value['nombre_instrumento'] ?></td>
                            <td><?= $value['estado_instrumento'] ?></td>
                            <td><?= $value['precio_instrumento'] ?></td>
                            <td><?= $value['disponible'] ?></td>
                            <td class="button-cell">
                                <form id="form_borrar_producto_<?= $value['nombre_instrumento'] ?>" action="" method="POST">
                                    <input type="hidden" value="<?= $value['nombre_instrumento'] ?>" name="btn_borrar_producto">
                                    <input class="delete-button" type="submit" value="Borrar" name="btn_borrarProducto">
                                </form>
                            </td>
                            <td class="button-cell">
                                <form id="form_editar_producto_<?= $value['id_instrumento'] ?>" action="index.php?controlador=admin" method="POST">
                                    <input type="hidden" name="id_instrumento" value="<?= $value['id_instrumento'] ?>">
                                    <input type="hidden" name="nombre_instrumento" value="<?= $value['nombre_instrumento'] ?>">
                                    <input type="hidden" name="estado_instrumento" value="<?= $value['estado_instrumento'] ?>">
                                    <input type="hidden" name="precio_instrumento" value="<?= $value['precio_instrumento'] ?>">
                                    <input type="hidden" name="disponible" value="<?= $value['disponible'] ?>">
                                    <button class='modify-button' type="button" onclick="editarProducto('<?= $value['id_instrumento'] ?>')">Modificar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>
</div>

<script>
    function editarProducto(id) {
        var form_instrumentos = document.getElementById("form_editar_producto_" + id);
        var nombre_instrumento = form_instrumentos.elements["nombre_instrumento"].value;
        var estado = form_instrumentos.elements["estado_instrumento"].value;
        var precio_instrumento = form_instrumentos.elements["precio_instrumento"].value;
        var disponible = form_instrumentos.elements["disponible"].value;
        

        // Mostrar el formulario de edición con los datos prellenados
        var modifDiv = document.getElementById("modif");
        modifDiv.innerHTML = `
            <form class="upload-form" id="form_editar_instrumentos" action="index.php?controlador=admin" method="POST">
                <h2 class="title">Administración de Instrumentos✅</h2>
                <input type="hidden" name="id_instrumento" value="${id}">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre_instrumento" value="${nombre_instrumento}">
                <label for="estado">Estado:</label>
                <input type="text" name="estado_instrumento" value="${estado}">
                <label for="precio_instrumento">Precio:</label>
                <input type="text" name="precio_instrumento" value="${precio_instrumento}">
                <label for="disponible">Disponibilidad:</label>
                <input type="text" name="disponible" value="${disponible}">
                <input type="submit" value="Modificar" name="btn_modificar_instrumento">
                <input type="button" value="Cancelar" onclick="cancelarEdicion()">
            </form>
        `;
    }

    function cancelarEdicion() {
        var modifDiv = document.getElementById("modif");
        modifDiv.innerHTML = '';  
    }
</script>



