CREATE DATABASE sigel
USE sigel

CREATE TABLE roles(
	`id_rol` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`rol` VARCHAR(50) COMMENT '1 - Administrador, 2 - Estudiante, 3 - Docente',
	`estatus` TINYINT(2)
) 
INSERT INTO roles (`rol`) VALUES ('Administrador'), ('Estudiante'), ('Docente')

CREATE TABLE carreras (
	`id_carrera` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`carrera` VARCHAR(100),
	`estatus` TINYINT(2)
)
INSERT INTO carreras (`carrera`) VALUES ('Ingeniería en Mecatrónica'), ('Ingeniería en Sistemas Computacionales'), ('Ingeniería Industrial'), ('Industrias Alimentarias')

CREATE TABLE usuarios (
	`id_usuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`numero_control` VARCHAR(30) UNIQUE,
	`contrasena` VARCHAR(255),
	`id_rol` INT NOT NULL DEFAULT 2,
	`estatus` TINYINT(2) DEFAULT 1,
	FOREIGN KEY (`id_rol`) REFERENCES roles(`id_rol`)
)

CREATE TABLE datos_usuarios (
	`id_datos_usuarios` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`nombre` VARCHAR(100) NOT NULL,
	`apellido_paterno` VARCHAR(100) NOT NULL,
	`apellido_materno` VARCHAR(100) NOT NULL,
	`id_carrera` INT,
	`grado` CHAR(3),
	`grupo` CHAR(3),
	`correo_electronico` VARCHAR(150),
	`usuario` INT(11) NOT NULL,
	`actualizado` TINYINT(1) DEFAULT 1 COMMENT 'Datos actualizados a la fecha',
	`estatus` TINYINT(2) DEFAULT 1,
	FOREIGN KEY (`id_carrera`) REFERENCES carreras(`id_carrera`)
)

CREATE TABLE tipos_materiales (
	`id_tipo` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`tipo` VARCHAR(100),
	`estatus` TINYINT(2)
)

CREATE TABLE marcas (
	`id_marca` INT NOT  NULL AUTO_INCREMENT PRIMARY KEY,
	`marca` VARCHAR(100),
	`estatus` TINYINT(2)
)

CREATE TABLE categorias (
	`id_categoria` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`categoria` VARCHAR(100),
	`estatus` TINYINT(2)
)

CREATE TABLE materiales (
	`id_material` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`nombre` VARCHAR(100),
	`id_tipo` INT,
	`descripcion` VARCHAR(1000),
	`cantidad` INT,
	`alerta` INT COMMENT 'Minimo aceptable antes de realizar pedido de nuevo material',
	`id_marca` INT,
	`id_categoria` INT,
	`estatus` TINYINT(2),
	FOREIGN KEY (`id_tipo`) REFERENCES tipos_materiales(`id_tipo`),
	FOREIGN KEY (`id_marca`) REFERENCES marcas(`id_marca`),
	FOREIGN KEY (`id_categoria`) REFERENCES categorias(`id_categoria`)
)

CREATE TABLE materiales_danados (
	`id_dano` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`id_material` INT NOT NULL,
	`id_usuario` INT NOT NULL,
	`cantidad` INT NOT NULL,
	`fecha_hora` DATETIME,
	`evidencia` VARCHAR(500),
	`estado` TINYINT(2) DEFAULT (1) COMMENT 'Estado en el que se encuetra la recuperacion del material. 1 - Pendiente, 2 - Recuperado',
	`estatus` TINYINT(2),
	FOREIGN KEY (`id_material`) REFERENCES materiales(`id_material`),
	FOREIGN KEY (`id_usuario`) REFERENCES usuarios(`id_usuario`)
)

INSERT INTO usuarios (`numero_control`, `contrasena`, `id_rol`) VALUES ('administrador', '$2y$10$v2VevinOVSnBWF4nT.PkmOZkE4iT/KxypJoBz6o.S5gk9dRkKTLeC', 1)
INSERT INTO datos_usuarios (`nombre`, `apellido_paterno`, `apellido_materno`, `correo_electronico`, `usuario`) VALUES ('Arturo', 'Olmos', 'Palacios', 'aolmos@itesg.edu.mx', 1)









SELECT U.numero_control, U.id_rol, CONCAT_WS(" ",DU.nombre, DU.apellido_paterno, DU.apellido_materno) as nombre, DU.correo, DU.id_carrera 
FROM usuarios U 
INNER JOIN datos_usuarios DU ON DU.id_usuario = U.id_usuario
WHERE U.numero_control = "18111428"
	
	
SELECT u.id_usuario, u.numero_control, r.rol, u.id_estatus AS estatus, CONCAT_WS(" ", du.nombre, du.apellido_paterno, du.apellido_materno) AS nombre, du.correo, du.id_carrera AS carrera, CONCAT_WS(" ", du.grado, du.grupo) as grupo
FROM usuarios u 
INNER JOIN datos_usuarios du ON u.id_usuario = du.id_usuario
INNER JOIN roles r ON u.id_rol = r.id_rol 
WHERE u.id_estatus = 1 AND u.id_usuario = 1 OR u.numero_control = "administrador";

