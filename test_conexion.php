<?php
/**
 * Script de prueba de conexión a la base de datos
 * Ejecuta este archivo para verificar que la conexión funciona
 * URL: http://localhost/El-Mundo-micol-gico-2024/test_conexion.php
 */

echo "<h1>🍄 Test de Conexión - El Mundo Micológico</h1>";
echo "<hr>";

// 1. Verificar versión de PHP
echo "<h2>1. Versión de PHP</h2>";
echo "Versión actual: <strong>" . phpversion() . "</strong><br>";
if (version_compare(phpversion(), '7.4.0', '>=')) {
    echo "✅ <span style='color:green'>PHP versión correcta (7.4 o superior)</span><br>";
} else {
    echo "❌ <span style='color:red'>PHP versión muy antigua. Se requiere 7.4+</span><br>";
}
echo "<hr>";

// 2. Verificar extensión PDO
echo "<h2>2. Extensión PDO</h2>";
if (extension_loaded('pdo')) {
    echo "✅ <span style='color:green'>PDO está instalado</span><br>";
    if (extension_loaded('pdo_mysql')) {
        echo "✅ <span style='color:green'>PDO MySQL está instalado</span><br>";
    } else {
        echo "❌ <span style='color:red'>PDO MySQL NO está instalado</span><br>";
    }
} else {
    echo "❌ <span style='color:red'>PDO NO está instalado</span><br>";
}
echo "<hr>";

// 3. Verificar archivo config.php
echo "<h2>3. Archivo de configuración</h2>";
if (file_exists('config.php')) {
    echo "✅ <span style='color:green'>config.php existe</span><br>";
    require_once 'config.php';
    echo "Host: " . DB_HOST . "<br>";
    echo "Usuario: " . DB_USER . "<br>";
    echo "Base de datos: " . DB_NAME . "<br>";
} else {
    echo "❌ <span style='color:red'>config.php NO existe</span><br>";
    die();
}
echo "<hr>";

// 4. Probar conexión a MySQL
echo "<h2>4. Conexión a MySQL</h2>";
try {
    $dsn = "mysql:host=" . DB_HOST;
    $conn = new PDO($dsn, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ <span style='color:green'>Conexión a MySQL exitosa</span><br>";
    
    // Verificar si existe la base de datos
    echo "<h3>4.1. Verificar base de datos</h3>";
    $stmt = $conn->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    if ($stmt->rowCount() > 0) {
        echo "✅ <span style='color:green'>Base de datos '" . DB_NAME . "' existe</span><br>";
        
        // Conectar a la base de datos específica
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("SET NAMES 'utf8'");
        
        // Verificar tablas
        echo "<h3>4.2. Verificar tablas</h3>";
        $stmt = $conn->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "✅ <span style='color:green'>Tablas encontradas: " . count($tables) . "</span><br>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>" . $table;
                
                // Contar registros
                $stmt = $conn->query("SELECT COUNT(*) as total FROM " . $table);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo " (" . $result['total'] . " registros)";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "⚠️ <span style='color:orange'>No hay tablas en la base de datos</span><br>";
            echo "<p><strong>Acción requerida:</strong> Importa el archivo database.sql</p>";
        }
        
        // Probar consulta
        echo "<h3>4.3. Consulta de prueba</h3>";
        $stmt = $conn->query("SELECT * FROM setas LIMIT 3");
        $setas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($setas) > 0) {
            echo "✅ <span style='color:green'>Consulta exitosa. Ejemplos de setas:</span><br>";
            echo "<table border='1' cellpadding='5' style='margin-top:10px;'>";
            echo "<tr><th>ID</th><th>Nombre Científico</th><th>Nombre Común</th><th>Comestible</th></tr>";
            foreach ($setas as $seta) {
                echo "<tr>";
                echo "<td>" . $seta['id'] . "</td>";
                echo "<td>" . htmlspecialchars($seta['nombre_cientifico']) . "</td>";
                echo "<td>" . htmlspecialchars($seta['nombre_comun']) . "</td>";
                echo "<td>" . $seta['comestible'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "⚠️ <span style='color:orange'>No hay datos en la tabla setas</span><br>";
        }
        
    } else {
        echo "❌ <span style='color:red'>Base de datos '" . DB_NAME . "' NO existe</span><br>";
        echo "<p><strong>Acción requerida:</strong></p>";
        echo "<ol>";
        echo "<li>Ve a <a href='http://localhost/phpmyadmin' target='_blank'>phpMyAdmin</a></li>";
        echo "<li>Haz clic en la pestaña 'SQL'</li>";
        echo "<li>Copia y pega el contenido del archivo database.sql</li>";
        echo "<li>Haz clic en 'Continuar'</li>";
        echo "</ol>";
    }
    
} catch(PDOException $e) {
    echo "❌ <span style='color:red'>Error de conexión: " . $e->getMessage() . "</span><br>";
    echo "<p><strong>Posibles causas:</strong></p>";
    echo "<ul>";
    echo "<li>MySQL no está corriendo en XAMPP</li>";
    echo "<li>Usuario o contraseña incorrectos en config.php</li>";
    echo "<li>Puerto MySQL ocupado (verifica que sea 3306)</li>";
    echo "</ul>";
}
echo "<hr>";

// 5. Verificar archivos necesarios
echo "<h2>5. Verificar archivos del proyecto</h2>";
$archivos_necesarios = [
    'config.php',
    'functions.php',
    'index.php',
    'catalogo.php',
    'buscar.php',
    'detalle.php',
    'contacto.php',
    'database.sql',
    'styles.css'
];

$todos_existen = true;
foreach ($archivos_necesarios as $archivo) {
    if (file_exists($archivo)) {
        echo "✅ <span style='color:green'>" . $archivo . "</span><br>";
    } else {
        echo "❌ <span style='color:red'>" . $archivo . " NO existe</span><br>";
        $todos_existen = false;
    }
}
echo "<hr>";

// 6. Verificar carpetas
echo "<h2>6. Verificar carpetas</h2>";
if (is_dir('imagenes')) {
    echo "✅ <span style='color:green'>Carpeta 'imagenes/' existe</span><br>";
} else {
    echo "⚠️ <span style='color:orange'>Carpeta 'imagenes/' NO existe (crear si necesitas imágenes)</span><br>";
}
echo "<hr>";

// Resultado final
echo "<h2>📊 Resultado Final</h2>";
if ($todos_existen && isset($conn)) {
    echo "<div style='background-color:#d4edda; padding:20px; border-radius:5px; border:1px solid #c3e6cb;'>";
    echo "<h3 style='color:#155724; margin:0;'>✅ ¡Todo configurado correctamente!</h3>";
    echo "<p style='margin:10px 0 0 0;'>Puedes acceder al sitio en: <a href='index.php'><strong>index.php</strong></a></p>";
    echo "</div>";
} else {
    echo "<div style='background-color:#f8d7da; padding:20px; border-radius:5px; border:1px solid #f5c6cb;'>";
    echo "<h3 style='color:#721c24; margin:0;'>⚠️ Hay problemas de configuración</h3>";
    echo "<p style='margin:10px 0 0 0;'>Revisa los errores arriba y sigue las instrucciones.</p>";
    echo "</div>";
}

echo "<hr>";
echo "<p><small>Archivo: test_conexion.php | " . date('Y-m-d H:i:s') . "</small></p>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f5f5f5;
}
h1 {
    color: #2c5f2d;
}
h2 {
    color: #4a4a4a;
    background-color: #e8f5e9;
    padding: 10px;
    border-left: 4px solid #2c5f2d;
}
h3 {
    color: #666;
    margin-top: 15px;
}
hr {
    border: none;
    border-top: 2px solid #ddd;
    margin: 20px 0;
}
table {
    background-color: white;
    border-collapse: collapse;
}
table th {
    background-color: #2c5f2d;
    color: white;
    padding: 8px;
}
table td {
    padding: 8px;
}
</style>
