<?php

include_once("../db/Connection.php");

class ModelPrincipal {
	
	private $tableNameUsers =  'Usuarios'; // Nombre de la tabla donde estan los usuarios /user and pass
	
	/*
	 * GESTION DEL LOGIN
	 * Obtiene parametros por pot y hace set de los parametros
	 */
	
		public function gestionLogin($a_user,$a_pass){
		//transformamos los datos recibidos en entidades html para evitar inyecciones sql
		
		
		session_start();
		$identificador = session_id();
		
		$database = new Database();
		$whereClause = $this->tableNameUsers.'.usuario =\''.$a_user.'\' and '.$this->tableNameUsers.'.password =\''.$a_pass.'\'';
		
		$numRows = $database->selectCount($this->tableNameUsers,'*',$whereClause);
		$consulta = mysql_fetch_array($numRows);
		$fila = $consulta['numRows'];
		
		return $fila;
		
	}

}

?>
