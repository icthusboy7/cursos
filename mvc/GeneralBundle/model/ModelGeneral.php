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
		$query = '	SELECT *
					FROM Usuarios
					WHERE Usuario =  \''.$a_user.'\'
					AND password= \''.$a_passMD5.'\'';
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

}

?>
