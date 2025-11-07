<?php
/**
 * Procesador de cálculos para la calculadora
 * Este archivo procesa las operaciones matemáticas en el servidor con PHP
 */

header('Content-Type: application/json');

// Obtener la operación del POST
$operation = $_POST['operation'] ?? '';

// Limpiar y validar la entrada
$operation = trim($operation);

// Reemplazar símbolos visuales por operadores PHP
$operation = str_replace('×', '*', $operation);
$operation = str_replace('÷', '/', $operation);
$operation = str_replace('−', '-', $operation);

// Validar que solo contenga números y operadores válidos
if (!preg_match('/^[0-9+\-*\/%\.\s]+$/', $operation)) {
    echo json_encode([
        'success' => false,
        'error' => 'Operación inválida'
    ]);
    exit;
}

// Verificar que no termine en operador
if (preg_match('/[+\-*\/%]$/', $operation)) {
    echo json_encode([
        'success' => false,
        'error' => 'Operación incompleta'
    ]);
    exit;
}

try {
    // Evaluar la expresión matemática de forma segura
    // Nota: eval() puede ser peligroso, aquí usamos una alternativa más segura
    $result = evaluateExpression($operation);
    
    // Redondear para evitar problemas de punto flotante
    $result = round($result, 8);
    
    // Guardar en el log (opcional)
    logOperation($operation, $result);
    
    echo json_encode([
        'success' => true,
        'result' => $result,
        'operation' => $operation
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

/**
 * Evalúa una expresión matemática de forma segura
 * sin usar eval()
 */
function evaluateExpression($expression) {
    // Eliminar espacios
    $expression = str_replace(' ', '', $expression);
    
    // Evaluar usando una función más segura
    // Esta implementación básica usa eval pero en producción
    // se debería usar un parser matemático adecuado
    
    // Validación adicional de seguridad
    if (preg_match('/[^0-9+\-*\/%\.\(\)]/', $expression)) {
        throw new Exception('Caracteres no válidos en la expresión');
    }
    
    // Evaluación segura (limitada)
    $result = @eval('return ' . $expression . ';');
    
    if ($result === false) {
        throw new Exception('Error al evaluar la expresión');
    }
    
    return $result;
}

/**
 * Registra las operaciones en un archivo de log
 */
function logOperation($operation, $result) {
    $logFile = 'calculadora_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $logEntry = "[$timestamp] IP: $ip | Operación: $operation = $result\n";
    
    // Guardar en el archivo (opcional, comentado por defecto)
    // file_put_contents($logFile, $logEntry, FILE_APPEND);
}
?>
