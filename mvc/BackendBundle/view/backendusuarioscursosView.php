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
            { "orderable": false, "targets": [3,4] },
            { "width": "5%", "targets": [0,4] },
            { "width": "40%", "targets": [1] },
            { "width": "18%", "targets": [3] }
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
                        <li class="active"><a href="usuarios.php">Volver</a></li>
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
                        <h1>Listado de cursos</h1>
                        <h2>Alumno: <?php echo $usuarioNombre; ?></h2>
                    </div>
                    <form action="" method="POST" id="form_grid">
                        <input type="hidden" id="action_type" name="action_type" value="" />
                        <input type="hidden" id="id_curso" name="id_curso" value="" />
                        <input type="hidden" id="id_usuario" name="id_usuario" value="" />
                        <table id="" class="display" cellspacing="0" width="100%">
                            <thead class="thead-columns">
                                <tr>
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Usuario que Asignó el curso</th>
                                    <th>Fecha de asignación</th>
                                    <th><a id="button_excel" title ="Excel" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/xls.png" onclick="excel(6);"></a></th>
                                    
                                </tr>
                                <?php
                                if($valid == false)
                                {
                                ?>
                                <tr>
                                    <th colspan="5">
                                    <span class="help-block" style="color:red"><?php echo $errorMessage;?></span>
                                    </th>
                                </tr>
                                <?php
                                }
                                ?>  
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>
                                    <div class="form-group">
                                            <select class="form-control" required="required" id="curso" name="curso" >
                                            <?php
                                            foreach ($dataCursos as $rowCursos)
                                            {
                                            ?>    
                                                <option value="<?php echo $rowCursos['pk_curso']; ?>" <?php echo $estado == '1'?'selected':'';?>><?php echo $rowCursos['cursoName']; ?></option>
                                            <?php    
                                            }
                                            ?>
                                            </select>
                                    </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <a id="button_add" title ="Agregar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/add.png" onclick="saveCursosUsuariosRow();"></a>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                            </tfoot>

                            <tbody class="tbody-columns">
                                <?php
                                foreach ($data as $row)
                                {
                                ?>
                                <tr style="cursor:pointer" class = "desmarcadoCursoUsuario">
                                    <td><?php echo $row['fk_curso']; ?></td>
                                    <td><?php echo $row['cursoName']; ?></td>
                                    <td><?php echo $row['adminName']; ?></td>
                                    <td><?php echo $row['fecha_asignacion']; ?></td>
                                    <td>
                                           <img title="Desasignar curso" style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/reject.png" onclick="deleteCursosUsuariosRow('<?php echo $row['fk_curso']; ?>',<?php echo $row['fk_usuario']; ?>);">
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