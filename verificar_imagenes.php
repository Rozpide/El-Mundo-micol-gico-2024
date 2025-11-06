<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Imágenes - El Mundo Micológico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #2c5f2d;
            text-align: center;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 30px 0;
            justify-content: center;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            min-width: 150px;
        }
        .stat-number {
            font-size: 48px;
            font-weight: bold;
            margin: 10px 0;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        .success { color: #28a745; }
        .warning { color: #ffc107; }
        .danger { color: #dc3545; }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .image-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .image-preview {
            width: 100%;
            height: 200px;
            background-color: #f0f0f0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            overflow: hidden;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .placeholder {
            color: #999;
            text-align: center;
            font-size: 12px;
        }
        .image-name {
            font-weight: bold;
            color: #333;
            margin: 5px 0;
            font-size: 14px;
        }
        .image-status {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            display: inline-block;
            margin-top: 5px;
        }
        .status-found {
            background-color: #d4edda;
            color: #155724;
        }
        .status-missing {
            background-color: #f8d7da;
            color: #721c24;
        }
        .download-btn {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            font-size: 12px;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>🍄 Verificador de Imágenes de Setas</h1>
    
    <?php
    // Lista de imágenes esperadas
    $imagenes_esperadas = [
        'amanita-muscaria.jpg' => 'Amanita muscaria (Matamoscas)',
        'boletus-edulis.jpg' => 'Boletus edulis (Boleto comestible)',
        'cantharellus-cibarius.jpg' => 'Cantharellus cibarius (Rebozuelo)',
        'lactarius-deliciosus.jpg' => 'Lactarius deliciosus (Níscalo)',
        'amanita-phalloides.jpg' => 'Amanita phalloides (Oronja verde)',
        'macrolepiota-procera.jpg' => 'Macrolepiota procera (Parasol)',
        'amanita-caesarea.jpg' => 'Amanita caesarea (Oronja)',
        'russula-cyanoxantha.jpg' => 'Russula cyanoxantha (Rúsula)',
        'pleurotus-ostreatus.jpg' => 'Pleurotus ostreatus (Seta de ostra)',
        'morchella-esculenta.jpg' => 'Morchella esculenta (Colmenilla)',
        'hygrophorus-marzuolus.jpg' => 'Hygrophorus marzuolus (Seta de marzo)',
        'calocybe-gambosa.jpg' => 'Calocybe gambosa (Seta de San Jorge)',
        'lepista-nuda.jpg' => 'Lepista nuda (Pie azul)',
        'tricholoma-portentosum.jpg' => 'Tricholoma portentosum (Capuchina)',
        'hydnum-repandum.jpg' => 'Hydnum repandum (Lengua de gato)',
        'boletus-aereus.jpg' => 'Boletus aereus (Boleto negro)',
        'boletus-pinophilus.jpg' => 'Boletus pinophilus (Boleto de pino)',
        'agaricus-campestris.jpg' => 'Agaricus campestris (Champiñón silvestre)',
        'coprinus-comatus.jpg' => 'Coprinus comatus (Barbuda)',
        'craterellus-cornucopioides.jpg' => 'Craterellus cornucopioides (Trompeta)',
        'amanita-pantherina.jpg' => 'Amanita pantherina (Amanita pantera)',
        'amanita-verna.jpg' => 'Amanita verna (Oronja blanca)',
        'cortinarius-orellanus.jpg' => 'Cortinarius orellanus (Cortinario)',
        'lepiota-brunneoincarnata.jpg' => 'Lepiota brunneoincarnata (Lepiota)',
        'galerina-marginata.jpg' => 'Galerina marginata (Galerina mortal)',
        'lycoperdon-perlatum.jpg' => 'Lycoperdon perlatum (Bejín perlado)',
        'trametes-versicolor.jpg' => 'Trametes versicolor (Cola de pavo)',
        'ganoderma-lucidum.jpg' => 'Ganoderma lucidum (Reishi)',
        'fomes-fomentarius.jpg' => 'Fomes fomentarius (Yesca)'
    ];
    
    $carpeta = 'imagenes/setas/';
    $encontradas = 0;
    $faltantes = 0;
    
    // Verificar cada imagen
    $resultados = [];
    foreach ($imagenes_esperadas as $archivo => $nombre) {
        $ruta = $carpeta . $archivo;
        $existe = file_exists($ruta);
        
        if ($existe) {
            $encontradas++;
        } else {
            $faltantes++;
        }
        
        $resultados[] = [
            'archivo' => $archivo,
            'nombre' => $nombre,
            'existe' => $existe,
            'ruta' => $ruta
        ];
    }
    
    $total = count($imagenes_esperadas);
    $porcentaje = round(($encontradas / $total) * 100);
    ?>
    
    <div class="stats">
        <div class="stat-card">
            <div class="stat-number success"><?php echo $encontradas; ?></div>
            <div class="stat-label">Imágenes encontradas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number danger"><?php echo $faltantes; ?></div>
            <div class="stat-label">Imágenes faltantes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number <?php echo $porcentaje >= 50 ? 'success' : 'warning'; ?>">
                <?php echo $porcentaje; ?>%
            </div>
            <div class="stat-label">Completado</div>
        </div>
    </div>
    
    <?php if ($faltantes > 0): ?>
    <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107;">
        <strong>⚠️ Atención:</strong> Faltan <?php echo $faltantes; ?> imágenes. 
        Consulta el archivo <strong>IMAGENES_GUIA.md</strong> para instrucciones de descarga.
    </div>
    <?php else: ?>
    <div style="background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #28a745;">
        <strong>✅ ¡Perfecto!</strong> Todas las imágenes están presentes.
    </div>
    <?php endif; ?>
    
    <h2 style="margin-top: 40px;">Estado de las imágenes:</h2>
    
    <div class="image-grid">
        <?php foreach ($resultados as $img): ?>
        <div class="image-card">
            <div class="image-preview">
                <?php if ($img['existe']): ?>
                    <img src="<?php echo htmlspecialchars($img['ruta']); ?>" alt="<?php echo htmlspecialchars($img['nombre']); ?>">
                <?php else: ?>
                    <div class="placeholder">
                        <div style="font-size: 48px;">🍄</div>
                        <div>Sin imagen</div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="image-name"><?php echo htmlspecialchars($img['nombre']); ?></div>
            <div style="font-size: 11px; color: #666; margin: 3px 0;">
                <?php echo htmlspecialchars($img['archivo']); ?>
            </div>
            <span class="image-status <?php echo $img['existe'] ? 'status-found' : 'status-missing'; ?>">
                <?php echo $img['existe'] ? '✓ Encontrada' : '✗ Faltante'; ?>
            </span>
            <?php if (!$img['existe']): ?>
            <br>
            <a href="https://commons.wikimedia.org/w/index.php?search=<?php echo urlencode(explode('(', $img['nombre'])[0]); ?>" 
               class="download-btn" target="_blank">
                🔍 Buscar en Wikimedia
            </a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div style="margin-top: 40px; padding: 20px; background: white; border-radius: 10px;">
        <h3>📋 Instrucciones:</h3>
        <ol>
            <li>Haz clic en "Buscar en Wikimedia" para las imágenes faltantes</li>
            <li>Descarga la imagen en buena calidad</li>
            <li>Renómbrala con el nombre exacto mostrado</li>
            <li>Guárdala en la carpeta: <code><?php echo $carpeta; ?></code></li>
            <li>Refresca esta página para verificar</li>
        </ol>
        <p><strong>Carpeta completa:</strong> <code><?php echo realpath($carpeta); ?></code></p>
    </div>
    
</body>
</html>
