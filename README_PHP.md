# El Mundo Micológico - Versión PHP

## 🍄 Descripción

Sitio web dinámico sobre el mundo micológico desarrollado con PHP y MySQL. Incluye un catálogo completo de especies de setas, sistema de búsqueda avanzado, comentarios y formulario de contacto.

## 📋 Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Extensión PDO de PHP habilitada

## 🚀 Instalación

### 1. Configurar el servidor

Si usas XAMPP o WAMP:
- Copia los archivos al directorio `htdocs` o `www`
- Inicia Apache y MySQL desde el panel de control

### 2. Crear la base de datos

1. Abre phpMyAdmin (http://localhost/phpmyadmin)
2. Importa el archivo `database.sql` o ejecuta el contenido manualmente
3. Esto creará la base de datos `mundo_micologico` con todas las tablas y datos de ejemplo

### 3. Configurar la conexión

Edita el archivo `config.php` y ajusta las credenciales si es necesario:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mundo_micologico');
```

### 4. Acceder al sitio

Abre tu navegador y visita:
```
http://localhost/El-Mundo-micol-gico-2024/index.php
```

## 📁 Estructura de archivos

```
├── config.php          # Configuración de base de datos
├── database.sql        # Script SQL para crear la base de datos
├── functions.php       # Funciones auxiliares
├── index.php          # Página principal
├── catalogo.php       # Catálogo completo de setas
├── buscar.php         # Búsqueda avanzada
├── detalle.php        # Detalles de cada seta
├── contacto.php       # Formulario de contacto
├── styles.css         # Estilos CSS
└── imagenes/          # Carpeta de imágenes
```

## 🎯 Características

### 1. Catálogo de Setas
- Listado completo de especies
- Información detallada de cada seta
- Clasificación por comestibilidad

### 2. Búsqueda Avanzada
- Filtro por nombre científico o común
- Filtro por color
- Filtro por tipo de comestibilidad
- Filtro por características físicas (láminas, sombrero, anillo)

### 3. Sistema de Comentarios
- Los usuarios pueden dejar comentarios en cada especie
- Almacenamiento en base de datos

### 4. Formulario de Contacto
- Envío de mensajes
- Almacenamiento en base de datos

### 5. Estadísticas
- Total de especies registradas
- Contador de especies comestibles
- Contador de especies tóxicas
- Contador de visitas diarias

## 📊 Base de Datos

### Tablas principales

1. **setas**: Información de cada especie
2. **comentarios**: Comentarios de usuarios
3. **mensajes_contacto**: Mensajes del formulario de contacto

## 🔧 Funciones principales

### functions.php

- `getAllSetas()`: Obtiene todas las setas
- `buscarSetas($filtros)`: Búsqueda con filtros múltiples
- `getSetaById($id)`: Obtiene una seta específica
- `guardarComentario()`: Guarda comentarios de usuarios
- `guardarMensajeContacto()`: Guarda mensajes de contacto
- `getTotalSetas()`: Estadísticas de especies
- `registrarVisita()`: Contador de visitas

## 🎨 Personalización

### Cambiar colores y estilos
Edita el archivo `styles.css`

### Añadir más especies
Puedes agregar especies directamente desde phpMyAdmin o crear un formulario de administración.

### Configurar email
Para recibir emails reales del formulario de contacto, necesitas configurar un servicio SMTP en PHP.

## 🔒 Seguridad

- Sanitización de datos de entrada
- Uso de prepared statements (PDO)
- Validación de email
- Protección contra SQL injection

## 📝 Notas

- Las imágenes deben estar en la carpeta `imagenes/`
- El contador de visitas se guarda en `visitas.txt`
- Los datos de ejemplo incluyen 8 especies populares

## 🐛 Solución de problemas

### Error de conexión a base de datos
- Verifica que MySQL esté corriendo
- Comprueba las credenciales en `config.php`
- Asegúrate de que la base de datos existe

### Página en blanco
- Activa los errores de PHP: `error_reporting(E_ALL);`
- Revisa los logs de Apache

### No se ven las imágenes
- Verifica que la carpeta `imagenes/` existe
- Comprueba las rutas de las imágenes en la base de datos

## 👨‍💻 Autor

J.L Rózpide

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.
