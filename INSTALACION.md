# 🚀 Guía de Instalación Paso a Paso

## Paso 1: Instalar XAMPP

1. **Descargar XAMPP**
   - Ve a: https://www.apachefriends.org/
   - Descarga la versión para Windows
   - Ejecuta el instalador

2. **Instalar XAMPP**
   - Instala en: `C:\xampp`
   - Asegúrate de seleccionar: Apache, MySQL, PHP, phpMyAdmin

3. **Iniciar XAMPP**
   - Abre "XAMPP Control Panel"
   - Haz clic en "Start" para Apache
   - Haz clic en "Start" para MySQL
   - Ambos deben aparecer en verde

## Paso 2: Copiar los archivos

1. **Ubicación de archivos**
   - Copia toda la carpeta del proyecto a: `C:\xampp\htdocs\`
   - La ruta final debe ser: `C:\xampp\htdocs\El-Mundo-micol-gico-2024\`

## Paso 3: Crear la Base de Datos

### Opción A: Usando phpMyAdmin (Recomendado)

1. **Abrir phpMyAdmin**
   - Abre tu navegador
   - Ve a: `http://localhost/phpmyadmin`

2. **Crear base de datos**
   - Haz clic en la pestaña "SQL"
   - Copia y pega el contenido completo del archivo `database.sql`
   - Haz clic en "Continuar" o "Go"

3. **Verificar**
   - En el panel izquierdo deberías ver la base de datos `mundo_micologico`
   - Haz clic en ella y verifica que tenga 3 tablas: `setas`, `comentarios`, `mensajes_contacto`

### Opción B: Usando línea de comandos

```bash
cd C:\xampp\mysql\bin
mysql.exe -u root -p
```

Luego ejecuta:
```sql
source C:\xampp\htdocs\El-Mundo-micol-gico-2024\database.sql
```

## Paso 4: Configurar la conexión

1. **Abrir config.php**
   - Abre el archivo `config.php` en tu editor

2. **Verificar las credenciales**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Deja vacío si no tienes contraseña
   define('DB_NAME', 'mundo_micologico');
   ```

3. **Si tienes contraseña en MySQL**
   - Cambia `DB_PASS` por tu contraseña

## Paso 5: Probar el sitio

1. **Abrir en el navegador**
   ```
   http://localhost/El-Mundo-micol-gico-2024/index.php
   ```

2. **Verificar que funcione**
   - Deberías ver la página principal con estadísticas
   - Prueba la búsqueda
   - Prueba ver detalles de una seta
   - Prueba dejar un comentario

## 🔧 Solución de problemas comunes

### Error: "Access denied for user 'root'@'localhost'"
**Solución:** La contraseña de MySQL es incorrecta
- Si es una instalación nueva de XAMPP, la contraseña debería estar vacía (`''`)
- Verifica en phpMyAdmin si puedes entrar sin contraseña

### Error: "Unknown database 'mundo_micologico'"
**Solución:** La base de datos no se creó correctamente
- Ve a phpMyAdmin
- Verifica si existe la base de datos
- Si no existe, ejecuta el archivo `database.sql` nuevamente

### Error: "Call to undefined function mysql_connect()"
**Solución:** Estás usando una versión antigua de PHP
- El código usa PDO, asegúrate de tener PHP 7.4+
- En XAMPP reciente esto no debería ser problema

### Error: "SQLSTATE[HY000] [2002] No connection could be made"
**Solución:** MySQL no está corriendo
- Abre XAMPP Control Panel
- Inicia MySQL
- Espera a que aparezca en verde

### Página en blanco
**Solución:** Hay un error de PHP que no se muestra
1. Abre `config.php`
2. Agrega al inicio (después de `<?php`):
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
3. Refresca la página y verás el error

### No aparecen las imágenes
**Solución:** Las rutas de imágenes están incorrectas
- Asegúrate de que la carpeta `imagenes/` existe
- Las imágenes en la base de datos tienen rutas relativas

## ✅ Checklist de verificación

- [ ] XAMPP instalado
- [ ] Apache iniciado (verde en XAMPP)
- [ ] MySQL iniciado (verde en XAMPP)
- [ ] Archivos copiados a `C:\xampp\htdocs\`
- [ ] Base de datos creada en phpMyAdmin
- [ ] Tabla `setas` tiene 8 registros
- [ ] `config.php` configurado correctamente
- [ ] Sitio accesible en `http://localhost/El-Mundo-micol-gico-2024/index.php`

## 🎯 Siguiente paso

Una vez que todo funcione, puedes:
1. Agregar más especies de setas a la base de datos
2. Subir imágenes reales a la carpeta `imagenes/`
3. Personalizar los estilos en `styles.css`
4. Agregar más funcionalidades

## 📞 ¿Necesitas ayuda?

Si encuentras algún problema, verifica:
1. Los logs de error de Apache en: `C:\xampp\apache\logs\error.log`
2. Los logs de PHP en: `C:\xampp\php\logs\php_error_log`

¡Disfruta tu sitio web sobre setas! 🍄
