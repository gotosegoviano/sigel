SELECT U.numero_control, U.id_rol, CONCAT_WS(" ",DU.nombre, DU.apellido_paterno, DU.apellido_materno) as nombre, DU.correo, DU.id_carrera 
	FROM usuarios U 
	INNER JOIN datos_usuarios DU ON DU.id_usuario = U.id_usuario
	WHERE U.numero_control = "18111428"
	
	
	SELECT u.id_usuario, u.numero_control, r.rol, u.id_estatus AS estatus, CONCAT_WS(" ", du.nombre, du.apellido_paterno, du.apellido_materno) AS nombre, du.correo, du.id_carrera AS carrera, CONCAT_WS(" ", du.grado, du.grupo) as grupo
	FROM usuarios u 
	INNER JOIN datos_usuarios du ON u.id_usuario = du.id_usuario
	INNER JOIN roles r ON u.id_rol = r.id_rol 
	WHERE u.id_estatus = 1 AND u.id_usuario = 1 OR u.numero_control = "administrador";