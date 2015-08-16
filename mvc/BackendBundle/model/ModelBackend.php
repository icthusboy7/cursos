<?php

include_once("../db/Connection.php");

class ModelBackend {

	public function selectCursosAll()
	{
		$database = new Database();
		$query = 'SELECT * FROM cursos
				  ORDER BY pk_curso desc';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function countTemasByIDcurso($id)
	{
		$database = new Database();
		$query = 'select count(pk_tema) as NumRows from temas where fk_curso = '.$id;

		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectCursosById($id)
	{
		$database = new Database();
		$query = '	SELECT * FROM cursos where pk_curso = '.$id;
		
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertCursos($nombre,$estado)
	{
		$database = new Database();
		$query = '	INSERT cursos (nombre, status)
					values(\''.$nombre.'\','.$estado.')';
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function updateCursos($id,$name,$status)
	{
		$database = new Database();
		$query = '	UPDATE cursos set 
					nombre = \''.$name.'\',
					status = '.$status.'
					where pk_curso = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function deleteCursos($id)
	{
		$database = new Database();
		$query = '	DELETE FROM cursos where pk_curso = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function insertAudit($section, $fecha, $description, $fk_usuario){
		
		$database = new Database();
		$query = '	INSERT audit (section, created_at, description, fk_usuario)
					values(\''.$section.'\',\''.$fecha.'\',\''.$description.'\','.$fk_usuario.')';
		
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectTemasByPkCurso($pk_curso)
	{
		$database = new Database();
		$query = '	SELECT * FROM temas WHERE fk_curso = '.$pk_curso.' 
					ORDER BY pk_tema desc';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectTemasByPkCurso2($pk_curso)
	{
		$database = new Database();
		$query = '	SELECT * FROM temas WHERE fk_curso = '.$pk_curso;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertTemas($fk_curso, $nombre,$estado)
	{
		$database = new Database();
		$query = '	INSERT temas (fk_curso,nombre, status)
					values('.$fk_curso.',\''.$nombre.'\','.$estado.')';
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function updateTemas($id,$name,$status)
	{
		$database = new Database();
		$query = '	UPDATE temas set 
					nombre = \''.$name.'\',
					status = '.$status.'
					where pk_tema = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function deleteTemas($id)
	{
		$database = new Database();
		$query = '	DELETE FROM temas where pk_tema = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectTemasById($id)
	{
		$database = new Database();
		$query = '	SELECT * FROM temas where pk_tema = '.$id;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertRow($tableName, $data)
	{
		$database = new Database();
		return $database->insert($tableName,$data);
	}

	public function insertCurso($nombre, $status){
		$database = new Database();
		$query = '	INSERT cursos (nombre, status)
					values(\''.$nombre.'\','.$status.')';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

}
?>
