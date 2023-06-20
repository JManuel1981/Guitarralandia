const avatar = document.getElementById('avatar');

if (avatar !== null) {
    
    avatar.addEventListener('click', () => {
        
        Swal.fire({
            title: 'Inicio de sesión',
            text: 'No has iniciado sesión. Por favor, dirígete al login.',
            icon: 'info',
            showCancelButton: false,
        });
    });
}
