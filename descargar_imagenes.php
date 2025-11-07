<?php
/**
 * Script para descargar imágenes de setas desde Wikimedia Commons
 * Ejecutar: http://localhost/El-Mundo-micologico-2024/descargar_imagenes.php
 */

set_time_limit(300); // 5 minutos
ini_set('max_execution_time', 300);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga Automática de Imágenes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #2c5f2d;
            text-align: center;
        }
        .progress-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        .progress-bar {
            width: 100%;
            height: 30px;
            background-color: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            margin: 20px 0;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #20c997);
            width: 0%;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .log-item {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .log-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .log-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        .log-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        .btn {
            background-color: #28a745;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .image-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }
        .image-preview img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            justify-content: center;
        }
        .stat-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            min-width: 120px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <h1>🍄 Descarga Automática de Imágenes de Setas</h1>
    
    <?php
    // Configuración
    $carpeta_destino = 'imagenes/setas/';
    
    // Crear carpeta si no existe
    if (!file_exists($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }
    
    // Mapeo de especies con URLs de Wikimedia Commons (imágenes de dominio público)
    $imagenes_wiki = [
        'amanita-muscaria.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Amanita_muscaria_3_vliegenzwammen_op_rij.jpg/800px-Amanita_muscaria_3_vliegenzwammen_op_rij.jpg',
        'boletus-edulis.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/Boletus_edulis_EtgHollande_2010-09-09.jpg/800px-Boletus_edulis_EtgHollande_2010-09-09.jpg',
        'cantharellus-cibarius.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Cantharellus_cibarius_2012_G1.jpg/800px-Cantharellus_cibarius_2012_G1.jpg',
        'lactarius-deliciosus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Lactarius_deliciosus.jpg/800px-Lactarius_deliciosus.jpg',
        'amanita-phalloides.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Amanita_phalloides_1.JPG/800px-Amanita_phalloides_1.JPG',
        'macrolepiota-procera.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Macrolepiota_procera_2013_G1.jpg/800px-Macrolepiota_procera_2013_G1.jpg',
        'amanita-caesarea.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Amanita_caesarea_JPG2.jpg/800px-Amanita_caesarea_JPG2.jpg',
        'russula-cyanoxantha.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Russula_cyanoxantha_2010_G1.jpg/800px-Russula_cyanoxantha_2010_G1.jpg',
        'pleurotus-ostreatus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Pleurotus_ostreatus_JPG2.jpg/800px-Pleurotus_ostreatus_JPG2.jpg',
        'morchella-esculenta.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Morchella_esculenta.jpg/800px-Morchella_esculenta.jpg',
        'hygrophorus-marzuolus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/2012-03-18_Hygrophorus_marzuolus_crop.jpg/800px-2012-03-18_Hygrophorus_marzuolus_crop.jpg',
        'calocybe-gambosa.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Calocybe_gambosa_LC0153.jpg/800px-Calocybe_gambosa_LC0153.jpg',
        'lepista-nuda.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Lepista_nuda_JPG3.jpg/800px-Lepista_nuda_JPG3.jpg',
        'tricholoma-portentosum.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Tricholoma_portentosum_a1_%282%29.JPG/800px-Tricholoma_portentosum_a1_%282%29.JPG',
        'hydnum-repandum.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Hydnum_repandum_Wald_Hardegsen_2011.jpg/800px-Hydnum_repandum_Wald_Hardegsen_2011.jpg',
        'boletus-aereus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Boletus_aereus_2013_G1.jpg/800px-Boletus_aereus_2013_G1.jpg',
        'boletus-pinophilus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Boletus_pinophilus_-_Lindsey.jpg/800px-Boletus_pinophilus_-_Lindsey.jpg',
        'agaricus-campestris.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Agaricus_campestris_2013_G1.jpg/800px-Agaricus_campestris_2013_G1.jpg',
        'coprinus-comatus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Coprinus_comatus_G4_2013.jpg/800px-Coprinus_comatus_G4_2013.jpg',
        'craterellus-cornucopioides.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Craterellus_cornucopioides_JPG1.jpg/800px-Craterellus_cornucopioides_JPG1.jpg',
        'amanita-pantherina.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Amanita_pantherina_crop.jpg/800px-Amanita_pantherina_crop.jpg',
        'amanita-verna.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Amanita_virosa_2013_G1.jpg/800px-Amanita_virosa_2013_G1.jpg',
        'cortinarius-orellanus.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Cortinarius_orellanus_2013_G1.jpg/800px-Cortinarius_orellanus_2013_G1.jpg',
        'lepiota-brunneoincarnata.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Lepiota_brunneoincarnata_G2.JPG/800px-Lepiota_brunneoincarnata_G2.JPG',
        'galerina-marginata.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Galerina_marginata_3.jpg/800px-Galerina_marginata_3.jpg',
        'lycoperdon-perlatum.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Lycoperdon_perlatum_g4.jpg/800px-Lycoperdon_perlatum_g4.jpg',
        'trametes-versicolor.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Trametes_versicolor_JPG1.jpg/800px-Trametes_versicolor_JPG1.jpg',
        'ganoderma-lucidum.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Ganoderma_lucidum_03.jpg/800px-Ganoderma_lucidum_03.jpg',
        'fomes-fomentarius.jpg' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Fomes_fomentarius_JPG2.jpg/800px-Fomes_fomentarius_JPG2.jpg'
    ];
    
    if (isset($_GET['descargar']) && $_GET['descargar'] === 'si') {
        echo '<div class="progress-container">';
        echo '<h2>Proceso de descarga</h2>';
        echo '<div class="progress-bar"><div class="progress-fill" id="progressBar">0%</div></div>';
        echo '<div id="logs">';
        
        $total = count($imagenes_wiki);
        $descargadas = 0;
        $errores = 0;
        $saltadas = 0;
        
        foreach ($imagenes_wiki as $nombre_archivo => $url) {
            $ruta_destino = $carpeta_destino . $nombre_archivo;
            
            // Verificar si ya existe
            if (file_exists($ruta_destino)) {
                echo '<div class="log-info">⏭️ ' . htmlspecialchars($nombre_archivo) . ' - Ya existe, saltando...</div>';
                $saltadas++;
                flush();
                ob_flush();
                continue;
            }
            
            echo '<div class="log-info">📥 Descargando ' . htmlspecialchars($nombre_archivo) . '...</div>';
            flush();
            ob_flush();
            
            // Descargar imagen
            $contexto = stream_context_create([
                'http' => [
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]
            ]);
            
            $imagen_data = @file_get_contents($url, false, $contexto);
            
            if ($imagen_data !== false) {
                if (file_put_contents($ruta_destino, $imagen_data)) {
                    echo '<div class="log-success">✅ ' . htmlspecialchars($nombre_archivo) . ' - Descargada exitosamente</div>';
                    $descargadas++;
                } else {
                    echo '<div class="log-error">❌ ' . htmlspecialchars($nombre_archivo) . ' - Error al guardar</div>';
                    $errores++;
                }
            } else {
                echo '<div class="log-error">❌ ' . htmlspecialchars($nombre_archivo) . ' - Error al descargar desde URL</div>';
                $errores++;
            }
            
            // Actualizar barra de progreso
            $progreso = round((($descargadas + $errores + $saltadas) / $total) * 100);
            echo '<script>document.getElementById("progressBar").style.width = "' . $progreso . '%"; document.getElementById("progressBar").textContent = "' . $progreso . '%";</script>';
            flush();
            ob_flush();
            
            // Pequeña pausa para no sobrecargar el servidor
            usleep(500000); // 0.5 segundos
        }
        
        echo '</div>'; // fin logs
        
        echo '<div class="stats">';
        echo '<div class="stat-box"><div class="stat-number" style="color: #28a745;">' . $descargadas . '</div><div>Descargadas</div></div>';
        echo '<div class="stat-box"><div class="stat-number" style="color: #ffc107;">' . $saltadas . '</div><div>Saltadas</div></div>';
        echo '<div class="stat-box"><div class="stat-number" style="color: #dc3545;">' . $errores . '</div><div>Errores</div></div>';
        echo '</div>';
        
        if ($descargadas > 0) {
            echo '<div style="background: #d4edda; padding: 20px; border-radius: 5px; margin: 20px 0; text-align: center;">';
            echo '<h3 style="color: #155724; margin: 0;">🎉 ¡Proceso completado!</h3>';
            echo '<p style="margin: 10px 0;">Se descargaron ' . $descargadas . ' imágenes nuevas.</p>';
            echo '<a href="verificar_imagenes.php" class="btn">Ver Verificador de Imágenes</a> ';
            echo '<a href="catalogo.php" class="btn btn-secondary">Ver Catálogo</a>';
            echo '</div>';
        }
        
        echo '</div>'; // fin progress-container
        
    } else {
        // Mostrar información antes de descargar
        $existentes = 0;
        $faltantes = 0;
        
        foreach ($imagenes_wiki as $nombre_archivo => $url) {
            if (file_exists($carpeta_destino . $nombre_archivo)) {
                $existentes++;
            } else {
                $faltantes++;
            }
        }
        
        echo '<div class="progress-container">';
        echo '<h2>Información de descarga</h2>';
        echo '<div class="stats">';
        echo '<div class="stat-box"><div class="stat-number">' . count($imagenes_wiki) . '</div><div>Total imágenes</div></div>';
        echo '<div class="stat-box"><div class="stat-number" style="color: #28a745;">' . $existentes . '</div><div>Ya descargadas</div></div>';
        echo '<div class="stat-box"><div class="stat-number" style="color: #dc3545;">' . $faltantes . '</div><div>Faltantes</div></div>';
        echo '</div>';
        
        echo '<div style="background: #d1ecf1; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #17a2b8;">';
        echo '<h3 style="color: #0c5460;">ℹ️ Información importante:</h3>';
        echo '<ul style="color: #0c5460;">';
        echo '<li>Se descargarán ' . $faltantes . ' imágenes desde Wikimedia Commons</li>';
        echo '<li>Las imágenes son de dominio público (Creative Commons)</li>';
        echo '<li>Se guardarán en: <code>' . $carpeta_destino . '</code></li>';
        echo '<li>El proceso puede tardar varios minutos</li>';
        echo '<li>Las imágenes ya existentes no se volverán a descargar</li>';
        echo '</ul>';
        echo '</div>';
        
        if ($faltantes > 0) {
            echo '<div style="text-align: center; margin: 30px 0;">';
            echo '<a href="?descargar=si" class="btn" style="font-size: 18px; padding: 15px 40px;">🚀 Iniciar Descarga de ' . $faltantes . ' Imágenes</a>';
            echo '</div>';
        } else {
            echo '<div style="background: #d4edda; padding: 20px; border-radius: 5px; text-align: center;">';
            echo '<h3 style="color: #155724;">✅ Todas las imágenes ya están descargadas</h3>';
            echo '<a href="verificar_imagenes.php" class="btn">Ver Verificador</a> ';
            echo '<a href="catalogo.php" class="btn btn-secondary">Ver Catálogo</a>';
            echo '</div>';
        }
        
        echo '</div>';
        
        // Mostrar preview de imágenes existentes
        if ($existentes > 0) {
            echo '<div class="progress-container">';
            echo '<h3>Vista previa de imágenes existentes:</h3>';
            echo '<div class="image-preview">';
            foreach ($imagenes_wiki as $nombre_archivo => $url) {
                if (file_exists($carpeta_destino . $nombre_archivo)) {
                    echo '<img src="' . $carpeta_destino . $nombre_archivo . '" alt="' . $nombre_archivo . '" title="' . $nombre_archivo . '">';
                }
            }
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="index.php" class="btn btn-secondary">← Volver al Inicio</a>
    </div>
    
</body>
</html>
