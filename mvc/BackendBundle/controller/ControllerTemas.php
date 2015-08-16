<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "temas"
 * @author VICTOR BACA
 * 14/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}

	public function temasFrame()
	{
		
		
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
			$ruta="../backend/temas.php?id_curso=";
			$pk_curso=$_POST['q'];
	  		include '../mvc/BackendBundle/view/backendtemasFrameView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			

	public function temasCrud()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{

			$pk_curso=$_REQUEST['id_curso'];

			$dataCursos = $this->model->selectCursosById($pk_curso);
			if($rowCursos = mysql_fetch_array($dataCursos))
			{
				$id_curso = $rowCursos['pk_curso'];
				$cursoName = $rowCursos['nombre'];
				$cursoStatus = $rowCursos['status'];
			}

			if ( !empty($_POST)) 
			{
				
				if($_POST['action_type'] == "add")
				{
					$last = $this->model->insertTemas($_POST['id_curso'], $_POST['name'], $_POST['status']);
					$section = "Crear Temas";
					$description = sprintf('Nombre: %1$s, Estado: %2$s, Curso: %3$s',
                                $_POST['name'],
                                $_POST['status'],
                                $cursoName
                            );
					$fk_usuario = $_SESSION["iduser"];
					$fecha = date("Y-m-d H:i:s");
					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}
				if($_POST['action_type'] == "edit")
				{

					$id_row = $_POST['id_row'];

					$rs = $this->model->selectTemasById($id_row);	

				    if($row = mysql_fetch_array($rs))
					{
						if($row['status'] == "1")
						{
							$status = "Activo";
						}
						else
						{
							$status = "Inactivo";
						}
						$older = sprintf('Valores anteriores ->Nombre del tema: %1$s, Estado: %2$s, Curso: %3$s',
                                $row['nombre'],
                                $status,
                                $cursoName
                            );
					}

					$this->model->updateTemas($id_row,$_POST['name'], $_POST['status']);

					if($_POST['status'] == "1")
					{
						$status = "Activo";
					}
					else
					{
						$status = "Inactivo";
					}

					$section = "Editar temas";
					$description = sprintf('Código editado:%1$s <br> %2$s <br> Valores nuevos -> Nombre del tema: %3$s, Estado: %4$s, Curso: %5$s',
								$_POST['id_row'],
								$older,
                                $_POST['name'],
                                $status,
                                $cursoName
                            );
					$fk_usuario = $_SESSION["iduser"];
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}

				if($_POST['action_type'] == "delete")
				{
					$id_row = $_POST['id_row'];
					//echo $id_row;die();
					$rs = $this->model->selectTemasById($id_row);	

				    if($row = mysql_fetch_array($rs))
					{
						if($row['status'] == "1")
						{
							$status = "Activo";
						}
						else
						{
							$status = "Inactivo";
						}
						$description = sprintf('Se ha eliminado el tema con los siguientes valores:
							</br>Código: %1$s, Nombre del tema: %2$s, Estado: %3$s, Curso: %4$s',
								$row['pk_curso'],
                                $row['nombre'],
                                $status,
                                $cursoName
                            );
					}

					$this->model->deleteTemas($id_row);

					$section = "Eliminar temas";
					$fk_usuario = $_SESSION["iduser"];
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}
			}

			$data = array();

			$dataDB = $this->model->selectTemasByPkCurso($pk_curso);
			while($rowDB = mysql_fetch_array($dataDB))
			{
				$database = new Database();
				$consulta = $database->selectCount('ficheros','*','fk_tema'.'='.$rowDB['pk_tema']);

				$fila = mysql_fetch_array($consulta);
				$fk_tema = $fila['numRows'];

				$data[] = array(
				"pk_tema" => $rowDB['pk_tema'],
				"fk_curso" => $rowDB['fk_curso'],
				"nombre" => $rowDB['nombre'],
				"status" => $rowDB['status'],
				"fk_tema" => $fk_tema
			    );
			}
		
	  		include '../mvc/BackendBundle/view/backendtemasView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
