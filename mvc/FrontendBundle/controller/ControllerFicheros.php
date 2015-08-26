<?php

/**
 * CONTROLLER FICHEROS
 *
 * @descripcion Controlador "ficheros"
 * @author VICTOR BACA
 * 16/08/2015
 */

include_once("../mvc/FrontendBundle/model/ModelFrontend.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelFrontend();
	
	}			

	public function ficheros()
	{
		@session_start();
		if ($_SESSION["rol"] == 2)
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
					$id_row = $_POST['id_row'];
					$rs = $this->model->selectFicherosById($id_row);

				    if($row = mysql_fetch_array($rs))
					{						
						$section = "Descarga PDF";

						$dataUsuarios = $this->model->selectUsuariosById($fk_usuario);
						if($rowUsuarios = mysql_fetch_array($dataUsuarios))
						{
							$nombreUsuario = $rowUsuarios['nombreUsuario'];
						}

						$description = sprintf('El alumno: %1$s ha descargado el archivo PDF: %2$s <br> Tema: %3$s, Curso: %4$s',
		                                $nombreUsuario,
		                                $row['directorio'],
		                                $temaName,
		                                $cursoName
		                            );

						$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
					}
			}
			
			$data = array();

			$dataDB = $this->model->selectFicherosActivosByPkTemaType($fk_tema, $type);
			while($rowDB = mysql_fetch_array($dataDB))
			{
				$data[] = array(
				"pk_fichero" => $rowDB['pk_fichero'],
				"fk_tema" => $rowDB['fk_tema'],
				"descripcion" => $rowDB['descripcion'],
				"directorio" => $rowDB['directorio']
			    );
			}
		
	  		include '../mvc/FrontendBundle/view/frontendFicherosView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
