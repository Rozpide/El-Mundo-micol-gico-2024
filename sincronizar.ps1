# Script para sincronizar archivos al servidor XAMPP
# Ejecutar: .\sincronizar.ps1

$origen = Get-Location
$destino = "C:\xampp\htdocs\El-Mundo-micologico-2024"

Write-Host "🔄 Sincronizando archivos..." -ForegroundColor Cyan

# Copiar archivos PHP
Copy-Item -Path "*.php" -Destination $destino -Force
Write-Host "✅ Archivos PHP copiados" -ForegroundColor Green

# Copiar archivos SQL
Copy-Item -Path "*.sql" -Destination $destino -Force
Write-Host "✅ Archivos SQL copiados" -ForegroundColor Green

# Copiar archivos CSS
Copy-Item -Path "*.css" -Destination $destino -Force
Write-Host "✅ Archivos CSS copiados" -ForegroundColor Green

# Copiar archivos Markdown
Copy-Item -Path "*.md" -Destination $destino -Force
Write-Host "✅ Archivos MD copiados" -ForegroundColor Green

# Copiar carpeta de imágenes
if (Test-Path "imagenes") {
    Copy-Item -Path "imagenes" -Destination $destino -Recurse -Force
    Write-Host "✅ Carpeta imagenes copiada" -ForegroundColor Green
}

Write-Host ""
Write-Host "🎉 ¡Sincronización completa!" -ForegroundColor Green
Write-Host "📂 Destino: $destino" -ForegroundColor Yellow
