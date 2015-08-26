<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Formación CILANTROIT</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method='POST' action="index.php">
        <div>
        <h2 class="form-signin-heading">Formación CILANTROIT</h2>
      </div>
        <div>
      <?php 
        // ERROR EN LOGIN
        if (isset($_POST['validUser']) and $_POST['validUser'] === false){
        echo '<b><p style= "color: red"> Nombre de usuario / contraseña incorrecta. </p></b>';
        }
        ?>
      </div>
        <label for="inputUser" class="sr-only">Usuario</label>
        <input type="text" class="form-control" required="required" id="usuario" value="" name="usuario" placeholder="Escriba el usuario aquí">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>