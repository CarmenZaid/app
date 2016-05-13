<?php
require_once("BD.php");



//Lineas modificadas para bootstrap

//Linea: 57, 

$error = "";
// Comprobamos si ya se ha enviado el formulario*/
//PRIMERO COMPRUEBO SI SE HA PULSADO EL BOTON DE INVITADO
if (isset($_POST['invitado'])) {
//TENGO QUE CREAR UNA SESSION CON USUARIO ANONIMO 
    session_start();
    $_SESSION['usuario'] = 'invitado';
    header("Location: formulario.html");
} else if (isset($_POST['enviar'])) {
//SI ELBOTON QUE S HA PULSADO ES EL DE ENVIAR, COMPRUEBA LAS DISTINTAS POSIILIDADES 
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    if (empty($usuario) || empty($clave)) {
        $error = "Debes introducir un nombre de usuario y una contraseña";
    } else {
        //VERIFICACLIENTE COMPRUEBA QUE SEA CORRCTA LA CONTRASEÑA Y EL NOMBRE DE USUARIO
        if (BD::verificaUsuario($usuario, $clave)) {
            //si el verifica usuario es true, en vez de las siguientes tres lineas 
            //se va a ejecutar una funcion de php que sea sesionstart
            //tipo de usuario, usuario, id
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: index.html");
        } else {
            // SI LOS DATOS NO SON CORRECTOS SE VUELVEN A PEDIR
            $error = "Usuario o contraseña no válidos!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login Mosapp</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!--Enlaza Bootstrap -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"/> <!-- Esto es para la fuente Awesome -->
	<link rel="stylesheet" href="css/login.css" type="text/css" media="screen"/> 
    </head>
    <body>
        <div id='login'>
            <form action='login.php' method='post' class="form-inline" role="form">
                <fieldset >
                    <div class="cabecera"><h1 class="titulo">Login</h1></div>
                    <div class="container">
                    <div><span class='error'><?php echo $error; ?></span></div>
                    <br/>
                    
                    <div class="form-group" class="col-lg-2 control-label">
                    <label  for='usuario'>Usuario</label>
                    <input type='text' name= 'usuario'  class="col-lg-2 control-label" id='usuario' placeholder='Introduce tu Usuario'>
                    </div>
                    
                    <div class="form-group">
                        <label for='password' class="col-lg-2 control-label" >Contraseña:</label><br/>
                        <input type='password' name='clave' class='form-control' id='password' maxlength="50" placeholder='Contraseña'/><br/>
                    </div>
                    <br/>
                    <div class='campo'>
                        <input type='submit' name='enviar' value='Enviar' />
                        <br/>
                        <br/>
                    </div>

                    <!-- Añado el boton de invitado -->
                    <div class='campo'>
                        <input type='submit' name='invitado' value='Invitado' />
                    </div>
                    <br/>
                    <p>Para registrarse como nuevo usuario pulse aqui <a href="registro.php">aqui</a></p>
                    </div>
                </fieldset>
            </form>
        </div>

    </body>
</html>
<?php  //para que me aparezca el error en una ventana emergente
if ($error !=""){
    print "<script>".
            "alert('$error');".
            "</script>";
}
?>