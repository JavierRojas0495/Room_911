#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "🔧 Generando APP_KEY si no existe..."
php artisan key:generate --force
echo "🔍 Verificando APP_KEY..."
php artisan tinker --execute="echo 'APP_KEY: ' . config('app.key') . PHP_EOL;" || echo "⚠️ Error al verificar APP_KEY"

echo "⚙️ Limpiando configuración..."
php artisan config:clear

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
