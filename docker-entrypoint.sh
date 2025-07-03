#!/bin/bash
set -e

echo "🔧 Ajustando permisos..."
chown -R www-data:www-data storage bootstrap/cache

echo "🔧 Generando APP_KEY si no existe..."
php artisan key:generate --force || echo "⚠️ APP_KEY ya existe"

echo "⚙️ Limpiando configuración..."
php artisan config:clear

echo "📋 Verificando logs de error..."
tail -n 10 storage/logs/laravel.log 2>/dev/null || echo "⚠️ No hay logs disponibles"

echo "🚀 Iniciando Apache..."
exec apache2-foreground
