<link rel="stylesheet" type="text/css" href="../media/css/jquery.dataTables.css">
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />
<link href="../css/skins/default.css" rel="stylesheet" />
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
            { "orderable": false, "targets": [2,3] },
            { "width": "10%", "targets": [0,2,3] }
        ],
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
<style>
    tfoot {
        display: table-header-group;
    }
</style>
<div>
    <h1>Temas del curso <?php echo $cursoName; ?></h1>
</div>
<form action="" method="POST" id="form_grid">
    <input type="hidden" id="id_curso" name="id_curso" value="<?php echo $id_curso; ?>" />
    <input type="hidden" id="action_type" name="action_type" value="" />
    <input type="hidden" id="id_row" name="id_row" value="" />
    <table id="" class="display" cellspacing="0" width="100%">
        <thead class="thead-columns">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th></th>
                <th></th>
            </tr>  
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>
                
                </th>
                <th>
                
                </th>
                <th>
                
                </th>
                
            </tr>
        </tfoot>

        <tbody class="tbody-columns">
            <?php
            foreach ($data as $row)
            {
            ?>
            <tr style="cursor:pointer" class = "desmarcado">
                <td><?php echo $row['pk_tema']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td>
                    <a id="button_file" title ="PDF" href= "../frontend/ficheros.php?id_tema=<?php echo $row['pk_tema']; ?>" target="_top"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/file.png"></a>
                </td>
                <td>
                    <a id="button_video" title ="Videos" href= "../frontend/videos.php?id_tema=<?php echo $row['pk_tema']; ?>" target="_top"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/file.png"></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>    
</form>