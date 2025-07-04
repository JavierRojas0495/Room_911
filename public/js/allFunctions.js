// Función para ajustar la altura del contenido principal (si es necesario)
function adjustMainContentHeight() {
    const mainContent = document.querySelector('.main-content');
    const navbar = document.querySelector('.navbar');
    const footer = document.getElementById('footer');
    if (mainContent && navbar && footer) {
        const windowHeight = window.innerHeight;
        const navbarHeight = navbar.offsetHeight;
        const footerHeight = footer.offsetHeight;
        const mainContentHeight = windowHeight - navbarHeight - footerHeight;
        mainContent.style.minHeight = mainContentHeight + 'px';
    }
}

// Función para manejar el sidebar responsive
function initSidebarResponsive() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openBtn = document.getElementById('sidebarOpenBtn');
    const closeBtn = document.getElementById('sidebarCloseBtn');

    if (openBtn && sidebar) {
        openBtn.addEventListener('click', function() {
            sidebar.classList.add('show');
            if (overlay) overlay.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevenir scroll del body
        });
    }

    if (closeBtn && sidebar && overlay) {
        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.style.display = 'none';
            document.body.style.overflow = ''; // Restaurar scroll del body
        });
    }

    if (overlay && sidebar) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        });
    }

    // Cierra el sidebar al hacer click en un enlace (solo móvil)
    if (sidebar) {
        const navLinks = sidebar.querySelectorAll('a.nav-link, a.sidebar-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('show');
                    if (overlay) overlay.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        });
    }

    // Cerrar sidebar al cambiar tamaño de ventana
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && sidebar) {
            sidebar.classList.remove('show');
            if (overlay) overlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
}

// Función para mejorar la experiencia en móvil
function initMobileEnhancements() {
    // Prevenir zoom en inputs en iOS
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="number"], textarea');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            if (window.innerWidth <= 768) {
                // Pequeño delay para asegurar que el input esté enfocado
                setTimeout(function() {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        });
    });

    // Mejorar la experiencia de las tablas en móvil
    const tables = document.querySelectorAll('.table-responsive');
    tables.forEach(function(table) {
        if (window.innerWidth <= 768) {
            table.style.fontSize = '0.8rem';
        }
    });

    // Ajustar botones en móvil
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(function(button) {
        if (window.innerWidth <= 575) {
            button.style.minHeight = '44px'; // Tamaño mínimo para touch
        }
    });
}

// Función para manejar la orientación del dispositivo
function handleOrientationChange() {
    const isLandscape = window.innerWidth > window.innerHeight;
    const isMobile = window.innerWidth <= 768;

    if (isMobile && isLandscape) {
        // Ajustes específicos para móvil en landscape
        document.body.classList.add('mobile-landscape');
    } else {
        document.body.classList.remove('mobile-landscape');
    }
}

// Función para mejorar la accesibilidad
function initAccessibility() {
    // Agregar atributos ARIA a elementos dinámicos
    const sidebarToggle = document.getElementById('sidebarOpenBtn');
    if (sidebarToggle) {
        sidebarToggle.setAttribute('aria-label', 'Abrir menú de navegación');
        sidebarToggle.setAttribute('aria-expanded', 'false');
    }

    // Mejorar navegación por teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                if (overlay) overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
    });
}

// Función para optimizar el rendimiento
function initPerformanceOptimizations() {
    // Lazy loading para imágenes (si las hay)
    const images = document.querySelectorAll('img[data-src]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    // Debounce para eventos de resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            adjustMainContentHeight();
            handleOrientationChange();
            initMobileEnhancements();
        }, 250);
    });
}

// Función para inicializar todo cuando el DOM esté listo
function initApp() {
    adjustMainContentHeight();
    initSidebarResponsive();
    initMobileEnhancements();
    handleOrientationChange();
    initAccessibility();
    initPerformanceOptimizations();
}

// Event listeners
window.addEventListener('resize', adjustMainContentHeight);
window.addEventListener('orientationchange', handleOrientationChange);

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}

// Exportar funciones para uso global si es necesario
window.Room911App = {
    adjustMainContentHeight,
    initSidebarResponsive,
    initMobileEnhancements,
    handleOrientationChange,
    initAccessibility,
    initPerformanceOptimizations
};
