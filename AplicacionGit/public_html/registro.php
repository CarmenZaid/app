<?php
require_once('BD.php');
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
   
    $nif= $_POST['nif'];
    $nombre= $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
 
    $error = "";
    if (!empty ($nif) || !empty($clave2) ||!empty($usuario) || !empty($clave1)) {
            $error = BD::nuevoUsuario($usuario, $clave1, $nif, $nombre);
            
            //el info de usuario registrado 
             //para que me aparezca el error en una ventana emergente

           
           // header("Location: loginPrueba.php");
        
        }
    }

?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Registro App</title>
                
                <!--Enlaces de Estilo-->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!--Enlaza Bootstrap -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"/> <!-- Esto es para la fuente Awesome -->
		<!--<link rel="stylesheet" href="css/registro.css" type="text/css" media="screen"/> -->
                <link rel="stylesheet" href="css/registro.css" type="text/css" media="screen"/> 

                
		
                
		<script type="text/javascript">
		
			window.onload = function() {
                            document.getElementById("formulario").onsubmit=validar_Formulario;
                            document.getElementById("nif").onkeypress =numerosYletrasNIF;

			}
				
	
			function validar_Formulario(){
                        var retorno = true;
                                 //DNI   
        if(document.getElementById("nif").value.length<9){
					document.getElementById("info_nif").innerHTML="DNI incompleto [8numeros-1letra]";
					document.getElementById("nif").focus();
					retorno= false;
				}
				
				
				//comprobar que el dni introducido es correcto o incorrecto
				var nif=document.getElementById("nif").value;
				if(!validarNIF(nif)){
					document.getElementById("info_nif").innerHTML="NIF incorrecto. Vuelva a introducirlo";
					document.getElementById("nif").focus();
					retorno= false;
				}else{
				
				
				document.getElementById("info_nif").innerHTML="";
                                }
        
        
        
                                //NOMBRE
                         
			if(document.getElementById("nombre").value.length==0){
					document.getElementById("info_nombre").innerHTML="Por favor, introduzca su nombre.";
					document.getElementById("nombre").focus();
					retorno= false;
				}else{
					document.getElementById("info_nombre").innerHTML="";
                                }
                            //USUARIO
                         
			if(document.getElementById("usuario").value.length==0){
					document.getElementById("info_usuario").innerHTML="Debe introducir un nombre de usuario.";
					document.getElementById("usuario").focus();
					retorno= false;
				}else{
					document.getElementById("info_usuario").innerHTML="";
                                }
                            
                            
                            //Contraseñas
              
                            //CONTRASEÑA1
                         
			if(document.getElementById("clave1").value.length==0){
					document.getElementById("info_clave1").innerHTML="Es necesario introducir una contraseña";
					document.getElementById("clave1").focus();
					retorno= false;
				}else{
					document.getElementById("info_clave1").innerHTML="";
                                }
				
                            //CONTRASEÑA 2
                            
                         if(document.getElementById("clave2").value.length==0){
					document.getElementById("info_clave2").innerHTML="Has dejado el repetir contraseña vacío.";
					document.getElementById("clave2").focus();
					retorno= false;
                        }
                        else{
                            
                            clave1= document.getElementById('clave1').value;
                            clave2= document.getElementById('clave2').value;
                                    if( clave1== clave2){
					document.getElementById("info_clave2").innerHTML="";
                                    }
                                    else{
      					document.getElementById("info_clave2").innerHTML="Las claves no coinciden vuelva a intentarlo";
                                        retorno = false;
                                    }
                        }
                         
                         if(retorno){
                             return retorno;
                         }else{
                             return retorno;
                         }
                         
                         
			}
             /*************** funciones auxiliares***********/
             
             
             
                        
                         function numerosYletrasNIF(e){
			 var c = e.charCode || window.event.keyCode; 
			 
			 var elemento = document.getElementById("nif");
			 if(elemento.value.length<=7){
			  return ((c >= 48)  && (c <= 57));
			 }else{
			  return (((c >= 65)  && (c <= 90)) || ((c >= 97) && (c <= 122)));
			 }
			}
			
                        function validarNIF(nif){	
				 var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B',
				'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
				
				if(nif.length<9)
					return false;
				
				 var dni=nif.substring(0,8);
				  var l=nif.charAt(8);
				
					if(letras[dni%23]==l.toUpperCase())
						return true;
					else
						return false;
			}
			
	
		</script>
	</head>

	<body>

            <div class="cabeceraR"><h1>Registro</h1></div>
            <div class="container">
                <form name="formulario" id="formulario" method="post" action="registro.php">
                    <div><span class='error'><?php if (isset($error)) echo $error; ?></span></div>
		<p>
			<h3>Formulario de Registro:</h3>
                        
                        <label for="nif">NIF: </label>
			<input type="text" name="nif" id="nif" value="" />  
			<span id="info_nif"></span>
                        
                        <br><br>
                        
                        <label for="nombre">Nombre y apellidos: </label>
			<input type="text" name="nombre" id="nombre" value="" />  
			<span id="info_nombre"></span>
                        
                        
                        <br><br>

                                
			<label for="usuario">Usuario: </label>
			<input type="text" name="usuario" id="usuario" value="" />  
			<span id="info_usuario"></span>
			                            
                  
			<br><br>
                        
                        
                        
                        <label for="clave1">Contraseña: </label>
                        <input type="password" name="clave1" id="clave1" maxlength="15" size="15" />  
			<span id="info_clave1"></span>
                        
                        
			<br><br>

                                
			<label for="clave2">Repetir Clave: </label>
                        <input type="password" name="clave2" id="clave2" value="" />  
			<span id="info_clave2"></span>
			                            
                  
			<br><br>
                                
   
                                
			
      		
		</p>
		<p>
			<input type="submit" name="enviar" value="enviar" >
			<br><br>
			<input type="reset" value="Limpiar">
			
		</p>
		</form>
            </div>
	</body>
</html>




