<?php
require_once 'config.php';
require_once 'functions.php';

$id = $_GET['id'] ?? 0;
$seta = getSetaById($id);

if (!$seta) {
    header('Location: index.php');
    exit;
}

// Procesar comentario
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    
    if ($nombre && $email && $comentario) {
        if (guardarComentario($nombre, $email, $id, $comentario)) {
            $mensaje = '<div class="alert alert-success">¡Comentario guardado exitosamente!</div>';
        } else {
            $mensaje = '<div class="alert alert-danger">Error al guardar el comentario.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-warning">Por favor completa todos los campos.</div>';
    }
}

$comentarios = getComentarios($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo htmlspecialchars($seta['nombre_cientifico']); ?> - <?php echo SITE_NAME; ?></title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">🍄 <?php echo SITE_NAME; ?></a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="buscar.php">Buscar</a></li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars($seta['nombre_cientifico']); ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6">
                <?php if($seta['imagen']): ?>
                    <img src="<?php echo htmlspecialchars($seta['imagen']); ?>" 
                         class="img-fluid rounded" 
                         alt="<?php echo htmlspecialchars($seta['nombre_cientifico']); ?>">
                <?php else: ?>
                    <div class="bg-light p-5 text-center rounded">
                        <p class="text-muted">No hay imagen disponible</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($seta['nombre_cientifico']); ?></h1>
                <h4 class="text-muted"><?php echo htmlspecialchars($seta['nombre_comun']); ?></h4>
                
                <span class="badge bg-<?php echo getComestibleColor($seta['comestible']); ?> fs-5 mb-3">
                    <?php echo ucfirst(str_replace('_', ' ', $seta['comestible'])); ?>
                </span>
                
                <p class="lead"><?php echo htmlspecialchars($seta['descripcion']); ?></p>
                
                <h5 class="mt-4">Características</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Color:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['color'])); ?></td>
                    </tr>
                    <tr>
                        <th>Láminas:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['laminas'])); ?></td>
                    </tr>
                    <tr>
                        <th>Sombrero:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['sombrero'])); ?></td>
                    </tr>
                    <tr>
                        <th>Anillo:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['anillo'])); ?></td>
                    </tr>
                    <tr>
                        <th>Pie:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['pie'])); ?></td>
                    </tr>
                    <tr>
                        <th>Tamaño:</th>
                        <td><?php echo htmlspecialchars(ucfirst($seta['tamano'])); ?></td>
                    </tr>
                    <tr>
                        <th>Hábitat:</th>
                        <td><?php echo htmlspecialchars($seta['habitat']); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Sección de comentarios -->
        <div class="row mt-5">
            <div class="col-12">
                <h3>Comentarios (<?php echo count($comentarios); ?>)</h3>
                
                <?php echo $mensaje; ?>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Dejar un comentario</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="comentario" class="form-label">Comentario</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Enviar Comentario</button>
                        </form>
                    </div>
                </div>

                <?php foreach($comentarios as $comentario): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h6><?php echo htmlspecialchars($comentario['nombre']); ?></h6>
                        <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($comentario['fecha'])); ?></small>
                        <p class="mt-2"><?php echo nl2br(htmlspecialchars($comentario['comentario'])); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 <?php echo SITE_NAME; ?> - J.L Rózpide</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
