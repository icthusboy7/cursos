<?php

/**
 * CONTROLLER GENERAL
 *
 * @descripcion Controlador "usuarios"
 * @author VICTOR BACA
 * 20/08/2015
 */

include_once("../mvc/BackendBundle/model/ModelBackend.php");
include_once("../db/Connection.php");

class Controller {
	public $model;
	

	public function __construct()
	{
		$this->model = new ModelBackend();
	
	}

	public function usuariosCrud()
	{
		@session_start();
		if ($_SESSION["rol"] == 1)
		{
			$fk_usuario = $_SESSION["iduser"];
			if ( !empty($_POST)) 
			{

				if($_POST['action_type'] == "add")
				{
					$valid = true;
					$dataLogin = $this->model->selectUsuariosByLogin($_POST['login']);
					if($rowLogin = mysql_fetch_array($dataLogin))
					{
						$errorMessage = 'El Login ya existe. Debe usar un login que no exista en el sistema';
			            $valid = false;
					}
					else
					{
						$password = md5(sha1($_POST['password']));
						$verification = base64_encode($_POST['password']);
						$this->model->insertUsuarios($_POST['name'],$_POST['login'],$password,$verification, $_POST['email'], $_POST['perfil'],$_POST['status']);
						$section = "Crear Usuario";
						$description = sprintf('Nombre: %1$s, Login, %2$s, Password: %3$s, email: %4$s, Perfil: %5$s, Estado: %6$s',
	                                $_POST['name'],$_POST['login'],$_POST['password'],$_POST['email'], $_POST['perfil'],$_POST['status']
	                            );
						$fecha = date("Y-m-d H:i:s");
						$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
					}
				}
				

				if($_POST['action_type'] == "edit")
				{
					
					$id_row = $_POST['id_row'];

					$rs = $this->model->selectUsuariosById($id_row);	

				    if($row = mysql_fetch_array($rs))
					{
						$rsPerfil = $this->model->selectPerfilById($row['fk_perfil']);	

					    if($rowPerfil = mysql_fetch_array($rsPerfil))
						{
							$perfilName = $rowPerfil['nombre'];	
						}
						if($row['status'] == "1")
						{
							$status = "Activo";
						}
						else
						{
							$status = "Inactivo";
						}

						$usuariologin = $row['usuario'];

						$verificationDecode = base64_decode($row['verification']);
						$older = sprintf('Valores anteriores ->Código: %1$s, Nombre del usuario: %2$s, Password: %3$s, email: %4$s, Perfil: %5$s, Estado: %6$s',
                                $row['pk_usuario'],
                                $row['nombreUsuario'],
                                $verificationDecode,
                                $row['email'],
                                $perfilName,
                                $status
                            );
					}

					$password = md5(sha1($_POST['password']));
					$verification = base64_encode($_POST['password']);
					$this->model->updateUsuarios($id_row,$_POST['name'], $password, $verification, $_POST['email'],$_POST['perfil'], $_POST['status']);

					if($_POST['status'] == "1")
					{
						$status = "Activo";
					}
					else
					{
						$status = "Inactivo";
					}
					
					$rsPerfil = $this->model->selectPerfilById($_POST['perfil']);	

				    if($rowPerfil = mysql_fetch_array($rsPerfil))
					{
						$perfilName = $rowPerfil['nombre'];	
					}

					$section = "Editar Usuarios";
					$description = sprintf('Código editado:%1$s, Login: %2$s <br> %3$s <br> Valores nuevos -> Nombre Usuario: %4$s, email: %5$s, Perfil: %6$s, Estado: %7$s',
								$_POST['id_row'],
								$usuariologin,
								$older,
                                $_POST['name'],
                                $_POST['email'],
                                $perfilName,
                                $status
                            );
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);
				}

				if($_POST['action_type'] == "delete")
				{
					$id_row = $_POST['id_row'];

					$rs = $this->model->selectUsuariosById($id_row);	

				    if($row = mysql_fetch_array($rs))
					{
						if($row['status'] == "1")
						{
							$status = "Activo";
						}
						else
						{
							$status = "Inactivo";
						}

						$verificationDecode = base64_decode($row['verification']);
						$description = sprintf('Se ha eliminado el usuario con los siguientes valores:
							<br>Código: %1$s, Nombre: %2$s, Login: %3$s, Contraseña: %4$s, email: %5$s, Perfil: %6$s, Estado: %7$s',
								$id_row,$row['nombreUsuario'],$row['usuario'],$verificationDecode,$row['email'],$row['nombrePerfil'], $status
                            );
					}

					$this->model->deleteUsuarios($id_row);

					$section = "Eliminar Usuario";
					$fecha = date("Y-m-d H:i:s");

					$this->model->insertAudit($section, $fecha, $description, $fk_usuario);

				}
			}

			$dataPerfil = array();

			$dataPerfilDB = $this->model->selectPerfilesActivosAll();
			while($rowPerfilDB = mysql_fetch_array($dataPerfilDB))
			{

				$dataPerfil[] = array(
				"pk_perfil" => $rowPerfilDB['pk_perfil'],
				"perfilName" => $rowPerfilDB['nombre']
			    );
			}

			$data = array();

			$dataUsuarios = $this->model->selectUsuariosAll();
			while($row = mysql_fetch_array($dataUsuarios))
			{

				$database = new Database();
				$consulta = $database->selectCount('cursos_usuarios','*','fk_usuario'.'='.$row['pk_usuario']);
				$fila = mysql_fetch_array($consulta);
				
				$database = new Database();
				$consulta2 = $database->selectCount('audit','*','fk_usuario'.'='.$row['pk_usuario']);
				$fila2 = mysql_fetch_array($consulta2);

				$fk_usuario = $fila['numRows'] + $fila2['numRows'];

				$data[] = array(
				"pk_usuario" => $row['pk_usuario'],
				"usuarioName" => $row['usuarioName'],
				"login" => $row['login'],
				"password" => base64_decode($row['verification']),
				"email" => $row['email'],
				"pk_perfil" => $row['pk_perfil'],
				"perfilName" => $row['perfilName'],
				"status" => $row['status'],
				"fk_usuario" => $fk_usuario
			    );
			}

  			include '../mvc/BackendBundle/view/backendusuariosView.php';
	  	}
	  	else
	  	{
	  		echo '<h1>No tiene permisos para acceder a esta página.</h1>';
	  	}
	}			
}
?>
