<?php
include 'menu_vista.php';

if (isset($mostrar_principal) && $mostrar_principal) {

?>

    <main id="main" class="main">
        <h1 id="categ">CATEGORÍAS</h1>
        <hr>
        <div class="contenedor-flex">

            <?php
            if (isset($array_datosC)) {

                $i = 0;
                foreach ($array_datosC as $value) {

                    if (is_array($value)) {
                        if ($i == 0) {
                            echo ('<div class="columna-flex">');
                        }
                        echo '<div class="card1">';
                        echo '<form id="form_' . $value['id_categoria'] . '" action="" method="POST">';
                        echo '<input type="hidden" name="id_categoria" value="' . $value['id_categoria'] . '">';

                        echo '<a href="#" onClick="document.getElementById(\'form_' . $value['id_categoria'] . '\').submit();">';
                        echo '<img src="img/libres/' . $value['img_cat'] . '" alt="Imagen ' . $value['nombre'] . '">';
                        echo '<h2>' . $value['nombre'] . '</h2>';
                        echo '</a>';

                        echo '</form>';
                        echo ('</div>');
                        ++$i;
                        if ($i == 2) {
                            echo ('</div>');
                            $i = 0;
                        }
                    }
                }
            }
        } else {
            

            if (isset($array_datos_cat) && isset($array_datosC)) {

                
                $id_num = $array_datos_cat[0]['id_categoria'];
                $int_id_num = intval($id_num);

                $titulo = "Error";
                foreach ($array_datosC as $elemento) {
                    if ($elemento['id_categoria'] == $int_id_num) {
                        $titulo = $elemento['nombre'];
                        break;
                    }
                }

                echo ('<h1 class="title">' . $titulo . '</h1>');
                echo ('<div class="contenedor-flex">');

                $esFavorito = false;
                if (isset($_SESSION['user'])) {  //VISTA LOGUEADO
                    $id_logueado = intval($_SESSION['user']);
                    echo '<div class="container__venta__pf">';
                    foreach ($array_datos_cat as $value) {


                        $esFavorito = false;
                        if (is_array($value)) {
                            if ($value['id_usuario'] != $id_logueado) {

                                echo '<form id="form_' . $value['id_instrumento'] . '" action="index.php?controlador=producto" method="POST">';
                                echo '<input type="hidden" name="id_instrumento" value="' . $value['id_instrumento'] . '">';
                                echo '<a href="#" onclick="submitForm(\'form_' . $value['id_instrumento'] . '\');">';
                                echo '<div class="card__venta">';

                                $imagenesArray = json_decode($value['imagenes_instrumento']);
                                if (is_array($imagenesArray)) {
                                    echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                                } else {
                                    echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                                }

                                echo '<div class="info-producto2">';
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
                                echo '</div>';

                                echo '</div>';
                                echo '</a>';
                                echo '</form>';
                            }
                        }
                    }
                    echo '</div>';

            ?>
                    <script type="text/javascript">
                        function submitForm(formId) {
                            document.getElementById(formId).submit();
                        }
                    </script>
        <?php
                } else { //VISTA SIN LOGUEAR
                    echo '<div class="container__venta">';
                    foreach ($array_datos_cat as $value) {

                        if (is_array($value)) {

                            echo '<div class="card__venta">';

                            echo '<a href="index.php?controlador=usuarios&id_instrumento=' . $value['id_instrumento'] . '">';

                            $imagenesArray = json_decode($value['imagenes_instrumento']);
                            if (is_array($imagenesArray)) {
                                echo '<img src="img/' . $imagenesArray[0] . '" alt="' . $imagenesArray[0] . '" />';
                            } else {
                                echo '<img src="img/' . $value['imagenes_instrumento'] . '" alt="' . $value['imagenes_instrumento'] . '" />';
                            }

                            echo '<div class="info-producto2">';
                            echo '<div class="precio-like">';
                            echo '<h3>' . $value['precio_instrumento'] . ' €</h3>';
                            echo '</div>';
                            echo '<h2>' . $value['nombre_instrumento'] . '</h2>';
                            echo '</div>';
                            echo '</a>';

                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
                echo '</div>';
            } else {          //CIERRA EL ISSET ARRAY_DATOS

                echo '<h1 class="title">NO HAY PRODUCTOS QUE MOSTRAR</h1>';
            }
        }
        ?>
        </div>
    </main>
    </div>

    <footer>
        <?php include 'footer_vista.php';  ?>
    </footer>