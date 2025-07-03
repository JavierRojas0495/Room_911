#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "📝 Creando archivo .env mínimo..."
echo "APP_NAME=\"Room 911\"" > .env
echo "APP_ENV=production" >> .env
echo "APP_DEBUG=false" >> .env
echo "APP_URL=https://inventory-api-1u4p.onrender.com" >> .env
echo "LOG_CHANNEL=stack" >> .env
echo "LOG_LEVEL=error" >> .env
echo "DB_CONNECTION=pgsql" >> .env
echo "DB_HOST=dpg-d1jeur6uk2gs7396lv9g-a.oregon-postgres.render.com" >> .env
echo "DB_PORT=5432" >> .env
echo "DB_DATABASE=room_911_db" >> .env
echo "DB_USERNAME=root" >> .env
echo "DB_PASSWORD=NzVnrU3wnsb4WIKpJGEPuVaCgFpZ7T9D" >> .env
echo "BROADCAST_DRIVER=log" >> .env
echo "CACHE_DRIVER=file" >> .env
echo "FILESYSTEM_DISK=local" >> .env
echo "QUEUE_CONNECTION=sync" >> .env
echo "SESSION_DRIVER=file" >> .env
echo "SESSION_LIFETIME=120" >> .env

echo "🔧 Generando APP_KEY..."
php artisan key:generate --force
echo "🔍 Verificando APP_KEY..."
php artisan tinker --execute="echo 'APP_KEY: ' . config('app.key') . PHP_EOL;" || echo "⚠️ Error al verificar APP_KEY"

echo "⚙️ Limpiando configuración..."
php artisan config:clear

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
