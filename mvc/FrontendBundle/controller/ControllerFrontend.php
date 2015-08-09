<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "Frontend"
 * @author VICTOR BACA
 * 06/08/2015
 */

include_once("../mvc/FrontendBundle/model/ModelFrontend.php");

class Controller {
	public $model;

	public function __construct()
	{
		$this->model = new ModelFrontend();

	}

    public function menuFrontend()
	{
		@session_start();
		if ($_SESSION["rol"] == 2)
		{
			
	  		include '../mvc/FrontendBundle/view/frontendmenuView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}		
}
?>
