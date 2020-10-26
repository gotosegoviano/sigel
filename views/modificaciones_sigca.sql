-- Agregamos procedimiento nuevo --
CREATE DEFINER=`root`@`localhost` PROCEDURE `id13660344_sigca`.`all_hallazgos_id`(IN `idAuditoria` INT)
BEGIN
	select h.idHallazgo as id, h.numero_hallazgo as idHallazgo, h.hallazgo, h.area as nombreArea, h.resultado from hallazgo h where h.id_auditoria = idAuditoria AND h.estatus = "Activado" ORDER BY nombreArea;
END


-- Modificamos las busquedas de usuarios por el último –

DROP PROCEDURE `save_user`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `id13660344_sigca`.`save_user`(IN `nombre` VARCHAR(100), IN `apellido1` VARCHAR(100), IN `apellido2` VARCHAR(100), IN `usuario` VARCHAR(100), IN `pass` VARCHAR(255), IN `area` VARCHAR(100), IN `rol` VARCHAR(20), IN `estatus` VARCHAR(20))
BEGIN
	INSERT INTO usuarios (nombreUsuario, contraseniaUsuario, estatus, rol) VALUES (usuario, pass, estatus, (SELECT idRol FROM rol R WHERE R.nombreRol = rol));
	INSERT INTO integrante_equipo_trabajo (nombre, primerApellido, segundoApellido, idusuario, area) VALUES (nombre, apellido1, apellido2, (SELECT id FROM usuarios U WHERE U.nombreUsuario = usuario ORDER BY id DESC LIMIT 1),(SELECT idArea FROM areas A WHERE A.nombreArea = area));
END
DELIMITER ; 


-- Modificamos el procedimiento almacenado getUser --
DROP PROCEDURE `getUser`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUser`(IN `inUser` VARCHAR(100))
BEGIN
	SELECT U.id, U.nombreUsuario, U.contraseniaUsuario, I.nombre, I.primerApellido,  GROUP_CONCAT(DISTINCT U.rol SEPARATOR ',') as rol, U.estatus 
	FROM usuarios U
	INNER JOIN integrante_equipo_trabajo I
	ON U.id = I.idusuario 
	WHERE U.nombreUsuario = inUser
    GROUP BY nombreUsuario;
END$$
DELIMITER ; 
