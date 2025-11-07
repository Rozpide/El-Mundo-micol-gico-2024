<?php
// Funciones auxiliares para el sitio

// Obtener todas las setas
function getAllSetas() {
    try {
        $conn = getDBConnection();
        $stmt = $conn->query("SELECT * FROM setas ORDER BY nombre_cientifico ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Buscar setas por filtros
function buscarSetas($filtros = []) {
    try {
        $conn = getDBConnection();
        $sql = "SELECT * FROM setas WHERE 1=1";
        $params = [];
        
        if (!empty($filtros['color'])) {
            $sql .= " AND color = :color";
            $params[':color'] = $filtros['color'];
        }
        
        if (!empty($filtros['comestible'])) {
            $sql .= " AND comestible = :comestible";
            $params[':comestible'] = $filtros['comestible'];
        }
        
        if (!empty($filtros['anillo'])) {
            $sql .= " AND anillo = :anillo";
            $params[':anillo'] = $filtros['anillo'];
        }
        
        if (!empty($filtros['laminas'])) {
            $sql .= " AND laminas = :laminas";
            $params[':laminas'] = $filtros['laminas'];
        }
        
        if (!empty($filtros['sombrero'])) {
            $sql .= " AND sombrero = :sombrero";
            $params[':sombrero'] = $filtros['sombrero'];
        }
        
        if (!empty($filtros['nombre'])) {
            $sql .= " AND (nombre_cientifico LIKE :nombre OR nombre_comun LIKE :nombre)";
            $params[':nombre'] = '%' . $filtros['nombre'] . '%';
        }
        
        $sql .= " ORDER BY nombre_cientifico ASC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Obtener detalles de una seta
function getSetaById($id) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM setas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

// Obtener total de setas
function getTotalSetas() {
    try {
        $conn = getDBConnection();
        $stmt = $conn->query("SELECT COUNT(*) as total FROM setas");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch(PDOException $e) {
        return 0;
    }
}

// Obtener setas comestibles
function getComestiblesSetas() {
    try {
        $conn = getDBConnection();
        $stmt = $conn->query("SELECT COUNT(*) as total FROM setas WHERE comestible = 'comestible'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch(PDOException $e) {
        return 0;
    }
}

// Obtener setas tóxicas
function getToxicasSetas() {
    try {
        $conn = getDBConnection();
        $stmt = $conn->query("SELECT COUNT(*) as total FROM setas WHERE comestible = 'toxica'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch(PDOException $e) {
        return 0;
    }
}

// Guardar comentario
function guardarComentario($nombre, $email, $seta_id, $comentario) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO comentarios (nombre, email, seta_id, comentario) VALUES (:nombre, :email, :seta_id, :comentario)");
        return $stmt->execute([
            ':nombre' => sanitize($nombre),
            ':email' => sanitize($email),
            ':seta_id' => $seta_id,
            ':comentario' => sanitize($comentario)
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

// Obtener comentarios de una seta
function getComentarios($seta_id) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM comentarios WHERE seta_id = :seta_id ORDER BY fecha DESC");
        $stmt->execute([':seta_id' => $seta_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return [];
    }
}

// Guardar mensaje de contacto
function guardarMensajeContacto($nombre, $email, $asunto, $mensaje) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje) VALUES (:nombre, :email, :asunto, :mensaje)");
        return $stmt->execute([
            ':nombre' => sanitize($nombre),
            ':email' => sanitize($email),
            ':asunto' => sanitize($asunto),
            ':mensaje' => sanitize($mensaje)
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

// Obtener color según tipo de seta
function getComestibleColor($tipo) {
    switch($tipo) {
        case 'comestible':
            return 'success';
        case 'toxica':
            return 'danger';
        default:
            return 'warning';
    }
}

// Registrar visitas (simple)
function getVisitasHoy() {
    $archivo = 'visitas.txt';
    $fecha_hoy = date('Y-m-d');
    
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $datos = json_decode($contenido, true);
        
        if ($datos && isset($datos['fecha']) && $datos['fecha'] === $fecha_hoy) {
            return $datos['visitas'];
        }
    }
    
    return 0;
}

function registrarVisita() {
    $archivo = 'visitas.txt';
    $fecha_hoy = date('Y-m-d');
    
    $visitas = 1;
    
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $datos = json_decode($contenido, true);
        
        if ($datos && isset($datos['fecha']) && $datos['fecha'] === $fecha_hoy) {
            $visitas = $datos['visitas'] + 1;
        }
    }
    
    $datos = [
        'fecha' => $fecha_hoy,
        'visitas' => $visitas
    ];
    
    file_put_contents($archivo, json_encode($datos));
}

// Registrar visita automáticamente
registrarVisita();
?>
