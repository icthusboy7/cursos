
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
        <title>Cursos</title>
        <link type="text/css" rel="stylesheet" href="css/login.css" />  
	</head>
    <body>
    <div style="margin-top: 60px;text-align: center;">
        <h1>Cursos</h1>
        <?php 
        // ERROR EN LOGIN
        if (isset($_POST['validUser']) and $_POST['validUser'] === false){
        echo '<b><p style= "color: red"> Nombre de usuario y contraseña incorrecta. </p></b>';
        }
        ?>
    </div> 	  
    
    <div id='login'>
                <h1>Inicio de sesión </h1>
                <form method='POST'  id="loginusr" action="index.php">
                    
                    <table>
                        <tr><td><label for="username">Nombre de usuario:</td>
                            <td><input id="usuario" name="usuario" type="text" ></tr><tr>
                            <td>
                                <label for="password"> Contraseña:
                            </td>
                            <td><input type="password" id="password" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td ><input type="submit" value="Iniciar sesión" id="entrar"></td>
                        </tr><tr>
                        </tr>
                    </table>
                </form>
            </div>
    </body>
</html>
