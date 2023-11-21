document.addEventListener('DOMContentLoaded', function () {
    let btnHamburger = document.querySelector('.btn-hamburger');
    let navbar = document.querySelector('.navbar');
    let userDropdown = document.getElementById('user-dropdown');

    btnHamburger.addEventListener('click', function () {
        navbar.classList.toggle('navbar-open');
    });

    // Agrega un controlador de eventos para el desplegable del usuario
    let userTrigger = document.querySelector('.navbar-user a');
    if (userTrigger == null) {
        return;
    }
    userTrigger.addEventListener('click', function (e) {
        e.preventDefault(); // Previene la acción predeterminada del enlace
        userDropdown.classList.toggle('active-drop');
    });
});