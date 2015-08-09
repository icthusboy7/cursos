<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "Backend"
 * @author VICTOR BACA
 * 09/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");

class Controller {
	public $model;

	public function __construct()
	{
		$this->model = new ModelBackend();

	}

    public function menuBackend()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
	  		include '../mvc/BackendBundle/view/backendmenuView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}		
}
?>
