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

			$rs = $this->model->getDataByLogin($a_user,$a_pass);

			if($row = mysql_fetch_array($rs))
			{
				
				//$_SESSION["rol"]= $row['fk_perfil'];*/
				header("Location: public/menu.php");	
			} 
			else 
			{ // USER AND PASS NO VALIDOS
				echo "pueba22";die();
				exit();
			}
		}

	  	include 'mvc/GeneralBundle/view/indexView.php';
	}	

}

?>
