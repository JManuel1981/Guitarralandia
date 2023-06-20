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


<form method="post" action="" class="contact">
    <h1>Contact Guitarreros</h1>
    <input type="text" id="name" name="name" placeholder="Nombre">
    <input type="text" id="asunto" name="asunto" placeholder="Asunto">
    <input type="email" id="email" name="email" placeholder="Email">
    <textarea id="message" name="message" placeholder="Mensaje"></textarea>
    <input type="submit" name="enviar" value="Enviar">
</form>