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

# Instalar Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copiar archivos del proyecto
COPY . .

# Eliminar vendor si existe (por si acaso)
RUN rm -rf vendor

# No crear archivo .env - Render manejará las variables de entorno

# Cambiar DocumentRoot a /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Asignar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Laravel (ignorando requisitos de plataforma)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Instalar dependencias de npm y compilar assets
RUN npm install --legacy-peer-deps && npm run build

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
