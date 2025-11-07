<?php
require_once 'config.php';
require_once 'functions.php';

// Obtener filtros desde GET
$filtros = [
    'color' => $_GET['color'] ?? '',
    'comestible' => $_GET['comestible'] ?? '',
    'anillo' => $_GET['anillo'] ?? '',
    'laminas' => $_GET['laminas'] ?? '',
    'sombrero' => $_GET['sombrero'] ?? '',
    'nombre' => $_GET['nombre'] ?? ''
];

// Buscar setas
$setas = buscarSetas($filtros);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Buscar Setas - <?php echo SITE_NAME; ?></title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="index.php">🍄 <?php echo SITE_NAME; ?></a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogo.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link active" href="buscar.php">Buscar</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">🔍 Buscar Setas</h2>
        
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="buscar.php">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?php echo htmlspecialchars($filtros['nombre']); ?>" 
                                   placeholder="Nombre científico o común">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="color" class="form-label">Color</label>
                            <select class="form-select" id="color" name="color">
                                <option value="">Todos</option>
                                <option value="blanco" <?php echo $filtros['color'] === 'blanco' ? 'selected' : ''; ?>>Blanco</option>
                                <option value="marron" <?php echo $filtros['color'] === 'marron' ? 'selected' : ''; ?>>Marrón</option>
                                <option value="rojo" <?php echo $filtros['color'] === 'rojo' ? 'selected' : ''; ?>>Rojo</option>
                                <option value="amarillo" <?php echo $filtros['color'] === 'amarillo' ? 'selected' : ''; ?>>Amarillo</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="comestible" class="form-label">Tipo</label>
                            <select class="form-select" id="comestible" name="comestible">
                                <option value="">Todas</option>
                                <option value="comestible" <?php echo $filtros['comestible'] === 'comestible' ? 'selected' : ''; ?>>Comestible</option>
                                <option value="no_comestible" <?php echo $filtros['comestible'] === 'no_comestible' ? 'selected' : ''; ?>>No comestible</option>
                                <option value="toxica" <?php echo $filtros['comestible'] === 'toxica' ? 'selected' : ''; ?>>Tóxica</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="laminas" class="form-label">Láminas</label>
                            <select class="form-select" id="laminas" name="laminas">
                                <option value="">Todas</option>
                                <option value="libres" <?php echo $filtros['laminas'] === 'libres' ? 'selected' : ''; ?>>Libres</option>
                                <option value="adnatas" <?php echo $filtros['laminas'] === 'adnatas' ? 'selected' : ''; ?>>Adnatas</option>
                                <option value="decurrentes" <?php echo $filtros['laminas'] === 'decurrentes' ? 'selected' : ''; ?>>Decurrentes</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="sombrero" class="form-label">Sombrero</label>
                            <select class="form-select" id="sombrero" name="sombrero">
                                <option value="">Todos</option>
                                <option value="convexo" <?php echo $filtros['sombrero'] === 'convexo' ? 'selected' : ''; ?>>Convexo</option>
                                <option value="plano" <?php echo $filtros['sombrero'] === 'plano' ? 'selected' : ''; ?>>Plano</option>
                                <option value="umbonado" <?php echo $filtros['sombrero'] === 'umbonado' ? 'selected' : ''; ?>>Umbonado</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="anillo" class="form-label">Anillo</label>
                            <select class="form-select" id="anillo" name="anillo">
                                <option value="">Cualquiera</option>
                                <option value="presente" <?php echo $filtros['anillo'] === 'presente' ? 'selected' : ''; ?>>Presente</option>
                                <option value="ausente" <?php echo $filtros['anillo'] === 'ausente' ? 'selected' : ''; ?>>Ausente</option>
                            </select>
                        </div>
                        
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                            <a href="buscar.php" class="btn btn-secondary btn-lg">Limpiar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h3 class="mb-3">Resultados de búsqueda (<?php echo count($setas); ?> especies encontradas)</h3>
        
        <?php if (empty($setas)): ?>
            <div class="alert alert-warning">
                No se encontraron setas con los criterios especificados.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($setas as $seta): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if($seta['imagen']): ?>
                        <img src="<?php echo htmlspecialchars($seta['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($seta['nombre_cientifico']); ?>">
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
                            
                            <div class="mt-2">
                                <a href="detalle.php?id=<?php echo $seta['id']; ?>" class="btn btn-sm btn-success">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 <?php echo SITE_NAME; ?> - J.L Rózpide</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
