<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "General" index.php
 * @author VICTOR BACA
 * 04/08/2015
 */

include_once("mvc/GeneralBundle/model/ModelGeneral.php");

class Controller {
	public $model;

	public function __construct()
	{
		$this->model = new ModelGeneral();

	}

	public function indexPrincipal()
	{

		if (isset($_POST['usuario']) and isset($_POST['password']) ) 
		{
			$a_user = htmlentities($_POST['usuario'], ENT_QUOTES);
			$a_pass = htmlentities($_POST['password'], ENT_QUOTES);

			$a_passMD5 = md5(sha1($a_pass));
			
			$rs = $this->model->getDataByLogin($a_user,$a_passMD5);

			if($row = mysql_fetch_array($rs))
			{
				session_start();
				$_SESSION["iduser"]= $row['pk_usuario'];
				$_SESSION["rol"]= $row['pk_perfil'];
				$_SESSION["nombreUsuario"]= $row['nombreUsuario'];
				$_SESSION["nombrePerfil"]= $row['nombrePerfil'];

				$section = "Inicio de sesión";
				$fecha = date("Y-m-d H:i:s");
				$description = sprintf('El usuario %1$s con perfil %2$s ha iniciado sesión', $row['nombreUsuario'], $row['nombrePerfil']);
				$this->model->insertAudit($section, $fecha, $description, $row['pk_usuario']);

				if($row['pk_perfil'] == 1)
				{
					
					header("Location: backend/cursos.php");
				}
				else
				{
					header("Location: frontend/cursos.php");
				}

			} 
			else 
			{
				$_POST["validUser"] = false;
			}
		}

		if($_GET["logout"]==true){
			session_start();
			$section = "Fin de sesión";
			$fecha = date("Y-m-d H:i:s");
			$description = sprintf('El usuario %1$s con perfil %2$s ha finalizado la sesión', $_SESSION["nombreUsuario"], $_SESSION["nombrePerfil"]);
			$this->model->insertAudit($section, $fecha, $description, $_SESSION["iduser"]);
			session_destroy();	  		  		
	  	}

	  	include 'mvc/GeneralBundle/view/indexView.php';
	}	

}

?>
