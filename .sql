CREATE TABLE productos (
    producto_id SERIAL PRIMARY KEY,
    producto_nombre VARCHAR(100) NOT NULL,
    producto_cantidad INT NOT NULL,
    producto_categoria CHAR(1) NOT NULL, -- Alimentos, Higiene, Hogar
    producto_prioridad CHAR(1) NOT NULL, -- Alta, Media, Baja
    producto_situacion SMALLINT DEFAULT 1 -- Para control de eliminación
);