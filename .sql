CREATE TABLE usuarios (
    usuario_id SERIAL PRIMARY KEY,
    usuario_nombres VARCHAR(255),
    usuario_apellidos VARCHAR(255),
    usuario_nit INT,
    usuario_telefono INT,
    usuario_correo VARCHAR(100),
    usuario_estado CHAR(1),
    usuario_situacion SMALLINT DEFAULT 1
)

CREATE TABLE productos (
    producto_id SERIAL PRIMARY KEY,
    producto_nombre VARCHAR(100) NOT NULL,
    producto_cantidad INT NOT NULL,
    producto_categoria VARCHAR(20) NOT NULL, -- Alimentos, Higiene, Hogar
    producto_prioridad VARCHAR(10) NOT NULL, -- Alta, Media, Baja
    producto_estado SMALLINT DEFAULT 0, -- 0: pendiente, 1: comprado
    producto_situacion SMALLINT DEFAULT 1 -- Para control de eliminación
);