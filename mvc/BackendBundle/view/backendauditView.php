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
            { "orderable": false, "targets": [4] },            
            { "width": "50%", "targets": [3] }
            
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
                        <li><a href="usuarios.php">Usuarios</a></li>
                        <li class="active"><a href="audit.php">Auditoría</a></li>
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
                        <h1>Listado de Transacciones</h1>
                    </div>
                    <form action="" method="POST" id="form_grid">
                        <input type="hidden" id="action_type" name="action_type" value="" />
                        <input type="hidden" id="id_row" name="id_row" value="" />
                        <table id="" class="display" cellspacing="0" width="100%">
                            <thead class="thead-columns">
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                    <th>Descripción</th>
                                    <th>
                                        <a id="button_excel" title ="Excel" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/xls.png" onclick="excel(7);"></a>
                                    </th>
                                </tr>  
                            </thead>

                            <tbody class="tbody-columns">
                                <?php
                                foreach ($data as $row)
                                {
                                ?>
                                <tr style="cursor:pointer" class = "desmarcadoCursoUsuario">
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo $row['usuarioName']; ?></td>
                                    <td><?php echo $row['action']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td></td>
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