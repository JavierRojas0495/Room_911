# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libonig-dev libxml2-dev libpq-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
COPY . .

# Eliminar vendor si existe (por si acaso)
RUN rm -rf vendor

# Crear archivo .env básico si no existe
RUN if [ ! -f .env ]; then \
    echo "APP_NAME=\"Room 911\"" > .env && \
    echo "APP_ENV=local" >> .env && \
    echo "APP_KEY=" >> .env && \
    echo "APP_DEBUG=true" >> .env && \
    echo "APP_URL=http://localhost" >> .env && \
    echo "LOG_CHANNEL=stack" >> .env && \
    echo "LOG_LEVEL=debug" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_HOST=127.0.0.1" >> .env && \
    echo "DB_PORT=5432" >> .env && \
    echo "DB_DATABASE=room_911" >> .env && \
    echo "DB_USERNAME=postgres" >> .env && \
    echo "DB_PASSWORD=" >> .env && \
    echo "BROADCAST_DRIVER=log" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "FILESYSTEM_DISK=local" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "SESSION_LIFETIME=120" >> .env && \
    echo "MAIL_MAILER=smtp" >> .env && \
    echo "MAIL_HOST=mailpit" >> .env && \
    echo "MAIL_PORT=1025" >> .env && \
    echo "MAIL_USERNAME=null" >> .env && \
    echo "MAIL_PASSWORD=null" >> .env && \
    echo "MAIL_ENCRYPTION=null" >> .env && \
    echo "MAIL_FROM_ADDRESS=\"hello@example.com\"" >> .env && \
    echo "MAIL_FROM_NAME=\"\${APP_NAME}\"" >> .env; \
fi

# Cambiar DocumentRoot a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Asignar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Laravel (ignorando requisitos de plataforma)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Copiar y dar permisos al script de entrada
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Exponer el puerto 80
EXPOSE 80

# Comprobación de salud (opcional)
HEALTHCHECK --interval=10s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost || exit 1

# Comando de inicio
CMD ["docker-entrypoint.sh"]
