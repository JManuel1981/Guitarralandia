$(document).ready(function () {
    // Envío del formulario mediante AJAX
    $('#form-mensaje').submit(function (event) {
        event.preventDefault();


        var mensaje = $('#mensaje').val();
        var idChat = $('input[name="id_chat"]').val();


        $.ajax({
            type: 'POST',
            url: 'modelo/enviar_mensaje.php',
            data: {
                mensaje: mensaje,
                id_chat: idChat
            },
            success: function (response) {

                $('#chat-container ul.chat-list').append(response);
                $('#mensaje').val('');
            }
        });
    });


    setInterval(function () {
        var idChat = $('input[name="id_chat"]').val();


        $.ajax({
            type: 'GET',
            url: 'modelo/obtener_mensaje.php',
            data: {
                id_chat: idChat
            },
            success: function (response) {

                $('#chat-container ul.chat-list').html(response);
            }
        });
    }, 1000);
});
