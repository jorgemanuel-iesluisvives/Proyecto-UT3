-- Active: 1768136435103@@127.0.0.1@3306@foro

-- Script de creacion de BBDD del proyecto

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
    foto TINYTEXT,
    descripcion TEXT,
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
    texto TEXT NOT NULL,
    imagenes TEXT NOT NULL
);
-----------------------------------------------------------------

-----------------------------------------------------------------
/*
Tabla hilos
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
    usuario VARCHAR(100) NOT NULL,
    anterior INT,
    fecha DATE NOT NULL,
    texto TEXT NOT NULL
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

-------
-- INSERT
-------
USE foro;

------------------------------------------------------------------------
-- USUARIOS
------------------------------------------------------------------------
INSERT INTO usuarios
(password, nombre, foto, descripcion, fecha_creacion, rango, estado)
VALUES
('admin', 'admin', '../recursos/imagenes/default.gif',
 'Administrador del sistema', '2024-01-01', 'Administrador', 'Activada'),

('victor', 'victor', '../recursos/imagenes/default.gif',
 'Usuario de pruebas', '2024-01-02', 'Usuario', 'Activada'),

('jorge', 'jorge', '../recursos/imagenes/default.gif',
 'Moderador del foro', '2024-01-04', 'Moderador', 'Activada');
------------------------------------------------------------------------
-- POSTS
------------------------------------------------------------------------
INSERT INTO posts
(titulo, usuario, fecha, texto, imagenes)
VALUES
('Bienvenidos a RetroGames', 'admin', '2024-02-01',
 'Bienvenidos al foro RetroGames. Aquí hablaremos de videojuegos clásicos.',
 '../recursos/imagenes/default.gif'),

('Mi primer juego retro', 'victor', '2024-02-02',
 'Mi primer juego retro fue el Super Mario Bros de NES.',
 '../recursos/imagenes/default.gif'),

('Mega Drive vs Super Nintendo', 'jorge', '2024-02-03',
 '¿Cuál os parece mejor consola y por qué?',
 '../recursos/imagenes/default.gif'),

('Normas del foro', 'jorge', '2024-02-04',
 'Respetad a los demás usuarios y disfrutad del foro.',
 '../recursos/imagenes/default.gif');

------------------------------------------------------------------------
-- HILOS (RESPUESTAS A POSTS)
------------------------------------------------------------------------

-- Respuestas al post 1
INSERT INTO hilos (post, usuario, anterior, fecha, texto)
VALUES
(1, 'victor', NULL, '2024-02-05',
 'Gracias por crear el foro, tiene muy buena pinta');

-- Respuestas al post 2
INSERT INTO hilos (post, usuario, anterior, fecha, texto)
VALUES
(2, 'admin', NULL, '2024-02-06',
 'Gran elección, Super Mario Bros es historia viva');

-- Respuestas al post 3
INSERT INTO hilos (post, usuario, anterior, fecha, texto)
VALUES
(3, 'jorge', NULL, '2024-02-07',
 'Tema complicado, ambas consolas marcaron una época');

-- Respuestas encadenadas
INSERT INTO hilos (post, usuario, anterior, fecha, texto)
VALUES
(3, 'admin', 3, '2024-02-08',
 'Estoy de acuerdo, depende mucho del tipo de juegos');
