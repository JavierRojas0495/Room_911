// Script de verificación de assets mejorado
console.log('🔍 Iniciando verificación de assets...');

// Función para verificar si un archivo se carga correctamente
function checkAsset(url, type) {
    return new Promise((resolve) => {
        const element = type === 'css' ? document.createElement('link') : document.createElement('script');

        if (type === 'css') {
            element.rel = 'stylesheet';
            element.href = url;
        } else {
            element.src = url;
        }

        element.onload = () => {
            console.log(`✅ ${type.toUpperCase()} cargado exitosamente: ${url}`);
            resolve({ success: true, url });
        };

        element.onerror = () => {
            console.error(`❌ Error cargando ${type.toUpperCase()}: ${url}`);
            resolve({ success: false, url });
        };

        // Timeout después de 5 segundos
        setTimeout(() => {
            console.error(`⏰ Timeout cargando ${type.toUpperCase()}: ${url}`);
            resolve({ success: false, url, timeout: true });
        }, 5000);

        document.head.appendChild(element);
    });
}

// Verificar todos los assets
async function verifyAllAssets() {
    const assets = [
        { url: '/assets/css/app.css', type: 'css' },
        { url: '/assets/css/login.css', type: 'css' },
        { url: '/assets/css/mobile.css', type: 'css' },
        { url: '/assets/css/styles.css', type: 'css' },
        { url: '/assets/js/app.js', type: 'js' },
        { url: '/assets/js/allFunctions.js', type: 'js' },
        { url: '/assets/js/asset-checker.js', type: 'js' }
    ];

    console.log('📋 Verificando assets...');

    const results = [];
    for (const asset of assets) {
        const result = await checkAsset(asset.url, asset.type);
        results.push(result);
    }

    // Resumen final
    const successful = results.filter(r => r.success).length;
    const failed = results.filter(r => !r.success).length;

    console.log(`📊 Resumen: ${successful} exitosos, ${failed} fallidos`);

    if (failed > 0) {
        console.error('❌ Assets con problemas:');
        results.filter(r => !r.success).forEach(r => {
            console.error(`   - ${r.url}`);
        });

        // Sugerir verificación manual
        console.log('💡 Sugerencias:');
        console.log('   1. Verifica la consola de red (F12 > Network)');
        console.log('   2. Prueba acceder directamente a las URLs');
        console.log('   3. Verifica que el AssetController esté funcionando');
    } else {
        console.log('🎉 ¡Todos los assets se cargaron correctamente!');
    }
}

// Verificar funciones disponibles
function checkFunctions() {
    console.log('🔧 Verificando funciones disponibles...');

    const functions = [
        'initSidebarResponsive',
        'initApp',
        'adjustMainContentHeight',
        'initMobileEnhancements'
    ];

    functions.forEach(funcName => {
        if (typeof window[funcName] === 'function') {
            console.log(`✅ Función disponible: ${funcName}`);
        } else {
            console.error(`❌ Función no disponible: ${funcName}`);
        }
    });
}

// Ejecutar verificaciones
setTimeout(() => {
    verifyAllAssets();
    setTimeout(checkFunctions, 2000);
}, 1000);

console.log('🔍 Verificación de assets iniciada');
