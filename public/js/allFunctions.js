$(document).ready(function(){
    console.log("Document ready");

    // Alternar la barra lateral y los iconos de los módulos
    $('.sidebar-toggle-btn').on('click', function(){
        console.log("Toggle button clicked");
        $('.sidebar').toggleClass('sidebar-collapse'); // Alternar clase para contraer/expandir la barra lateral
        console.log("Sidebar class toggled");
        $('.modules-list').toggleClass('module-icons-only'); // Alternar clase para mostrar solo iconos de los módulos cuando la barra está contraída
        console.log("Modules list class toggled");

        // Cambiar el icono del botón de alternancia
        var icon = $(this).find('i');
        icon.toggleClass('fa-chevron-left fa-chevron-right');
        console.log("Icon class toggled");
    });

    // Mostrar/ocultar el footer según el desplazamiento
    window.addEventListener('scroll', function() {
        var footer = document.getElementById('footer');
        var distanceToBottom = document.body.scrollHeight - (window.pageYOffset + window.innerHeight);
        if (distanceToBottom < 200) {
            footer.style.bottom = '0'; // Mostrar el footer
        } else {
            footer.style.bottom = '-100px'; // Ocultar el footer
        }
    });

    // Mostrar/ocultar el navbar según el desplazamiento
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        var distanceToTop = window.scrollY;

        if (distanceToTop > 100) {
            navbar.classList.add('navbar-hide'); // Ocultar el navbar cuando se desplaza hacia abajo
        } else {
            navbar.classList.remove('navbar-hide'); // Mostrar el navbar cuando se está cerca del tope
        }
    });

    // Función adicional para ajustar la visibilidad de los botones de acción cuando la pantalla cambia de tamaño
    $(window).on('resize', function(){
        var windowWidth = $(window).width();
        if(windowWidth < 768){
            $('.action-buttons').hide(); // Ocultar botones de acción en pantallas pequeñas
        } else {
            $('.action-buttons').show(); // Mostrar botones de acción en pantallas grandes
        }
    });

    
    // Actualizar la altura del contenido principal para ajustarse al tamaño de la ventana
    function adjustMainContentHeight() {
        var windowHeight = $(window).height();
        var navbarHeight = $('.navbar').outerHeight();
        var footerHeight = $('#footer').outerHeight();
        var mainContentHeight = windowHeight - navbarHeight - footerHeight;

        $('.main-content').css('min-height', mainContentHeight + 'px');
    }

    // Llamar a la función de ajuste de altura en el evento de redimensionamiento
    $(window).on('resize', function() {
        adjustMainContentHeight();
    });

    // Llamar a la función de ajuste de altura al cargar la página
    adjustMainContentHeight();
});

// JavaScript para manejar el colapso del sidebar
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container-fluid');
    const navbar = document.querySelector('.navbar');
    const footer = document.querySelector('.footer');

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-collapse');
        container.classList.toggle('sidebar-collapse');
        navbar.classList.toggle('sidebar-collapse');
        footer.classList.toggle('sidebar-collapse');
    });
});
