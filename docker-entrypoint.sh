#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "🔍 Verificando APP_KEY..."
php artisan tinker --execute="echo 'APP_KEY: ' . config('app.key') . PHP_EOL;" || echo "⚠️ Error al verificar APP_KEY"

echo "🔍 Verificando variables de entorno..."
php artisan tinker --execute="echo 'APP_NAME: ' . env('APP_NAME') . PHP_EOL; echo 'DB_HOST: ' . env('DB_HOST') . PHP_EOL; echo 'APP_URL: ' . env('APP_URL') . PHP_EOL;" || echo "⚠️ Error al verificar variables"

echo "📦 Ejecutando migraciones..."
php artisan migrate --force || echo "⚠️ Error en migraciones"

echo "🌱 Ejecutando seeders..."
php artisan db:seed --force || echo "⚠️ Error en seeders"

echo "⚙️ Limpiando configuración y cachés de Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Opcional: puedes agregar php artisan config:cache si quieres cachear después de limpiar
# php artisan config:cache

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
