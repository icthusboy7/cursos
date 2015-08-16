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
            { "orderable": false, "targets": [3,4] },
            { "width": "40%", "targets": [1,2] }
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
                <th>Estado</th>
                <th><a id="button_excel" title ="Excel" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/xls.png" onclick="excel(2);"></th>
                <th><a id="button_undo" title ="Deshacer edición" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/undo.png" onclick="buttonUndo();"></a></th>
            </tr>  
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>
                <div class="form-group">
                    <input type="text" class="form-control" required="required" id="name" name="name" style="width:100%;"/></th>
                </div>
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
                        <?php
                        if($cursoStatus == 1)
                        {
                        ?>
                            <a id="button_add" title ="Agregar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/add.png" onclick="saveRow();"></a>
                        <?php
                        }
                        else
                        {
                            echo "";
                        }
                        ?>
                    </div>
                </th>
                <th>
                    <div class="form-group">
                        <a id="button_edit" title ="Guardar" href= "#"><img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/save.png" onclick="saveRow();"></a>
                    </div>
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
                    <img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/edit.png" onclick="editRow('<?php echo $row['pk_tema']; ?>','<?php echo $row['nombre']; ?>','<?php echo $row['status']; ?>');">
                </td>
                <td>
                    <?php 
                    if($row['fk_tema']  > 0)
                    {
                        echo "";
                    }
                    else
                    {
                        ?>
                        <img style = "border: 3px ridge #eee; padding:3px; background-color: #FFF;" src = "../img/del.png" onclick="deleteRow('<?php echo $row['pk_tema']; ?>','tema');">
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