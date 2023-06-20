const formulario = document.querySelector('.formulario__register');
const nombreInput = formulario ? formulario.querySelector('input[name="nombre"]') : null;
const emailInput = formulario ? formulario.querySelector('input[name="email"]') : null;
const passInput = formulario ? formulario.querySelector('input[name="pass"]') : null;
const direccionInput = formulario ? formulario.querySelector('input[name="direccion"]') : null;
const telefonoInput = formulario ? formulario.querySelector('input[name="telefono"]') : null;


const nombreRegex = /^[A-Z][a-zA-Z]{3,}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{4,}$/;
const direccionRegex = /^(Calle|Avenida|Camino|Carretera)\s[A-Z][a-zA-Z]+\s\d{2,}$/;
const telefonoRegex = /^\d{9,}$/;


function validarCampo(input, regex, mensaje) {
    if (!regex.test(input.value)) {
        input.classList.add('error');
        input.classList.remove('exito');
        mostrarMensaje(input, mensaje, 'error');
        return false;
    } else {
        input.classList.remove('error');
        input.classList.add('exito');
        mostrarMensaje(input, 'Campo válido', 'exito');
        return true;
    }
}


function mostrarMensaje(input, mensaje, tipo) {
    const mensajeSpan = input.nextElementSibling;
    mensajeSpan.textContent = mensaje;
    mensajeSpan.classList.remove('error', 'exito');
    mensajeSpan.classList.add(tipo);
}


if (formulario) {
    formulario.addEventListener('submit', function (event) {

        const nombreValido = validarCampo(nombreInput, nombreRegex, 'Nombre: debe empezar en mayúscula y tener al menos 4 letras');
        const emailValido = validarCampo(emailInput, emailRegex, 'Email: formato inválido');
        const passValido = validarCampo(passInput, passRegex, 'Contraseña: debe ser alfanumérica y tener al menos 4 caracteres');
        const direccionValida = validarCampo(direccionInput, direccionRegex, 'Dirección: debe ser "Calle", "Avenida", "Camino" o "Carretera", seguido de un nombre con la primera letra en mayúscula y al menos 2 números');
        const telefonoValido = validarCampo(telefonoInput, telefonoRegex, 'Teléfono: debe tener al menos nueve números');


        if (!nombreValido || !emailValido || !passValido || !direccionValida || !telefonoValido) {
            event.preventDefault();
        }
    });
}


