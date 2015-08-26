<?php

/**
 * CONTROLLER frontend Cursos
 *
 * @descripcion Controlador "Frontend Cursos"
 * @author VICTOR BACA
 * 25/08/2015
 */

include_once("../mvc/FrontendBundle/model/ModelFrontend.php");
include_once("../db/Connection.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelFrontend();
	
	}

	public function cursos()
	{
		@session_start();
		if ($_SESSION["rol"] == 2)
		{
			$fk_usuario = $_SESSION["iduser"];
			$data = array();

			$dataCursos = $this->model->selectCursosByUsuario($fk_usuario);
			while($row = mysql_fetch_array($dataCursos))
			{
				$data[] = array(
				"pk_curso" => $row['pk_curso'],
				"cursoName" => $row['cursoName']
			    );
			}

  			include '../mvc/FrontendBundle/view/frontendcursosView.php';
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
