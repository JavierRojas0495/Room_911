#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "📝 Creando archivo .env mínimo solo para APP_KEY..."
echo "APP_KEY=" > .env

echo "🔧 Generando APP_KEY..."
php artisan key:generate --force
echo "🔍 Verificando APP_KEY..."
php artisan tinker --execute="echo 'APP_KEY: ' . config('app.key') . PHP_EOL;" || echo "⚠️ Error al verificar APP_KEY"

echo "🔍 Verificando variables de entorno..."
php artisan tinker --execute="echo 'APP_NAME: ' . env('APP_NAME') . PHP_EOL; echo 'DB_HOST: ' . env('DB_HOST') . PHP_EOL; echo 'APP_URL: ' . env('APP_URL') . PHP_EOL;" || echo "⚠️ Error al verificar variables"

echo "⚙️ Limpiando configuración..."
php artisan config:clear

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
