<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "Principal"
 * @author VICTOR BACA
 * 06/08/2015
 */

include_once("../mvc/PrincipalBundle/model/ModelPrincipal.php");

class Controller {
	public $model;

	public function __construct()
	{
		$this->model = new ModelPrincipal();

	}

    public function menuPrincipal()
	{
		@session_start();
		if ($_SESSION["rol1"] == 1)
		{
	  		include '../mvc/PrincipalBundle/view/menuView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta pagina.</h1>';
	  	}
	}		
}
?>
