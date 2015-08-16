<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "Backend"
 * @author VICTOR BACA
 * 09/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");
include_once("../db/Connection.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}

	public function cursosCrud()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
			$fk_usuario = $_SESSION["iduser"];
			if ( !empty($_POST)) 
			{
				
				if($_POST['action_type'] == "add")
				{
					$last = $this->model->insertCurso($_POST['name'], $_POST['status']);
					$section = "Crear cursos";
					$description = sprintf('Nombre: %1$s, Estado: %2$s',
                                $_POST['name'],
                                $_POST['status']
                            );
					$fecha = date("Y-m-d H:i:s");
					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}
				if($_POST['action_type'] == "edit")
				{

					$id_row = $_POST['id_row'];

					$rs = $this->model->selectCursosById($id_row);	

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
						$older = sprintf('Valores anteriores ->Código: %1$s, Nombre del curso: %2$s, Estado: %3$s',
                                $row['pk_curso'],
                                $row['nombre'],
                                $status
                            );
					}

					$this->model->updateCursos($id_row,$_POST['name'], $_POST['status']);

					if($_POST['status'] == "1")
					{
						$status = "Activo";
					}
					else
					{
						$status = "Inactivo";
					}

					$section = "Editar cursos";
					$description = sprintf('Código editado:%1$s <br> %2$s <br> Valores nuevos -> Nombre del curso: %3$s, Estado: %4$s',
								$_POST['id_row'],
								$older,
                                $_POST['nombre'],
                                $status
                            );
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}

				if($_POST['action_type'] == "delete")
				{
					$id_row = $_POST['id_row'];

					$rs = $this->model->selectCursosById($id_row);	

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
						$description = sprintf('Se ha eliminado el curso con los siguientes valores:
							</br>Código: %1$s, Nombre del curso: %2$s, Estado: %3$s',
								$row['pk_curso'],
                                $row['nombre'],
                                $status
                            );
					}

					$this->model->deleteCursos($id_row);

					$section = "Eliminar cursos";
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);

				}
			}

			$data = array();

			$dataCursos = $this->model->selectCursosAll();
			while($row = mysql_fetch_array($dataCursos))
			{

				$database = new Database();
				$consulta = $database->selectCount('temas','*','fk_curso'.'='.$row['pk_curso']);

				$fila = mysql_fetch_array($consulta);
				$fk_curso = $fila['numRows'];

				$data[] = array(
				"pk_curso" => $row['pk_curso'],
				"nombre" => $row['nombre'],
				"status" => $row['status'],
				"fk_curso" => $fk_curso
			    );
			}

  			include '../mvc/BackendBundle/view/backendcursosView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}	

	public function addcursos()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{			
			if ( !empty($_POST)) 
			{
		        $fnameError     = null;
		        $statusError    = null;
		        
		        $fname  = $_POST['inputFName'];
		        $status = $_POST['inputStatus'];
		        
		        $valid = true;
		        if(empty($fname)) {
		            $fnameError = 'Porfavor ingrese el nombre';
		            $valid = false;
		        }
		        
		        
		        if(empty($status)) {
		            $statusError = 'Porfavor ingrese el estado del curso';
		            $valid = false;
		        }
		        if ($valid == true)
		        {
					//$this->model->insertCursos($_POST['inputFName'],$_POST['inputStatus']);
					$section = "Crear cursos";
					$description = sprintf('ID:%1$s, Nombre: %2$s, Estado: %3$s',
                                'prueba',
                                $_POST['inputFName'],
                                $_POST['inputStatus']
                            );
					$fk_usuario = $_SESSION["iduser"];
					echo $description." ".$fk_usuario;die();
					$this->model->insertAudit($section, $description, $fk_usuario);
					header("Location: cursos.php");
		        }
			    else
			    {
			    	include '../mvc/BackendBundle/view/cursosaddView.php';
			    }
		    }
			
			else
			{
	  			include '../mvc/BackendBundle/view/cursosaddView.php';
	  		}

	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}		
}
?>
