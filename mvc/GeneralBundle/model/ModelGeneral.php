<?php

include_once("db/Connection.php");

class ModelGeneral {
	
	private $tableNameUsers =  'Usuarios'; // Nombre de la tabla donde estan los usuarios /user and pass
	
	/*
	 * GESTION DEL LOGIN
	 * Obtiene parametros por pot y hace set de los parametros
	 */

	public function getDataByLogin($a_user,$a_passMD5){
		
		$database = new Database();
		$query = '	SELECT u.pk_usuario as pk_usuario, u.nombre as nombreUsuario, u.status as statusUsuario,
                    p.pk_perfil as pk_perfil, p.nombre as nombrePerfil, p.status as estadoPerfil
					FROM Usuarios u
					JOIN Perfiles p
					ON p.pk_perfil = u.fk_perfil
					WHERE u.usuario =  \''.$a_user.'\'
					AND u.password= \''.$a_passMD5.'\' 
					AND u.status = 1';
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

}

?>
