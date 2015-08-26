<?php

/**
 * CONTROLLER AUDIT
 *
 * @descripcion Controlador "Audit"
 * @author VICTOR BACA
 * 24/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");
include_once("../db/Connection.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}

	public function audit()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
			$fk_usuario = $_SESSION["iduser"];
			
			$data = array();

			$dataAudit = $this->model->selectAuditAll();
			while($row = mysql_fetch_array($dataAudit))
			{
				$data[] = array(
				"pk_audit" => $row['pk_audit'],
				"created_at" => date( "Y-m-d H:i:s",strtotime($row['created_at'])),
				"usuarioName" => $row['usuarioName'],
				"action" => $row['action'],
				"description" => $row['description']
			    );
			}

  			include '../mvc/BackendBundle/view/backendauditView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
