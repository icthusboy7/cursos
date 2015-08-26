<?php
    include_once("../db/Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Cursos</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<!-- css -->

<link rel="stylesheet" type="text/css" href="../media/css/jquery.dataTables.css">

<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />
<link href="../css/skins/default.css" rel="stylesheet" />

<script src="../js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/functions.js"></script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" language="javascript" src="../media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('table.display').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "columnDefs": 
        [
            { "orderable": false, "targets": [6,7,8,9] },            
            { "width": "17%", "targets": [5] },
            { "width": "13%", "targets": [6] }
            
        ],
        "order": [[ 0, "desc" ]]
    } );
} );
</script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<style>
    tfoot {
        display: table-header-group;
    }
</style>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="menu.php">FORMACION <span>C</span>ILANTROIT</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="cursos.php">Cursos</a></li>
                        <li class="active"><a href="usuarios.php">Usuarios</a></li>
                        <li><a href="audit.php">Auditoría</a></li>
                        <li><a href="../index.php?logout=true">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->
	<section id="featured">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12">
                    <div>
                        <h1>Listado de Usuarios</h1>
                    </div>
                    <form action="" method="POST" id="form_grid">
                        <input type="hidden" id="action_type" name="action_type" value="" />
                        <input type="hidden" id="id_row" name="id_row" value="" />
                        <table id="" class="display" cellspacing="0" width="100%">
                            <thead class="thead-columns">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Login</th>
                                    <th>Contraseña</th>
                                    <th>Email</th>
                                    <th>Perfil</th>
                                    <th>Estado</th>
                                    <th><a id="button_excel" title ="Excel" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/xls.png" onclick="excel(5);"></a></th>
                                    <th><a id="button_undo" title ="Deshacer edición" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/undo.png" onclick="buttonUndoUsuarios();"></a></th>
                                    <th></th>
                                </tr>  
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" id="name" name="name" style="width:100%;"/>
                                    </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="required" id="login" name="login" style="width:100%;"/>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="required" id="password" name="password" style="width:100%;"/>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="required" id="email" name="email" style="width:100%;"/>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <select class="form-control" required="required" id="perfil" name="perfil" >
                                            <?php
                                            foreach ($dataPerfil as $rowPerfil)
                                            {
                                            ?>    
                                                <option value="<?php echo $rowPerfil['pk_perfil']; ?>"><?php echo $rowPerfil['perfilName']; ?></option>
                                            <?php    
                                            }
                                            ?>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            </select>
                                            <select class="form-control" required="required" id="status" name="status" >
                                            <option value="1" <?php echo $estado == '1'?'selected':'';?>>Activo</option>
                                            <option value="2" <?php echo $estado == '2'?'selected':'';?>>Inactivo</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <a id="button_add" title ="Agregar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/add.png" onclick="saveUsuariosRow();"></a>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <a id="button_edit" title ="Guardar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/save.png" onclick="saveUsuariosRow();"></a>
                                        </div>
                                    </th>
                                    <th></th>
                                </tr>
                                <?php
                                if($valid == false)
                                {
                                ?>
                                <tr>
                                    <th colspan="10">
                                    <span class="help-block" style="color:red"><?php echo $errorMessage;?></span>
                                    </th>
                                </tr>
                                <?php
                                }
                                ?>
                            </tfoot>

                            <tbody class="tbody-columns">
                                <?php
                                foreach ($data as $row)
                                {
                                ?>
                                <tr style="cursor:pointer" class = "desmarcadoCursoUsuario">
                                    <td><?php echo $row['pk_usuario']; ?></td>
                                    <td><?php echo $row['usuarioName']; ?></td>
                                    <td><?php echo $row['login']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['perfilName']; ?></td>
                                    <td><?php 
                                    
                                        if($row['status'] == 1)
                                        {
                                            echo "Activo";
                                        }
                                        else
                                        {
                                            echo "Inactivo";
                                        }
                                         ?>
                                    </td>
                                    <td>
                                        <img title="Editar" style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/edit.png" onclick="editUsuariosRow('<?php echo $row['pk_usuario']; ?>','<?php echo $row['usuarioName']; ?>','<?php echo $row['login']; ?>','<?php echo $row['password']; ?>','<?php echo $row['email']; ?>','<?php echo $row['pk_perfil']; ?>','<?php echo $row['status']; ?>');">
                                    </td>
                                    <td>
                                        <?php 
                                        if($row['fk_usuario'] > 0)
                                        {
                                            echo "";
                                        }
                                        else
                                        {
                                        ?>
                                           <img title="Eliminar" style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/del.png" onclick="deleteRow('<?php echo $row['pk_usuario']; ?>','usuario');">
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if($row['pk_perfil'] == 1)
                                        {
                                            echo "";
                                        }
                                        else
                                        {
                                        ?>
                                            <a id="button_file" title ="Archivos" href= "../backend/usuarioscursos.php?id_usuario=<?php echo $row['pk_usuario']; ?>" target="_top"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/file.png"></a>
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>    
                    </form>
    	       </div>               
    	   </div>
    	</div>	
	</section>
	<footer>
		<div class="container">
			<div class="copyright">
				<p>
					<span><b><?php echo $_SESSION["nombrePerfil"] ?></b> | <?php echo $_SESSION["nombreUsuario"] ?> &copy; Todos los derechos reservados. Por </span><a href="http://www.cilantroit.com" target="_blank">CilantroIT</a>
				</p>
			</div>
		</div>
	</footer>
</div>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>