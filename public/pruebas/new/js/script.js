document.addEventListener('DOMContentLoaded', function () {
    var btnHamburger = document.querySelector('.btn-hamburger');
    var navbar = document.querySelector('.navbar');
    var userDropdown = document.getElementById('user-dropdown');

    btnHamburger.addEventListener('click', function () {
        navbar.classList.toggle('navbar-open');
    });

    // Agrega un controlador de eventos para el desplegable del usuario
    var userTrigger = document.querySelector('.navbar-user a');
    userTrigger.addEventListener('click', function (e) {
        e.preventDefault(); // Previene la acción predeterminada del enlace
        userDropdown.classList.toggle('active-drop');
    });
});