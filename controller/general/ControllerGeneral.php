<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "General" index.php
 * @author VICTOR BACA
 * 04/08/2015
 */

include_once("model/general/ModelGeneral.php");

class Controller {
	public $model;

	public function __construct()
	{
		$this->model = new ModelGeneral();

	}

	public function indexPrincipal()
	{

	  	include 'view/general/indexView.php';
	}	

}

?>
