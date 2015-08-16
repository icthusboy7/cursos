

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
        
        <div class="row">
                <div class="row">
                    <h3>Crear curso</h3>
                </div>
                        
                <form method="POST" action="addcursos.php">
                <div class="form-group <?php echo !empty($fnameError)?'has-error':'';?>">
                    <label for="inputFName">Nombre</label>
                    <input type="text" class="form-control" required="required" id="inputFName" value="<?php echo !empty($fname)?$fname:'';?>" name="inputFName" placeholder="Escriba el nombre aquí">
                    <span class="help-block"><?php echo $fnameError;?></span>
                </div>
                
                <div class="form-group <?php echo !empty($genderError)?'has-error':'';?>">
                    <label for="inputGender">Estado</label>
                    <select class="form-control" required="required" id="inputStatus" name="inputStatus" >
                    <option value="1" <?php echo $estado == '1'?'selected':'';?>>Activo</option>
                    <option value="2" <?php echo $estado == '2'?'selected':'';?>>Inactivo</option>
                    </select>
                    <span class="help-block"><?php echo $genderError;?></span>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Crear</button>
                    <a class="btn btn-default" href="cursos.php">Volver</a>
                </div>
            </form>
                    
        </div> <!-- /row -->
    </div> <!-- /container -->
</body>
</html>