# 🏢 Room 911 - Sistema de Gestión de Empleados

Sistema web desarrollado en **Laravel 11** para la gestión integral de empleados, incluyendo autenticación, registro de accesos, generación de reportes PDF y administración de usuarios.

## 📋 Características Principales

### 🔐 **Autenticación y Seguridad**
- Sistema de login dual (empleados y usuarios administrativos)
- Registro detallado de intentos de acceso
- Control de estados activo/inactivo
- Middleware de autenticación

### 👥 **Gestión de Empleados**
- CRUD completo de empleados
- Importación masiva desde archivos CSV
- Filtros avanzados por departamento, estado y búsqueda
- Historial de accesos por empleado
- Generación de reportes PDF

### 📊 **Reportes y Analytics**
- Historial detallado de accesos
- Reportes PDF personalizados
- Estadísticas de intentos de login
- Filtros por fecha y tipo de usuario

### 🎨 **Interfaz de Usuario**
- Diseño responsive y moderno
- Interfaz intuitiva en español
- Componentes modales para mejor UX
- Validaciones en tiempo real

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 11.45.1
- **Frontend**: Blade Templates, Vite 7.0
- **Base de Datos**: PostgreSQL
- **PDF**: DomPDF 2.0
- **Despliegue**: Render.com
- **Contenedor**: Docker con PHP 8.2

## 📋 Requisitos del Sistema

### **Para Desarrollo Local**
- PHP 8.2 o superior
- Composer 2.0+
- Node.js 20+
- PostgreSQL 12+
- Git

### **Extensiones PHP Requeridas**
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- GD PHP Extension
- ZIP PHP Extension

## 🚀 Instalación y Configuración

### **1. Clonar el Repositorio**
```bash
git clone https://github.com/tu-usuario/room-911.git
cd room-911
```

### **2. Instalar Dependencias**
```bash
# Instalar dependencias de PHP
composer install --ignore-platform-reqs

# Instalar dependencias de Node.js
npm install --legacy-peer-deps
```

### **3. Configurar Variables de Entorno**
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### **4. Configurar Base de Datos**
Editar el archivo `.env` con tus credenciales de PostgreSQL:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=room_911_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### **5. Ejecutar Migraciones y Seeders**
```bash
# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders (opcional)
php artisan db:seed
```

### **6. Compilar Assets**
```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

### **7. Configurar Permisos**
```bash
# Dar permisos a directorios de almacenamiento
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### **8. Iniciar Servidor de Desarrollo**
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 🐳 Despliegue con Docker

### **Construir Imagen**
```bash
docker build -t room-911 .
```

### **Ejecutar Contenedor**
```bash
docker run -p 8080:80 room-911
```

## ☁️ Despliegue en Render

El proyecto está configurado para despliegue automático en Render.com:

### **Configuración Automática**
- **Runtime**: Docker
- **Build Command**: Automático desde Dockerfile
- **Start Command**: Automático desde Dockerfile
- **Health Check**: `/`

### **Variables de Entorno Requeridas**
```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=generated_by_render
APP_URL=https://tu-app.onrender.com
DB_CONNECTION=pgsql
DB_HOST=tu-host-postgres
DB_PORT=5432
DB_DATABASE=tu_database
DB_USERNAME=tu_username
DB_PASSWORD=tu_password
```

## 📁 Estructura del Proyecto

```
room-911/
├── app/
│   ├── Http/Controllers/     # Controladores
│   ├── Models/              # Modelos Eloquent
│   └── Providers/           # Service Providers
├── config/                  # Configuraciones
├── database/
│   ├── migrations/          # Migraciones
│   └── seeders/            # Seeders
├── public/                  # Archivos públicos
├── resources/
│   ├── css/                # Estilos
│   ├── js/                 # JavaScript
│   └── views/              # Vistas Blade
├── routes/                  # Definición de rutas
├── storage/                 # Almacenamiento
├── tests/                   # Pruebas
├── Dockerfile              # Configuración Docker
├── docker-entrypoint.sh    # Script de inicio
└── render.yaml             # Configuración Render
```

## 🔧 Comandos Útiles

### **Desarrollo**
```bash
# Limpiar cachés
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Verificar estado
php artisan --version
php artisan route:list

# Ejecutar pruebas
php artisan test
```

### **Base de Datos**
```bash
# Crear migración
php artisan make:migration nombre_migracion

# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Ejecutar seeders
php artisan db:seed
```

### **Assets**
```bash
# Desarrollo con hot reload
npm run dev

# Compilar para producción
npm run build

# Vista previa de build
npm run preview
```

## 🧪 Pruebas

### **Ejecutar Todas las Pruebas**
```bash
php artisan test
```

### **Ejecutar Pruebas Específicas**
```bash
# Pruebas unitarias
php artisan test --testsuite=Unit

# Pruebas de características
php artisan test --testsuite=Feature
```

## 📊 Base de Datos

### **Tablas Principales**
- `employee` - Información de empleados
- `user` - Usuarios administrativos
- `login_logs` - Registro de accesos
- `country` - Países
- `city` - Ciudades
- `departament` - Departamentos

### **Relaciones Principales**
- Empleado → Departamento (belongsTo)
- Empleado → País (belongsTo)
- Empleado → Ciudad (belongsTo)
- Empleado → Login Logs (hasMany)

## 🔒 Seguridad

### **Características de Seguridad**
- Autenticación robusta
- Registro de intentos de acceso
- Validación de datos
- Protección CSRF
- Sanitización de inputs
- Control de estados de cuenta

### **Buenas Prácticas**
- Contraseñas hasheadas con bcrypt
- Validación en frontend y backend
- Logs de auditoría
- Middleware de autenticación

## 🐛 Solución de Problemas

### **Problemas Comunes**

#### **Error: Class "Termwind\Laravel\TermwindServiceProvider" not found**
```bash
composer install --ignore-platform-reqs
php artisan config:clear
```

#### **Error de Permisos en Storage**
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### **Error de Base de Datos**
```bash
php artisan migrate:fresh
php artisan db:seed
```

#### **Assets no se cargan**
```bash
npm install --legacy-peer-deps
npm run build
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

Para soporte técnico o preguntas sobre el proyecto:

- **Email**: soporte@room911.com
- **Documentación**: [Wiki del Proyecto](https://github.com/tu-usuario/room-911/wiki)
- **Issues**: [GitHub Issues](https://github.com/tu-usuario/room-911/issues)

## 🔄 Changelog

### **v2.0.0 - Laravel 11**
- ✅ Actualización a Laravel 11.45.1
- ✅ PHP 8.2+ requerido
- ✅ Vite 7.0 para assets
- ✅ Docker optimizado
- ✅ Mejoras de seguridad
- ✅ Interfaz mejorada

### **v1.0.0 - Versión Inicial**
- ✅ Sistema de autenticación
- ✅ CRUD de empleados
- ✅ Reportes PDF
- ✅ Importación CSV
- ✅ Despliegue en Render

---

**Desarrollado con ❤️ usando Laravel 11**
