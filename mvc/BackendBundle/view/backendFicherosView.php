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
            { "orderable": false, "targets": [3,4,5] },
            { "width": "5%", "targets": [0,4,5] },
            { "width": "30%", "targets": [1] },
            { "width": "15%", "targets": [2] },
            { "width": "30%", "targets": [3] }
        ],
        "order": [[ 0, "desc" ]]
    } );
} );
</script>

<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script> 
</head>
<style>
    tfoot {
        display: table-header-group;
    }
    
    
</style>  

       <body>
        <div id="wrapper">

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
                        <li class="active"><a href="cursos.php">Volver</a></li>
                        <li><a href="../index.php?logout=true">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

<section id="featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h1>Listado de ficheros PDF</h1>
                        <h2>CURSO: <?php echo $cursoName; ?> TEMA: <?php echo $temaName; ?></h2>
                    </div>
                    <form enctype="multipart/form-data" action="" method="POST" id="form_grid">
                        <input type="hidden" id="action_type" name="action_type" value="" />
                        <input type="hidden" id="id_row" name="id_row" value="" />
                    <table id="" class="display" cellspacing="0" width="100%">
                            <thead class="thead-columns">
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>PDF</th>
                                    <th><a id="button_excel" title ="Excel" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/xls.png" onclick="excel(3);"></a></th>
                                    <th><a id="button_undo" title ="Deshacer edición" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/undo.png" onclick="buttonFicherosUndo();"></a></th>
                                </tr>  
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" id="descripcion" name="descripcion" style="width:100%;"/>
                                    </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <select class="form-control" required="required" id="status" name="status" >
                                            <option value="1" <?php echo $estado == '1'?'selected':'';?>>Activo</option>
                                            <option value="2" <?php echo $estado == '2'?'selected':'';?>>Inactivo</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                                <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-primary btn-file">                    
                                                        Browse&hellip; <input type="file" accept="application/pdf" id="dir" name="dir" >
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly id="file" name="file">

                                            </div>                                    
                                        </div>
                                    </th>
                                    <th>
                                        <?php
                                        if($cursoStatus == 1 && $temaStatus == 1)
                                        {
                                        ?>
                                            <div class="form-group">
                                                <a id="button_add" title ="Agregar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/add.png" onclick="saveFicherosRow('fichero');"></a>
                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            echo "";
                                        }
                                        ?>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <a id="button_edit" title ="Guardar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/save.png" onclick="saveFicherosEditRow('fichero');"></a>
                                        </div>
                                    </th>
                                </tr>
                                <?php
                                if($valid == false)
                                {
                                ?>
                                <tr>
                                    <th colspan="6">
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
                                <tr style="cursor:pointer" class = "desmarcado">
                                    <td><?php echo $row['pk_fichero']; ?></td>
                                    <td><?php echo $row['descripcion']; ?></td>
                                    <td><?php 
                                        if($row['status'] == "1")
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
                                        <a href="<?php echo $ruta.'/'.$row['directorio']; ?>" download><?php echo $row['directorio']; ?></a>
                                 
                                    </td>
                                    <td>
                                        <img title="Editar" style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/edit.png" onclick="editFicheroRow('<?php echo $row['pk_fichero']; ?>','<?php echo $row['descripcion']; ?>','<?php echo $row['status']; ?>');">
                                    </td>
                                    <td>
                                           <img title="Eliminar" style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/del.png" onclick="deleteRow('<?php echo $row['pk_fichero']; ?>','fichero');">
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
    </body>
</html>