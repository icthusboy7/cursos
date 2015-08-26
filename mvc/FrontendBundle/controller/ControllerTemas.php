<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "temas"
 * @author VICTOR BACA
 * 14/08/2015
 */

include_once("../mvc/FrontendBundle/model/ModelFrontend.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelFrontend();
	
	}

	public function temasFrame()
	{
		
		
		@session_start();
		if ($_SESSION["rol"] == 2)
		{
			$ruta="../frontend/temas.php?id_curso=";
			$pk_curso=$_POST['q'];
	  		include '../mvc/FrontendBundle/view/frontendtemasFrameView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			

	public function temas()
	{
		@session_start();
		
		if ($_SESSION["rol"] == 2)
		{

			$pk_curso=$_REQUEST['id_curso'];

			$dataCursos = $this->model->selectCursosById($pk_curso);
			if($rowCursos = mysql_fetch_array($dataCursos))
			{
				$id_curso = $rowCursos['pk_curso'];
				$cursoName = $rowCursos['nombre'];
				$cursoStatus = $rowCursos['status'];
			}


			$data = array();

			$dataDB = $this->model->selectTemasActivosByPkCurso($pk_curso);
			while($rowDB = mysql_fetch_array($dataDB))
			{

				$data[] = array(
				"pk_tema" => $rowDB['pk_tema'],
				"fk_curso" => $rowDB['fk_curso'],
				"nombre" => $rowDB['nombre']
			    );
			}
		
	  		include '../mvc/FrontendBundle/view/FrontendtemasView.php';
	  		
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
