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
window.addEventListener('resize', adjustMainContentHeight);
adjustMainContentHeight();
