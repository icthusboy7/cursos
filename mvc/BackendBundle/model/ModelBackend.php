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

	public function insertAudit($action, $fecha, $description, $fk_usuario){
		
		$database = new Database();
		$query = '	INSERT audit (action, created_at, description, fk_usuario)
					values(\''.$action.'\',\''.$fecha.'\',\''.$description.'\','.$fk_usuario.')';
		
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

	public function selectFicherosByPkTemaType($pk_tema, $type)
	{
		$database = new Database();
		$query = '	SELECT * FROM ficheros WHERE fk_tema = '.$pk_tema.'
					AND tipo = '.$type.' 
					ORDER BY pk_fichero desc';
					
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertFicheros($fk_tema, $fk_usuario, $descripcion,$dir, $fecha, $tipo, $estado)
	{
		$database = new Database();
		$query = 'INSERT ficheros (fk_tema,fk_usuario, descripcion, directorio, fecha_upload, tipo, status) 
		values('.$fk_tema.','.$fk_usuario.',\''.$descripcion.'\',\''.$dir.'\',\''.$fecha.'\','.$tipo.','.$estado.')';
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectFicherosById($id)
	{
		$database = new Database();
		$query = '	SELECT * FROM ficheros where pk_fichero = '.$id;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function updateFicheros($id,$descripcion,$status)
	{
		$database = new Database();
		$query = '	UPDATE ficheros set 
					descripcion = \''.$descripcion.'\',
					status = '.$status.'
					where pk_fichero = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function deleteFicheros($id)
	{
		$database = new Database();
		$query = '	DELETE FROM ficheros where pk_fichero = '.$id;
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectUsuariosCursosById($id)
	{
		$database = new Database();
		$query = '	SELECT * FROM cursos_usuarios where fk_usuario = '.$id;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

    public function selectUsuariosAll()
	{
		$database = new Database();
		$query = 'SELECT u.pk_usuario as pk_usuario, u.nombre as usuarioName, u.usuario as login, u.password as password,
						 u.verification as verification,
						 u.email as email, u.status as status, p.pk_perfil as pk_perfil, p.nombre as perfilName FROM usuarios u 
		          JOIN perfiles p ON p.pk_perfil = u.fk_perfil
				  ORDER BY pk_usuario desc';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectUsuariosById($id)
	{
		$database = new Database();
		$query = '	SELECT u.pk_usuario as pk_usuario, u.fk_perfil as fk_perfil, u.nombre as nombreUsuario, 
                    u.usuario as usuario, u.password as password, u.verification as verification, u.email as email, u.status as status,
                    p.nombre as nombrePerfil
		            FROM usuarios u JOIN
		            perfiles p ON p.pk_perfil = u.fk_perfil
		            where pk_usuario = '.$id;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

		public function selectUsuariosByLogin($login)
	{
		$database = new Database();
		$query = '	SELECT * FROM usuarios where usuario = \''.$login.'\'';
		
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectCursosUsuariosByPkUsuario($pk_usuario)
	{
		$database = new Database();
		$query = '	SELECT cu.fk_curso as fk_curso, cu.fk_usuario as fk_usuario, cu.fecha_asignacion as fecha_asignacion,
		                   c.nombre as cursoName, u.nombre as adminName FROM cursos_usuarios cu 
		            JOIN cursos c ON c.pk_curso = cu.fk_curso
		            JOIN usuarios u ON u.pk_usuario = cu.fk_admin 
		            WHERE cu.fk_usuario = '.$pk_usuario.'
					ORDER BY cu.fecha_asignacion desc';
					
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectCursosActivosAll()
	{
		$database = new Database();
		$query = 'SELECT * FROM cursos
				  WHERE status = 1
				  ORDER BY nombre asc';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertCursosUsuarios($fk_curso, $fk_usuario, $fk_admin, $fechaAsignacion)
	{
		$database = new Database();
		$query = '	INSERT cursos_usuarios (fk_curso, fk_usuario,fk_admin, fecha_asignacion)
					values('.$fk_curso.','.$fk_usuario.','.$fk_admin.',\''.$fechaAsignacion.'\')';
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

    public function selectCursosUsuariosById($fk_curso, $fk_usuario)
	{
		$database = new Database();
		$query = '	SELECT * FROM cursos_usuarios where fk_curso = '.$fk_curso.' AND fk_usuario = '.$fk_usuario;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function deleteCursosUsuarios($fk_curso, $fk_usuario)
	{
		$database = new Database();
		$query = '	DELETE FROM cursos_usuarios where fk_curso = '.$fk_curso.' AND fk_usuario = '.$fk_usuario;
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectPerfilById($id)
	{
		$database = new Database();
		$query = '	SELECT * FROM perfiles where pk_perfil = '.$id;
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function selectPerfilesActivosAll()
	{
		$database = new Database();
		$query = 'SELECT * FROM perfiles
				  WHERE status = 1
				  ORDER BY pk_perfil desc';
		$consulta = $database->customQuery($query);
		return $consulta;
	}

	public function insertUsuarios($name, $login, $password, $verification,$email, $perfil, $estado)
	{
		$database = new Database();
		$query = '	INSERT usuarios (fk_perfil, nombre,usuario, password, verification, email, status)
					values('.$perfil.',\''.$name.'\',\''.$login.'\',\''.$password.'\',\''.$verification.'\',\''.$email.'\','.$estado.')';
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

		public function updateUsuarios($id,$name, $password, $verification, $email, $perfil, $status)
	{
		$database = new Database();
		$query = '	UPDATE usuarios set 
					nombre = \''.$name.'\',
					password = \''.$password.'\',
					verification = \''.$verification.'\',
					email = \''.$email.'\',
					fk_perfil = '.$perfil.',
					status = '.$status.'
					where pk_usuario = '.$id;
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function deleteUsuarios($pk_usuario)
	{
		$database = new Database();
		$query = '	DELETE FROM usuarios where pk_usuario = '.$pk_usuario;
		
		$consulta = $database->customQuery($query);
		
		return $consulta;
	}

	public function selectAuditAll()
	{
		$database = new Database();
		$query = 'SELECT a.pk_audit as pk_audit, a.created_at as created_at, a.action as action, 
		                 a.description as description, u.nombre as usuarioName FROM audit a JOIN
				  usuarios u ON u.pk_usuario = a.fk_usuario
				  ORDER BY a.pk_audit desc';
		
		$consulta = $database->customQuery($query);
		return $consulta;
	}

}
?>
