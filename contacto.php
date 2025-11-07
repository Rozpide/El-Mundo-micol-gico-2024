<?php
require_once 'config.php';
require_once 'functions.php';

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $asunto = $_POST['asunto'] ?? '';
    $mensaje_texto = $_POST['mensaje'] ?? '';
    
    if ($nombre && $email && $asunto && $mensaje_texto) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (guardarMensajeContacto($nombre, $email, $asunto, $mensaje_texto)) {
                $mensaje = '<div class="alert alert-success">¡Mensaje enviado exitosamente! Te responderemos pronto.</div>';
            } else {
                $error = '<div class="alert alert-danger">Error al enviar el mensaje. Inténtalo de nuevo.</div>';
            }
        } else {
            $error = '<div class="alert alert-warning">Por favor ingresa un email válido.</div>';
        }
    } else {
        $error = '<div class="alert alert-warning">Por favor completa todos los campos.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Contacto - <?php echo SITE_NAME; ?></title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">🍄 <?php echo SITE_NAME; ?></a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link active" href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">📧 Contacto</h2>
                
                <?php echo $mensaje . $error; ?>
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="asunto" class="form-label">Asunto *</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje *</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="6" required></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <h4>Información de contacto</h4>
                    <p><strong>Email:</strong> info@mundomicologico.com</p>
                    <p><strong>Autor:</strong> J.L Rózpide</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 <?php echo SITE_NAME; ?> - J.L Rózpide</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
