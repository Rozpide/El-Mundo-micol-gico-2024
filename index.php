<?php
require_once 'config.php';
require_once 'functions.php';

// Obtener setas desde la base de datos
$setas = getAllSetas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="Author" content="J.L Rózpide">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="styles.css">
    <title><?php echo SITE_NAME; ?></title>
    <link  rel="icon" type="image/jpg" href="imagenes-png\spiderman.png.jpg">
</head>
<body>
    
    <div class="col-8 container-fluid d-flex ">
        <ul class="col-6 nav ">
            <li class="nav-item">
                <span class="badge text-bg-info"><a class="nav-link link-success" aria-current="page" href="index.php">Inicio</a></span>
            </li>
            <li class="nav-item">
                <span class="badge text-bg-info"><a class="nav-link link-success" href="catalogo.php">Catálogo</a></span>
            </li>
            <li class="nav-item">
                <span class="badge text-bg-info"><a class="nav-link link-success" href="buscar.php">Buscar</a></span>
            </li>
        </ul>
        <ul class="col-6 nav justify-content-end ">
            <li class="nav-item">
                <span class="badge text-bg-info"><a class="nav-link link-success" href="contacto.php">Contacto</a></span>
            </li>
            <li class="nav-item">
                <span class="badge text-bg-info"><a class="nav-link link-success" href="sobre.php">Sobre</a></span>
            </li>
        </ul>
    </div>

    <div class="flex-row container-fluid ">
        <div class="col-12 d-flex justify-content-center">
            <h1 class="cabecera"><br>🍄<?php echo SITE_NAME; ?> 🍄</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="col-12 container-fluid d-flex">
                <img src="imagenes\cesarea.jpg" class="col-3 d-flex"  width="40px" height="200px">
                <img src="imagenes\cesarea.jpg" class="col-3 d-flex"  width="40px" height="200px">
                <img src="imagenes\cesarea.jpg" class="col-3 d-flex"  width="40px" height="200px">
                <img src="imagenes\cesarea.jpg" class="col-3 d-flex"  width="40px" height="200px">
            </div>
        </div>

        <div class="container-fluid ">
            <div class="col-12 d-flex justify-content-center ">
                <h5 class="cabecera"><br>🍄Tipos de Setas🍄</h5>
            </div>
        </div>

        <!-- Mostrar estadísticas -->
        <div class="container my-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h3><?php echo getTotalSetas(); ?></h3>
                            <p>Especies Registradas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h3><?php echo getComestiblesSetas(); ?></h3>
                            <p>Especies Comestibles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-danger text-white">
                        <div class="card-body">
                            <h3><?php echo getToxicasSetas(); ?></h3>
                            <p>Especies Tóxicas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buscar setas -->
        <div class="container my-4">
            <h3 class="text-center mb-4">🔍 Buscar Setas por Características</h3>
            <form action="buscar.php" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <select class="form-select" id="color" name="color">
                        <option value="">Todos los colores</option>
                        <option value="blanco">Blanco</option>
                        <option value="marron">Marrón</option>
                        <option value="rojo">Rojo</option>
                        <option value="amarillo">Amarillo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="comestible" class="form-label">Tipo</label>
                    <select class="form-select" id="comestible" name="comestible">
                        <option value="">Todas</option>
                        <option value="comestible">Comestible</option>
                        <option value="no_comestible">No comestible</option>
                        <option value="toxica">Tóxica</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="anillo" class="form-label">Anillo</label>
                    <select class="form-select" id="anillo" name="anillo">
                        <option value="">Cualquiera</option>
                        <option value="presente">Presente</option>
                        <option value="ausente">Ausente</option>
                    </select>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success btn-lg">Buscar Setas</button>
                </div>
            </form>
        </div>

        <!-- Setas destacadas -->
        <div class="container my-4">
            <h3 class="text-center mb-4">🍄 Especies Destacadas</h3>
            <div class="row">
                <?php foreach(array_slice($setas, 0, 6) as $seta): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if($seta['imagen']): ?>
                        <img src="<?php echo htmlspecialchars($seta['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($seta['nombre_cientifico']); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($seta['nombre_cientifico']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($seta['nombre_comun']); ?></h6>
                            <p class="card-text"><?php echo htmlspecialchars(substr($seta['descripcion'], 0, 100)) . '...'; ?></p>
                            <span class="badge bg-<?php echo getComestibleColor($seta['comestible']); ?>">
                                <?php echo ucfirst($seta['comestible']); ?>
                            </span>
                            <div class="mt-2">
                                <a href="detalle.php?id=<?php echo $seta['id']; ?>" class="btn btn-sm btn-success">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 <?php echo SITE_NAME; ?> - J.L Rózpide</p>
        <p>Visitas hoy: <?php echo getVisitasHoy(); ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
