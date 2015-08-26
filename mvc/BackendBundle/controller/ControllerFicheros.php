<?php

/**
 * CONTROLLER FICHEROS
 *
 * @descripcion Controlador "ficheros"
 * @author VICTOR BACA
 * 16/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}			

	public function ficherosCrud()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{

			$fk_tema=$_REQUEST['id_tema'];

			$type= 1;
			$fecha = date("Y-m-d H:i:s");
			$fk_usuario = $_SESSION["iduser"];

			$dataTemas = $this->model->selectTemasById($fk_tema);
			if($rowTemas = mysql_fetch_array($dataTemas))
			{
				$fk_curso = $rowTemas['fk_curso'];
				$temaName = $rowTemas['nombre'];
				$temaStatus = $rowTemas['status'];

				$dataCursos = $this->model->selectCursosById($fk_curso);
				if($rowCursos = mysql_fetch_array($dataCursos))
				{
					$id_curso = $rowCursos['pk_curso'];
					$cursoName = $rowCursos['nombre'];
					$cursoStatus = $rowCursos['status'];
				}
			}
			
			$valid = true;
			$ruta = "../files/pdf";
			if ( !empty($_POST)) 
			{
				
				if($_POST['action_type'] == "add")
				{
					$nombre = $_FILES['dir']['name'];
					$uploaddir = ''.$ruta;
					$uploadfile = $uploaddir .'/'. $nombre;

			        if (file_exists($uploadfile)) 
			        {
			            $errorMessage = 'Lo sentimos, el archivo ya existe, cargue otro de diferente nombre.';
			            $valid = false;
			        }
					
					if($valid == true)
					{
						if (move_uploaded_file($_FILES['dir']['tmp_name'], $uploadfile)) {
						    
						} 
						else 
						{
						
						}

						$last = $this->model->insertFicheros($fk_tema, $fk_usuario, $_POST['descripcion'], $_POST['file'], $fecha, $type, $_POST['status']);
						$section = "Crear Fichero";
						$description = sprintf('Descripción: %1$s, Estado: %2$s, PDF: %3$s, tema: %4$s, Curso: %5$s',
	                                $_POST['descripcion'],
	                                $_POST['status'],
	                                $_POST['file'],
	                                $temaName,
	                                $cursoName
	                            );
						
						$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
					}
				}
				if($_POST['action_type'] == "edit")
				{

					$id_row = $_POST['id_row'];

					$rs = $this->model->selectFicherosById($id_row);

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
						$older = sprintf('Valores anteriores ->Descripción del archivo: %1$s, Estado: %2$s',
                                $row['descripcion'],
                                $status
                            );
					}

					$this->model->updateFicheros($id_row,$_POST['descripcion'], $_POST['status']);

					if($_POST['status'] == "1")
					{
						$status = "Activo";
					}
					else
					{
						$status = "Inactivo";
					}

					$section = "Editar Ficheros";
					$description = sprintf('Código editado:%1$s, PDF: %2$s, Tema: %3$s, Curso: %4$s<br> %5$s <br> Valores nuevos ->Descripción del fichero: %6$s, Estado: %7$s',
								$_POST['id_row'],
								$row['directorio'],
								$temaName,
                                $cursoName,
								$older,
                                $_POST['descripcion'],
                                $status
                            );

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}

				if($_POST['action_type'] == "delete")
				{
					$id_row = $_POST['id_row'];
					
					$rs = $this->model->selectFicherosById($id_row);

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
						$description = sprintf('Se ha eliminado el fichero con los siguientes valores:
							<br>Código: %1$s, PDF: %2$s, Descripción del fichero: %3$s, Estado: %4$s, Tema: %5$s, Curso: %6$s',
								$row['pk_fichero'],
								$row['directorio'],
                                $row['descripcion'],
                                $status,
                                $temaName,
                                $cursoName
                            );
					}

					$dir = $ruta.'/'.$row['directorio'];

					unlink($dir);

					$this->model->deleteFicheros($id_row);

					$section = "Eliminar Ficheros";

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}
			}

			$data = array();

			$dataDB = $this->model->selectFicherosByPkTemaType($fk_tema, $type);
			while($rowDB = mysql_fetch_array($dataDB))
			{
				$data[] = array(
				"pk_fichero" => $rowDB['pk_fichero'],
				"fk_tema" => $rowDB['fk_tema'],
				"descripcion" => $rowDB['descripcion'],
				"directorio" => $rowDB['directorio'],
				"status" => $rowDB['status']
			    );
			}
		
	  		include '../mvc/BackendBundle/view/backendFicherosView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
