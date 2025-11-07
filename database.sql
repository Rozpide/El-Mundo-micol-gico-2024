-- Base de datos para El Mundo Micológico
CREATE DATABASE IF NOT EXISTS mundo_micologico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE mundo_micologico;

-- Tabla de especies de setas
CREATE TABLE IF NOT EXISTS setas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cientifico VARCHAR(100) NOT NULL,
    nombre_comun VARCHAR(100),
    color VARCHAR(50),
    laminas VARCHAR(50),
    sombrero VARCHAR(50),
    anillo VARCHAR(50),
    pie VARCHAR(50),
    tamano VARCHAR(50),
    comestible ENUM('comestible', 'no_comestible', 'toxica') NOT NULL,
    descripcion TEXT,
    habitat TEXT,
    imagen VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (nombre_cientifico)
);

-- Tabla de comentarios de usuarios
CREATE TABLE IF NOT EXISTS comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    seta_id INT,
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seta_id) REFERENCES setas(id) ON DELETE CASCADE
);

-- Tabla de contacto
CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    asunto VARCHAR(200) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN DEFAULT FALSE
);

-- Insertar datos de ejemplo (usar INSERT IGNORE para evitar duplicados)
INSERT IGNORE INTO setas (nombre_cientifico, nombre_comun, color, laminas, sombrero, anillo, pie, tamano, comestible, descripcion, habitat, imagen) VALUES
-- Especies comestibles populares
('Amanita muscaria', 'Matamoscas', 'rojo', 'libres', 'convexo', 'presente', 'cilindrico', 'grande', 'toxica', 'Seta muy vistosa con sombrero rojo y puntos blancos. Es tóxica y alucinógena.', 'Bosques de coníferas y caducifolios', 'imagenes/setas/amanita-muscaria.jpg'),
('Boletus edulis', 'Boleto comestible', 'marron', 'libres', 'convexo', 'ausente', 'bulboso', 'grande', 'comestible', 'Excelente comestible muy apreciado en gastronomía.', 'Bosques de coníferas y caducifolios', 'imagenes/setas/boletus-edulis.jpg'),
('Cantharellus cibarius', 'Rebozuelo', 'amarillo', 'adnatas', 'convexo', 'ausente', 'radicante', 'mediano', 'comestible', 'Seta comestible de gran valor gastronómico con aroma afrutado.', 'Bosques mixtos y prados', 'imagenes/setas/cantharellus-cibarius.jpg'),
('Lactarius deliciosus', 'Níscalo', 'rojo', 'decurrentes', 'convexo', 'ausente', 'radicante', 'mediano', 'comestible', 'Muy apreciada en España, especialmente en la zona mediterránea.', 'Pinares', 'imagenes/setas/lactarius-deliciosus.jpg'),
('Amanita phalloides', 'Oronja verde', 'blanco', 'libres', 'convexo', 'presente', 'cilindrico', 'grande', 'toxica', 'Extremadamente venenosa. Causa más del 90% de muertes por envenenamiento por setas.', 'Bosques de caducifolios', 'imagenes/setas/amanita-phalloides.jpg'),
('Macrolepiota procera', 'Parasol', 'blanco', 'libres', 'plano', 'presente', 'cilindrico', 'grande', 'comestible', 'Excelente comestible cuando está maduro. Muy grande y vistoso.', 'Prados y claros de bosque', 'imagenes/setas/macrolepiota-procera.jpg'),
('Amanita caesarea', 'Oronja', 'amarillo', 'libres', 'convexo', 'ausente', 'radicante', 'mediano', 'comestible', 'Considerada la reina de las setas. Exquisito sabor.', 'Encinares y robledales', 'imagenes/setas/amanita-caesarea.jpg'),
('Russula cyanoxantha', 'Rúsula', 'amarillo', 'libres', 'convexo', 'ausente', 'radicante', 'mediano', 'comestible', 'Buen comestible con carne firme y sabor suave.', 'Bosques mixtos', 'imagenes/setas/russula-cyanoxantha.jpg'),

-- Más especies comestibles
('Pleurotus ostreatus', 'Seta de ostra', 'blanco', 'decurrentes', 'plano', 'ausente', 'radicante', 'mediano', 'comestible', 'Excelente comestible cultivada comercialmente. Sabor suave y textura carnosa.', 'Troncos de árboles caducifolios', 'imagenes/setas/pleurotus-ostreatus.jpg'),
('Morchella esculenta', 'Colmenilla', 'marron', 'libres', 'convexo', 'ausente', 'cilindrico', 'mediano', 'comestible', 'Seta primaveral muy apreciada. Tóxica en crudo, debe cocinarse bien.', 'Bosques y zonas quemadas', 'imagenes/setas/morchella-esculenta.jpg'),
('Hygrophorus marzuolus', 'Seta de marzo', 'blanco', 'decurrentes', 'convexo', 'ausente', 'bulboso', 'mediano', 'comestible', 'Aparece al final del invierno bajo la nieve. Muy apreciada en Italia.', 'Pinares de montaña', 'imagenes/setas/hygrophorus-marzuolus.jpg'),
('Calocybe gambosa', 'Seta de San Jorge', 'blanco', 'adnatas', 'convexo', 'ausente', 'cilindrico', 'mediano', 'comestible', 'Aparece alrededor del 23 de abril. Olor característico a harina.', 'Prados y zonas herbosas', 'imagenes/setas/calocybe-gambosa.jpg'),
('Lepista nuda', 'Pie azul', 'amarillo', 'adnatas', 'convexo', 'ausente', 'cilindrico', 'mediano', 'comestible', 'Color violáceo característico. Excelente comestible cocida.', 'Bosques y jardines', 'imagenes/setas/lepista-nuda.jpg'),
('Tricholoma portentosum', 'Capuchina', 'amarillo', 'adnatas', 'convexo', 'ausente', 'cilindrico', 'mediano', 'comestible', 'Seta otoñal de color gris verdoso. Muy apreciada en algunas regiones.', 'Pinares', 'imagenes/setas/tricholoma-portentosum.jpg'),
('Hydnum repandum', 'Lengua de gato', 'amarillo', 'libres', 'convexo', 'ausente', 'cilindrico', 'mediano', 'comestible', 'Tiene aguijones en lugar de láminas. Sabor ligeramente amargo.', 'Bosques mixtos', 'imagenes/setas/hydnum-repandum.jpg'),
('Boletus aereus', 'Boleto negro', 'marron', 'libres', 'convexo', 'ausente', 'bulboso', 'grande', 'comestible', 'Considerado superior al edulis. Sombrero muy oscuro, casi negro.', 'Encinares y robledales', 'imagenes/setas/boletus-aereus.jpg'),
('Boletus pinophilus', 'Boleto de pino', 'marron', 'libres', 'convexo', 'ausente', 'bulboso', 'grande', 'comestible', 'Sombrero rojizo. Excelente comestible, de los mejores boletos.', 'Pinares de montaña', 'imagenes/setas/boletus-pinophilus.jpg'),
('Agaricus campestris', 'Champiñón silvestre', 'blanco', 'libres', 'convexo', 'presente', 'cilindrico', 'mediano', 'comestible', 'El champiñón clásico de campo. Láminas rosadas que se vuelven marrones.', 'Prados y pastizales', 'imagenes/setas/agaricus-campestris.jpg'),
('Coprinus comatus', 'Barbuda', 'blanco', 'libres', 'cilindrico', 'presente', 'cilindrico', 'grande', 'comestible', 'Seta con escamas. Se autodigiere rápidamente volviéndose negra.', 'Bordes de caminos y jardines', 'imagenes/setas/coprinus-comatus.jpg'),
('Craterellus cornucopioides', 'Trompeta de los muertos', 'marron', 'decurrentes', 'umbonado', 'ausente', 'radicante', 'mediano', 'comestible', 'Color negro, forma de trompeta. Excelente comestible con aroma intenso.', 'Bosques de caducifolios', 'imagenes/setas/craterellus-cornucopioides.jpg'),

-- Especies tóxicas
('Amanita pantherina', 'Amanita pantera', 'marron', 'libres', 'convexo', 'presente', 'bulboso', 'grande', 'toxica', 'Muy tóxica, causa síndrome neurológico. Sombrero marrón con verrugas blancas.', 'Bosques de coníferas', 'imagenes/setas/amanita-pantherina.jpg'),
('Amanita verna', 'Oronja blanca', 'blanco', 'libres', 'convexo', 'presente', 'bulboso', 'grande', 'toxica', 'MORTAL. Totalmente blanca, similar a phalloides. Causa fallo hepático.', 'Bosques de caducifolios', 'imagenes/setas/amanita-verna.jpg'),
('Cortinarius orellanus', 'Cortinario de montaña', 'rojo', 'adnatas', 'convexo', 'ausente', 'cilindrico', 'mediano', 'toxica', 'MORTAL. Contiene orellanina que destruye los riñones. Síntomas tardíos.', 'Bosques de caducifolios', 'imagenes/setas/cortinarius-orellanus.jpg'),
('Lepiota brunneoincarnata', 'Lepiota envenenadora', 'blanco', 'libres', 'convexo', 'presente', 'cilindrico', 'pequeno', 'toxica', 'MORTAL. Pequeña pero muy venenosa, similar a la phalloides en toxinas.', 'Bosques y jardines', 'imagenes/setas/lepiota-brunneoincarnata.jpg'),
('Galerina marginata', 'Galerina mortal', 'marron', 'adnatas', 'convexo', 'presente', 'cilindrico', 'pequeno', 'toxica', 'MORTAL. Crece en madera. Contiene las mismas toxinas que Amanita phalloides.', 'Troncos en descomposición', 'imagenes/setas/galerina-marginata.jpg'),

-- Especies no comestibles/medicinales
('Lycoperdon perlatum', 'Bejín perlado', 'blanco', 'libres', 'redondo', 'ausente', 'radicante', 'mediano', 'no_comestible', 'Libera esporas en forma de humo. Comestible solo cuando es joven y blanco.', 'Bosques y prados', 'imagenes/setas/lycoperdon-perlatum.jpg'),
('Trametes versicolor', 'Cola de pavo', 'marron', 'libres', 'plano', 'ausente', 'ausente', 'pequeno', 'no_comestible', 'Hongo en forma de abanico con bandas de colores. Propiedades medicinales.', 'Troncos muertos', 'imagenes/setas/trametes-versicolor.jpg'),
('Ganoderma lucidum', 'Reishi', 'rojo', 'libres', 'plano', 'ausente', 'radicante', 'grande', 'no_comestible', 'Hongo medicinal usado en medicina tradicional china. No comestible por duro.', 'Base de árboles', 'imagenes/setas/ganoderma-lucidum.jpg'),
('Fomes fomentarius', 'Yesca', 'marron', 'libres', 'plano', 'ausente', 'ausente', 'grande', 'no_comestible', 'Hongo leñoso usado históricamente para hacer fuego. No comestible.', 'Hayas y abedules', 'imagenes/setas/fomes-fomentarius.jpg');
