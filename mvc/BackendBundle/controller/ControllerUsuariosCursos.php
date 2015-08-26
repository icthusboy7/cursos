<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "Usuarios_Cursos"
 * @author VICTOR BACA
 * 21/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}			

	public function usuariosCursosCrud()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
			
			$pk_usuario=$_GET['id_usuario'];

			$fk_usuario = $_SESSION["iduser"];
			
			$dataUsuarios = $this->model->selectUsuariosById($pk_usuario);
			if($rowUsuarios = mysql_fetch_array($dataUsuarios))
			{
				$usuarioNombre = $rowUsuarios['nombreUsuario'];
			}

			$dataAdmin = $this->model->selectUsuariosById($fk_usuario);
			if($rowAdmin = mysql_fetch_array($dataAdmin))
			{
				$adminNombre = $rowAdmin['nombreUsuario'];
			}

			$valid = true;
			if ( !empty($_POST)) 
			{
				 
				if($_POST['action_type'] == "add")
				{
					
					$fecha = date("Y-m-d H:i:s");
					$dataCursosUsuarios = $this->model->selectCursosUsuariosById($_POST['curso'], $pk_usuario);
					if($rowCursosUsuarios = mysql_fetch_array($dataCursosUsuarios))
					{
						$errorMessage = 'El curso ya está asignado. Porfavor, asigne otro.';
			            $valid = false;
					}
					else
					{
						$dataCursos = $this->model->selectCursosById($_POST['curso']);
						if($rowCursos = mysql_fetch_array($dataCursos))
						{
							$cursoNombre = $rowCursos['nombre'];
						}

						$this->model->insertCursosUsuarios($_POST['curso'], $pk_usuario, $fk_usuario, $fecha);
						$section = "Asignar curso";
						$description = sprintf('Curso: %1$s, Alumno: %2$s, Usuario que asignó: %3$s, Fecha de asignación: %4$s',
	                                $cursoNombre,
	                                $usuarioNombre,
	                                $adminNombre,
	                                date( "Y-m-d",strtotime($fecha))
	                            );
						
						$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
					}
				}
				

				if($_POST['action_type'] == "delete")
				{
					$id_curso = $_POST['id_curso'];
					$id_usuario = $_POST['id_usuario'];
					
					$rs = $this->model->selectCursosById($id_curso);	

				    if($row = mysql_fetch_array($rs))
					{
						$description = sprintf('Se ha desasignado el curso %1$s al alumno %2$s. Usuario que la desasigna: %3$s',
								$row['nombre'],
                                $usuarioNombre,
                                $adminNombre
                            );
					}

					$this->model->deleteCursosUsuarios($id_curso, $id_usuario);

					$section = "Desasignar cursos";
					$fk_usuario = $_SESSION["iduser"];
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}
			}

			$dataCursos = array();

			$dataCursosDB = $this->model->selectCursosActivosAll();
			while($rowCursosDB = mysql_fetch_array($dataCursosDB))
			{
				$database = new Database();

				$dataCursos[] = array(
				"pk_curso" => $rowCursosDB['pk_curso'],
				"cursoName" => $rowCursosDB['nombre']
			    );
			}



			$data = array();

			$dataDB = $this->model->selectCursosUsuariosByPkUsuario($pk_usuario);
			while($rowDB = mysql_fetch_array($dataDB))
			{
				$database = new Database();

				$data[] = array(
				"fk_curso" => $rowDB['fk_curso'],
				"fk_usuario" => $rowDB['fk_usuario'],
				"fecha_asignacion" => date( "Y-m-d",strtotime($rowDB['fecha_asignacion'])),
				"cursoName" => $rowDB['cursoName'],
				"adminName" => $rowDB['adminName']
			    );
			}
		
	  		include '../mvc/BackendBundle/view/backendusuarioscursosView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
