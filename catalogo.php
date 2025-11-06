<?php
require_once 'config.php';
require_once 'functions.php';

$setas = getAllSetas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Catálogo - <?php echo SITE_NAME; ?></title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">🍄 <?php echo SITE_NAME; ?></a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" href="catalogo.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">📚 Catálogo Completo de Setas</h2>
        <p class="text-center text-muted">Total de especies: <?php echo count($setas); ?></p>
        
        <div class="row">
            <?php foreach($setas as $seta): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if($seta['imagen']): ?>
                    <img src="<?php echo htmlspecialchars($seta['imagen']); ?>" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;"
                         alt="<?php echo htmlspecialchars($seta['nombre_cientifico']); ?>">
                    <?php else: ?>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span class="text-muted">Sin imagen</span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($seta['nombre_cientifico']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($seta['nombre_comun']); ?></h6>
                        <p class="card-text"><?php echo htmlspecialchars(substr($seta['descripcion'], 0, 100)) . '...'; ?></p>
                        
                        <div class="mb-2">
                            <span class="badge bg-secondary">Color: <?php echo $seta['color']; ?></span>
                            <span class="badge bg-secondary">Anillo: <?php echo $seta['anillo']; ?></span>
                        </div>
                        
                        <span class="badge bg-<?php echo getComestibleColor($seta['comestible']); ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $seta['comestible'])); ?>
                        </span>
                        
                        <div class="mt-3">
                            <a href="detalle.php?id=<?php echo $seta['id']; ?>" class="btn btn-sm btn-success">Ver detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 <?php echo SITE_NAME; ?> - J.L Rózpide</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
