<?php
include 'menu_vista.php';

if (isset($mostrar_formulario) && $mostrar_formulario) {

    echo '<body id="subida">';
    echo '<div class="upload-form">
    
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
            <tr>
                <td><label for="id_categoria">Categoría:</label></td>
                <td>
                <select id="id_categoria" name="id_categoria">
                    <option value="8">Eléctrica</option>
                    <option value="9">Acústica</option>
                    <option value="10">Clásica</option>
                    <option value="11">Bajo eléctrico</option>
                    <option value="12">Bajo acústico</option>
                    <option value="13">Otros</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="nombre_instrumento">Nombre:</label></td>
                <td><input type="text" id="nombre_instrumento" name="nombre_instrumento"></td>
            </tr>
            <tr>
                <td><label for="marca_instrumento">Marca:</label></td>
                <td><input type="text" id="marca_instrumento" name="marca_instrumento"></td>
            </tr>
            <tr>
                <td><label for="modelo_instrumento">Modelo:</label></td>
                <td><input type="text" id="modelo_instrumento" name="modelo_instrumento"></td>
            </tr>
            <tr>
                <td><label for="precio_instrumento">Precio:</label></td>
                <td><input type="text" id="precio_instrumento" name="precio_instrumento"></td>
            </tr>
            <tr>
                <td><label for="descripcion_instrumento">Descripción:</label></td>
                <td><textarea id="descripcion_instrumento" name="descripcion_instrumento"></textarea></td>
            </tr>
            <tr>
                <td><label for="estado_instrumento">Estado:</label></td>
                <td><input type="text" id="estado_instrumento" name="estado_instrumento"></td>
            </tr>
            <tr>
                <td><label for="imagenes_instrumento">Imágenes:</label></td>
                <td><input type="file" id="imagenes_instrumento" name="imagenes_instrumento[]" multiple></td>
            </tr>
            </table>
        
            <br>
            <input type="submit" name="btn_insertarProducto" value="Enviar">
        </form>
        
        </div>
        </body>';
} else {

    $esFavorito = false;
    // En la vista producto_vista.php
    if (isset($array_producto) && $array_producto) {
        // Código para mostrar la vista principal_vista.php
        echo '<div class="container__venta">';
        foreach ($array_producto as $value) {
            if (is_array($value)) {

                echo '<div class="card__favoritos">';

                $imagenesArray = json_decode($value['imagenes_instrumento']);
                if (is_array($imagenesArray)) {
                    echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                } else {
                    echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                }

                echo '<div class="info-producto3">';
                echo '<div class="precio-like">';
                echo '<h3>' . $value['precio_instrumento'] . ' €</h3>';

                if (isset($array_favoritos)) {
                    foreach ($array_favoritos as $value2) {
                        if ($value['id_instrumento'] == $value2) {
                            $esFavorito = true;
                        }
                    }

                    if ($esFavorito) {
                        echo '<a href="#" onclick="addFavorite(' . $value['id_instrumento'] . '); return false;"><i id="heart_' . $value['id_instrumento'] . '" class="fas fa-heart favorite-btn text-danger"></i></a>';
                    } else {
                        echo '<a href="#" onclick="addFavorite(' . $value['id_instrumento'] . '); return false;"><i id="heart_' . $value['id_instrumento'] . '" class="far fa-heart favorite-btn"></i></a>';
                    }
                }

                echo '</div>';
                echo '<h2>' . $value['nombre_instrumento'] . '</h2>';
                echo '<h2>Estado: ' . $value['estado_instrumento'] . '</h2>';
                echo '<h2>Publicado por:<h3><h2><a href="#">' . $value['nombre'] . '</a></h2>';

                echo '<form id="comprarForm" action="" method="post">
                <input type="hidden" name="notificacion_id_instrumento" value="' . $value['id_instrumento'] . '">
                <input type="hidden" name="notificacion_id_usuario" value="' . $value['id_usuario'] . '">
                <input type="submit" value="Comprar">
                </form>';
                echo '<a  href="index.php?controlador=chat&action=abrirChat&id_instrumento=' . $value['id_instrumento'] . '" ><input type="button" value="Abrir Chat"></a>';


                echo '</div>';
                echo '</div>';
            }
        }

?>
        <script>
            let comprarForm = document.getElementById('comprarForm');
            let comprarButton = comprarForm.querySelector('input[type="submit"]');
            comprarButton.addEventListener('click', (event) => {
                event.preventDefault(); // Evitar que el formulario se envíe de inmediato

                Swal.fire({
                    title: "Confirmar compra",
                    text: "¿Estás seguro de que deseas realizar esta compra?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Sí",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        comprarForm.submit();
                    }
                });
            });
        </script>

        <script type="text/javascript">
            function submitForm(formId) {
                document.getElementById(formId).submit();
            }
        </script>
<?php
    }
}


?>
</main>
</div>