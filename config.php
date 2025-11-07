<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mundo_micologico');

// Configuración del sitio
define('SITE_NAME', 'El Mundo Micológico y su Mitología');
define('SITE_URL', 'http://localhost/');

// Iniciar sesión
session_start();

// Función para conectar a la base de datos
function getDBConnection() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    } catch(PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Función para sanitizar datos de entrada
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
