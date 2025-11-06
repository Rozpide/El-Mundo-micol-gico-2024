# 📸 Guía para descargar imágenes de setas

## Opción 1: Descargar desde sitios gratuitos (Recomendado)

### Sitios web recomendados para imágenes de setas:

1. **Wikimedia Commons** (https://commons.wikimedia.org)
   - Búsqueda: El nombre científico de la seta
   - Licencia: CC0 / Creative Commons
   - Calidad: Excelente

2. **Pixabay** (https://pixabay.com)
   - Búsqueda en inglés: "mushroom [nombre]"
   - Licencia: Libre uso
   - Calidad: Buena

3. **Unsplash** (https://unsplash.com)
   - Búsqueda: "mushroom" o nombre específico
   - Licencia: Libre uso
   - Calidad: Muy buena

## Nombres de archivos necesarios:

Guarda las imágenes con estos nombres exactos en la carpeta `imagenes/setas/`:

### Comestibles:
- amanita-caesarea.jpg (Oronja)
- boletus-edulis.jpg (Boleto comestible)
- cantharellus-cibarius.jpg (Rebozuelo)
- lactarius-deliciosus.jpg (Níscalo)
- macrolepiota-procera.jpg (Parasol)
- russula-cyanoxantha.jpg (Rúsula)
- pleurotus-ostreatus.jpg (Seta de ostra)
- morchella-esculenta.jpg (Colmenilla)
- hygrophorus-marzuolus.jpg (Seta de marzo)
- calocybe-gambosa.jpg (Seta de San Jorge)
- lepista-nuda.jpg (Pie azul)
- tricholoma-portentosum.jpg (Capuchina)
- hydnum-repandum.jpg (Lengua de gato)
- boletus-aereus.jpg (Boleto negro)
- boletus-pinophilus.jpg (Boleto de pino)
- agaricus-campestris.jpg (Champiñón silvestre)
- coprinus-comatus.jpg (Barbuda)
- craterellus-cornucopioides.jpg (Trompeta de los muertos)

### Tóxicas:
- amanita-muscaria.jpg (Matamoscas)
- amanita-phalloides.jpg (Oronja verde)
- amanita-pantherina.jpg (Amanita pantera)
- amanita-verna.jpg (Oronja blanca)
- cortinarius-orellanus.jpg (Cortinario de montaña)
- lepiota-brunneoincarnata.jpg (Lepiota envenenadora)
- galerina-marginata.jpg (Galerina mortal)

### No comestibles/Medicinales:
- lycoperdon-perlatum.jpg (Bejín perlado)
- trametes-versicolor.jpg (Cola de pavo)
- ganoderma-lucidum.jpg (Reishi)
- fomes-fomentarius.jpg (Yesca)

## Opción 2: Script para descargar imágenes automáticamente

He creado un script PHP que puedes ejecutar para verificar qué imágenes faltan.

## Opción 3: Usar imágenes placeholder temporales

Mientras consigues las imágenes reales, puedes usar servicios de placeholder:

Por ejemplo: `https://via.placeholder.com/400x300/228B22/FFFFFF?text=Nombre+Seta`

## 📝 Pasos para agregar las imágenes:

1. **Crear la carpeta** (ya está creada):
   ```
   imagenes/setas/
   ```

2. **Descargar imágenes** de los sitios recomendados

3. **Renombrar** cada imagen con el nombre exacto de la lista

4. **Guardar** en la carpeta `imagenes/setas/`

5. **Actualizar la base de datos** ejecutando el nuevo `database.sql`

6. **Refrescar el sitio** para ver las imágenes

## ⚠️ Especificaciones técnicas:

- **Formato**: JPG o PNG
- **Tamaño recomendado**: 800x600 píxeles
- **Peso máximo**: 500KB por imagen
- **Aspecto**: Cuadrado o 4:3

## 🔍 Búsqueda en Wikimedia Commons:

Ejemplo para buscar "Amanita muscaria":
1. Ve a https://commons.wikimedia.org
2. Busca: "Amanita muscaria"
3. Selecciona una imagen de buena calidad
4. Descarga en tamaño medio (no full resolution)
5. Renombra a: `amanita-muscaria.jpg`
6. Guarda en `imagenes/setas/`

## 📌 Tip: Búsqueda masiva

Puedes buscar en Google Imágenes con estos filtros:
- Búsqueda: "[nombre científico] site:commons.wikimedia.org"
- Ejemplo: "Boletus edulis site:commons.wikimedia.org"
