
--Script de creacion de BBDD del proyecto

-- Creacion de la base de datos
------------------------------------------------------------------------
DROP DATABASE IF EXISTS foro;
CREATE DATABASE foro;
USE foro;
------------------------------------------------------------------------

-- Creacion de tablas
------------------------------------------------------------------------

-----------------------------------------------------------------

/*
Tabla usuarios
    Columnas:
        - id : INT
        - password : VARCHAR
        - nombre : VARCHAR
        - foto : tinytext
        - descripcion : text
        - fecha_creacion : DATE
        - rango : ENUM ("Administrador", "Moderador", "Usuario")
        - estado : ENUM ("Activada", "Desactivada", "Baneada")
*/

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    foto tinytext,
    descripcion text,
    fecha_creacion DATE NOT NULL,
    rango ENUM ("Administrador", "Moderador", "Usuario"),
    estado ENUM ("Activada", "Desactivada", "Baneada")
);

-----------------------------------------------------------------

-----------------------------------------------------------------

/*
Tabla posts
    Columnas:
        - id : INT
        - usuario : VARCHAR --Relacionado con usuarios/nombre
        - titulo : VARCHAR
        - fecha : DATE
        - texto : text
        - imagenes : TEXT
*/

CREATE TABLE posts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL, 
    usuario VARCHAR(100) NOT NULL, 
    fecha DATE NOT NULL,
    texto text NOT NULL,
    imagenes TEXT NOT NULL

);

-----------------------------------------------------------------

-----------------------------------------------------------------

/*
Tabla threads
    Columnas:
        - id : INT
        - post : INT --Relacionado con posts/id
        - usuario : VARCHAR --Relacionado con usuarios/nombre
        - anterior : INT
        - fecha : DATE
        - texto : text

*/

CREATE TABLE hilos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    post INT NOT NULL, 
    usuario VARCHAR(100) NOT NULL UNIQUE, 
    anterior INT,
    fecha DATE NOT NULL,
    texto text NOT NULL
);

-----------------------------------------------------------------

------------------------------------------------------------------------

-- Creacion de relaciones de tablas
------------------------------------------------------------------------

-----------------------------------------------------------------

/* 
Relaciona la columna usuario de la tabla posts
con la columna nombre de la tabla usuarios
*/

ALTER TABLE posts
    ADD CONSTRAINT AUTOR_POST FOREIGN KEY (usuario) 
    REFERENCES usuarios(nombre)
    ON DELETE CASCADE ON UPDATE CASCADE;

-----------------------------------------------------------------

-----------------------------------------------------------------

/* 
Relaciona la columna usuario de la tabla hilos
con la columna nombre de la tabla usuarios
y la columna post de la tabla hilos
con la columna id de la tabla posts
*/

ALTER TABLE hilos
    ADD CONSTRAINT AUTOR_HILO FOREIGN KEY (usuario) 
    REFERENCES usuarios(nombre)
    ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT POST_HILO FOREIGN KEY (post) 
    REFERENCES posts(id)
    ON DELETE CASCADE ON UPDATE CASCADE;  

-----------------------------------------------------------------

------------------------------------------------------------------------
