Base de datos del proyecto:

CREATE DATABASE IF NOT EXISTS scancash;
USE scancash;

-- ==========================================
-- TABLA USUARIO
-- ==========================================

CREATE TABLE usuario (
id_usuario INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
correo VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
rol ENUM(
'Administrador',
'Lider',
'Auxiliar'
) DEFAULT 'Auxiliar',
estado BOOLEAN DEFAULT TRUE,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- TABLA BANCO
-- ==========================================

CREATE TABLE banco (
id_banco INT AUTO_INCREMENT PRIMARY KEY,
nombre_banco VARCHAR(100) NOT NULL,
numero_destino VARCHAR(50),
descripcion VARCHAR(255),
estado BOOLEAN DEFAULT TRUE,
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- TABLA TRANSACCION
-- ==========================================

CREATE TABLE transaccion (
referencia VARCHAR(50) PRIMARY KEY,
fecha DATETIME NOT NULL,
monto DECIMAL(10,2) NOT NULL,
origen VARCHAR(100),
observaciones TEXT,
id_banco INT NOT NULL,

CONSTRAINT fk_transaccion_banco
FOREIGN KEY (id_banco)
REFERENCES banco(id_banco)

);

-- ==========================================
-- TABLA IMAGEN
-- ==========================================

CREATE TABLE imagen (
id_imagen INT AUTO_INCREMENT PRIMARY KEY,
ruta_imagen VARCHAR(255) NOT NULL,
fecha_carga TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
referencia VARCHAR(50),

CONSTRAINT fk_imagen_transaccion
FOREIGN KEY (referencia)
REFERENCES transaccion(referencia)

);

-- ==========================================
-- TABLA VENTA
-- ==========================================

CREATE TABLE venta (
id_venta INT AUTO_INCREMENT PRIMARY KEY,
fecha_venta DATETIME NOT NULL,
total DECIMAL(10,2) NOT NULL,
id_usuario INT NOT NULL,

CONSTRAINT fk_venta_usuario
FOREIGN KEY (id_usuario)
REFERENCES usuario(id_usuario)

);

-- ==========================================
-- TABLA CIERRE_CAJA
-- ==========================================

CREATE TABLE cierre_caja (
id_cierre INT AUTO_INCREMENT PRIMARY KEY,
fecha_cierre DATETIME NOT NULL,
total_ingresos DECIMAL(10,2) NOT NULL,
observaciones TEXT,
id_usuario INT NOT NULL,

CONSTRAINT fk_cierre_usuario
FOREIGN KEY (id_usuario)
REFERENCES usuario(id_usuario)

);

-- ==========================================
-- DATOS INICIALES
-- ==========================================

INSERT INTO banco
(
nombre_banco,
numero_destino,
descripcion
)
VALUES
(
'Nequi',
'3150319111',
'Billetera digital Nequi'
),
(
'Daviplata',
'3001234567',
'Billetera digital Daviplata'
);

INSERT INTO usuario
(
nombre,
correo,
password,
rol
)
VALUES
(
'Administrador Principal',
'admin@scancash.com',
'123456',
'Administrador'
);
