#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "📦 Ejecutando migraciones (si es necesario)..."
php artisan migrate --force || echo "⚠️ Migraciones fallidas o ya ejecutadas"

echo "⚙️ Limpiando y cacheando configuración..."
php artisan config:clear
php artisan config:cache

echo "🔧 Generando APP_KEY si no existe..."
php artisan key:generate --force || echo "⚠️ APP_KEY ya existe"

echo "🔍 Verificando configuración..."
php artisan tinker --execute="echo 'App Name: ' . config('app.name') . PHP_EOL;" || echo "⚠️ Error al verificar configuración"

echo "📝 Limpiando rutas (sin cachear para evitar errores)..."
php artisan route:clear

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
