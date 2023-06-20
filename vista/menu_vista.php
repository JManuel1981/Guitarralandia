<?php
require_once('controlador/menu_controlador.php');
if (isset($_SESSION['user'])) {
    //VISTA LOGUEADO
    $username = 'USUARIO';
    $array_username = usuarioNavbar();
    $username = $array_username[0]['nombre'];
    $esAdmin = $array_username[0]['admin'];

    if ($esAdmin == 1) {
?>


        <nav class='sidebar close'>
            <header>
                <div class='text logo'>
                    <a href='index.php'>
                        <span class='name'>Guitarralandia</span>
                    </a>

                    <span class='subname'>Your dream world</span>

                </div>
                <i class='bx bx-menu toggle'></i>
            </header>


            <div class='menu-bar'>
                <div class='menuL'>
                    <li class='search-box' class='nav-link'>
                        <a href='index.php?controlador=usuarios&action=userDatos' id='username-link'>
                            <i class='bx bx-user icon' title="Usuario: <?php echo $username ?>"></i>
                            <span class='text nav-text'><?php echo $username ?></span>
                        </a>
                    </li>

                    <ul class='menu-links'>
                        <li class='nav-link'>
                            <a href='index.php'>
                                <i class='bx bx-home icon' title='Principal🏠'></i>
                                <span class='text nav-text'>Home</span>
                            </a>
                        </li>

                        <ul class='menu-links'>
                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userEnVenta'>
                                    <i class='bx bx-label icon' title='Producto en venta🛒' id="enVenta"></i>
                                    <span class='text nav-text'>En venta</span>
                                </a>
                            </li>

                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userComprados'>
                                    <i class='bx bx-shopping-bag icon' title="Compras realizadas🛍️"></i>
                                    <span class='text nav-text'>Comprados</span>
                                </a>
                            </li>

                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userVendidos'>
                                    <i class='bx bx-check-square icon' title="Productos vendidos🤝"></i>
                                    <span class='text nav-text'>Vendidos</span>
                                </a>
                            </li>

                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userChats'>
                                    <i class='bx bx-message-dots icon' title="Chat usuarios📨"></i>
                                    <span class='text nav-text'>Mensajes</span>
                                </a>
                            </li>

                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userFavoritos'>
                                    <i class='bx bx-heart icon' title="Productos favoritos💓"></i>
                                    <span class='text nav-text'>Favoritos</span>
                                </a>
                            </li>
                            <li class='nav-link'>
                                <a href='index.php?controlador=usuarios&action=userAjustes'>
                                    <i class='bx bx-cog icon' title="Ajustes⚙️"></i>
                                    <span class='text nav-text'>Ajustes</span>
                                </a>
                            </li>
                        </ul>
                </div>

                <div class='bottom-content'>
                    <li class=''>
                        <a href='index.php?controlador=principal&action=desconectar'>
                            <i class='bx bx-log-out icon' title="Desconectar📴"></i>
                            <span class='text nav-text'>Salir</span>
                        </a>
                    </li>
                </div>
            </div>

        </nav>

        <div class='nav-dch'>
            <a href='index.php?controlador=admin'>ADMINISTRAR</a>

            <div class='notification-icon'>
                <span class='badge'>
                    <?php
                    echo is_array($notificaciones) || $notificaciones instanceof Countable ? count($notificaciones) : 0;

                    ?></span>
                <i class='fa fa-bell'></i>
            </div>

            <a href='#'>Notificaciones</a>

        </div>

    <?php
    } else {
    ?>

        <nav class='sidebar close'>
            <header>
                <div class='text logo'>
                    <a href='index.php'>
                        <span class='name'>Guitarralandia</span>
                    </a>

                    <span class='subname'>Your dream world</span>

                </div>
                <i class='bx bx-menu toggle'></i>
            </header>
            <div class='menu-bar'>
                <div class='menuL'>
                    <li class='search-box' class='nav-link'>
                        <a href='index.php?controlador=usuarios&action=userDatos' id='username-link'>
                            <i class='bx bx-user icon' title="Usuario🧑‍💻"></i>
                            <span class='text nav-text'><?php echo $username ?></span>
                        </a>
                    </li>

                    <ul class='menu-links'>
                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userEnVenta'>
                                <i class='bx bx-label icon' id="enVenta"></i>
                                <span class='text nav-text' title='Producto en venta🛒'>En venta</span>
                            </a>
                        </li>

                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userComprados'>
                                <i class='bx bx-shopping-bag icon' title="Compras realizadas🛍️"></i>
                                <span class='text nav-text'>Comprados</span>
                            </a>
                        </li>

                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userVendidos'>
                                <i class='bx bx-check-square icon' title="Productos vendidos🤝"></i>
                                <span class='text nav-text'>Vendidos</span>
                            </a>
                        </li>

                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userChats'>
                                <i class='bx bx-message-dots icon' title="Chat usuarios📨"></i>
                                <span class='text nav-text'>Mensajes</span>
                            </a>
                        </li>

                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userFavoritos'>
                                <i class='bx bx-heart icon' title="Productos favoritos💓"></i>
                                <span class='text nav-text'>Favoritos</span>
                            </a>
                        </li>
                        <li class='nav-link'>
                            <a href='index.php?controlador=usuarios&action=userAjustes'>
                                <i class='bx bx-cog icon' title="Ajustes⚙️"></i>
                                <span class='text nav-text'>Ajustes</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class='bottom-content'>
                    <li class=''>
                        <a href='index.php?controlador=principal&action=desconectar'>
                            <i class='bx bx-log-out icon' title="Desconectar📴"></i>
                            <span class='text nav-text'>Salir</span>
                        </a>
                    </li>
                </div>
            </div>

        </nav>

        <div class='nav-dch'>
            <div class='notification-icon'>

                <?php
                $num_notificaciones = isset($notificaciones) ? count($notificaciones) : 0;

                ?>
                <span class='badge'><?php echo $num_notificaciones ?></span>
                <i class='fa fa-bell'></i>
            </div>

            <a href='#'>Notificaciones</a>

        </div>
    <?php
    }

    ?>

    <div class='contenedor-productos'>

    <?php
} else {
    //VISTA SIN LOGUEAR
    ?>
        <header class='header'>
            <div class='container__header'>
                <div class='logo__header'>
                    <div class='logo'>
                        <img src='../img/GUITARRALANDIA_BKW-removebg-preview.png' alt='Logo' class='logo'>
                    </div>
                    <h1>GUITARRALANDIA</h1>
                </div>
                <div class='boton__header'>
                    <label for='btn-menu'>Menú</label>
                </div>
                <input type='checkbox' id='btn-menu'>
                <nav class='menu'>
                    <a href='index.php'>HOME</a>
                    <a href='#redes'>ABOUT US</a>
                    <a href='index.php?controlador=usuarios'>LOGIN</a>
                </nav>
                <div class='avatar' id='avatar'>
                    <img src='../img/avatardefault_92824.png' alt='Avatar' class='avatar-image'>
                </div>
            </div>
        </header>

        <header id='inicio'>
            <div class='textos'>
                <h1 class='titulo'>Guitarralandia</h1>
                <h3 class='subtitulo'>Intercambia tu Guitarra!</h3>
                <a href='index.php?controlador=usuarios' class='boton'>Suscribete</a>
            </div>
        </header>
        <main id='inicio-uno' class='main'>
            <section class='acerca-de'>
                <div class='contenedor'>
                    <h2 class='sobre-nosotros'>Sobre nosotros
                        <hr>
                    </h2>
                    <h3 class='slogan'>Tu música, tu sueño</h3>
                    <p class='parrafo'>Somos una plataforma especializada en el apasionante mundo de las guitarras. Nuestro objetivo es facilitar el intercambio de guitarras de todo tipo, ya sean nuevas o usadas, eléctricas o acústicas, bajos o españolas. Nos enorgullece ofrecer a los amantes de la música un espacio donde puedan encontrar su instrumento ideal.
                        En nuestro sitio web, encontrarás una amplia selección de guitarras de alta calidad, disponibles para la compra, venta o intercambio. Nos esforzamos por reunir a una comunidad de músicos apasionados que buscan expandir su colección o encontrar esa guitarra única que se ajuste perfectamente a su estilo y preferencias.</p>
                    <p class='parrafo'>Nuestra plataforma intuitiva y fácil de usar te permitirá navegar a través de diversas categorías y filtrar tus búsquedas para encontrar rápidamente la guitarra que deseas. Además, facilitamos el contacto directo entre compradores y vendedores, fomentando así la comunicación y la confianza en cada transacción.
                        En nuestra comunidad, no importa si eres un principiante entusiasmado o un experto experimentado;
                        todos son bienvenidos. Comparte tus experiencias, consejos y conocimientos con otros miembros, participa en discusiones y descubre nuevas oportunidades musicales.
                        Nos enorgullece ser la plataforma líder en intercambio de guitarras, brindando un servicio confiable y seguro para todos nuestros usuarios. Si tienes una guitarra que ya no usas o estás buscando una nueva adición a tu colección, estás en el lugar adecuado.
                        Únete a nosotros hoy mismo y adéntrate en el fascinante mundo de las guitarras. ¡Encuentra tu tesoro musical y conecta con otros apasionados de la guitarra en nuestro vibrante espacio virtual!</p>
                    <a href='index.php?controlador=correo' class='boton'>Contacta</a>
                </div>
            </section>
            <section class='galeria'>

                <div class='imagenes'>
                    <img src='https://images.unsplash.com/photo-1508186736123-44a5fcb36f9f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80' alt='portada 1'>

                </div>
                <div class='imagenes'>
                    <img src='../img/buleria.jpg' alt='portada 2'>

                </div>
                <div class='imagenes'>
                    <img src='https://images.unsplash.com/photo-1617992415754-11e2c2ee5197?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8Z3VpdGFycmFzfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60' alt='portada 3'>
                    <div class='encima'>
                        <h2>GUITARRALANDIA🎸</h2>
                        <div></div>
                    </div>

                </div>
                <div class='imagenes'>
                    <img src='../img/portada1.jpeg'>

                </div>
                <div class='imagenes none'>
                    <img src='https://images.unsplash.com/photo-1601956349641-ec9de1c434b9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTh8fGd1aXRhcnJhc3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60' alt='portada 5'>

                </div>

            </section>

            <!--Slider imagenes-->
            <section id='slider_pro'>
                <h1 id='productos'>LOS MEJORES PRODUCTOS
                    <hr>
                </h1>

                <div class='container-slider'>

                    <div class='slider' id='slider'>
                        <div class='slider__section'>
                            <img src='https://images.unsplash.com/photo-1550272407-7dc59342500e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjB8fGd1aXRhcnJhc3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60' alt='slider 1' class='slider__img'>
                        </div>
                        <div class='slider__section'>
                            <img src='https://images.unsplash.com/photo-1601956349582-ba50bedaa8ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGd1aXRhcnJhc3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60' alt='slider 2' class='slider__img'>
                        </div>
                        <div class='slider__section'>
                            <img src='https://images.unsplash.com/photo-1562092083-bf2848da4bcd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fGd1aXRhcnJhc3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60' alt='slider 3' class='slider__img'>
                        </div>
                        <div class='slider__section'>
                            <img src='https://images.unsplash.com/photo-1519508234439-4f23643125c1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8Z3VpdGFycmFzfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60' alt='slider 4' class='slider__img'>
                        </div>
                    </div>

                    <div class='slider__btn slider__btn--right' id='btn-right'>&#62;
                    </div>
                    <div class='slider__btn slider__btn--left' id='btn-left'>&#60;
                    </div>
                </div>
            </section>

            <div class='barras'>
                <span class='barra active' onclick='posicionSlide(1)'></span>
                <span class='barra' onclick='posicionSlide(2)'></span>
                <span class='barra' onclick='posicionSlide(3)'></span>
            </div>

        </main>
        <div class='contenedor-productos'>
        <?php

    }
        ?>

        <div id="flechaScroll">
            <i class="fas fa-arrow-up"></i>
        </div>



        <!-- Ventana modal de notificaciones -->
        <div id='notification-modal' class='modal'>
            <div class='modal-content'>
                <button id="close">&times;</button>
                <h3>Notificaciones</h3>
                <ul id='notification-list'></ul>
            </div>
        </div>