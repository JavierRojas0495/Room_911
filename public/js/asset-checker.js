// Script de verificación de assets
console.log('🔍 Verificando carga de assets...');

// Verificar CSS
const cssFiles = [
    'css/app.css',
    'css/login.css',
    'css/mobile.css',
    'css/styles.css'
];

cssFiles.forEach(file => {
    const link = document.querySelector(`link[href*="${file}"]`);
    if (link) {
        console.log(`✅ CSS cargado: ${file}`);
    } else {
        console.error(`❌ CSS no encontrado: ${file}`);
    }
});

// Verificar JS
const jsFiles = [
    'js/app.js',
    'js/allFunctions.js'
];

jsFiles.forEach(file => {
    const script = document.querySelector(`script[src*="${file}"]`);
    if (script) {
        console.log(`✅ JS cargado: ${file}`);
    } else {
        console.error(`❌ JS no encontrado: ${file}`);
    }
});

// Verificar si las funciones principales están disponibles
setTimeout(() => {
    if (typeof initSidebarResponsive === 'function') {
        console.log('✅ Función initSidebarResponsive disponible');
    } else {
        console.error('❌ Función initSidebarResponsive no disponible');
    }

    if (typeof initApp === 'function') {
        console.log('✅ Función initApp disponible');
    } else {
        console.error('❌ Función initApp no disponible');
    }
}, 1000);

console.log('🔍 Verificación de assets completada');
