<?php
 header('Content-Type: application/json; charset=utf-8');  //  Todo se devolverá en formato JSON.
 
//print json_encode("{objeto:11}");
//  return;
//  incluyo el fichero datos_modelo.php, para poder usar la clase que contiene:
require_once 'datos_modelo.php';
//  Uso el fichero incluido arriba, para crear un objeto de esa clase
$modelo = new datosModelo();

//  Recojo el STRING en json que envía el cliente:
$datos = file_get_contents("php://input");

// print "datos = " . $datos;
//  Creo el ojbeto PHP a partir del objeto json recibido:
$objeto = json_decode($datos);

 // print json_encode($modelo->SelectEntrada());
// return;


//Recojo el resto de datos 
//$mosquito = "";
//if (isset($_POST['tmosquito']))
//    $tmosquito= $_POST['tmosquito'];

/*

 $zcuerpo = $_POST['zcuerpo'];
 $fecha = $_POST['fecha'];
 $hora = $_POST['hora'];
 $latitud = $_POST['latitud'];
 $longitud = $_POST['longitud'];
*/


//  Recogemos los datos: (la opción que nos piden a realizar)
if ($objeto->opcion != null) {

    switch($objeto->opcion) {
			
			case 1:  // Listar datos (de la tabla datos)
				print json_encode($modelo->Listar());
                   
				break;
			
			case 2: //  Insertar / Añadir
			//	$modelo->Insertar ($tmosquito, $zcuerpo, $fecha, $hora, $latitud, $longitud);
                                $modelo->Insertar ($objeto);
				break;

			case 3:  //  Listado de TODOS los mosquitos
                                print json_encode($modelo->SelectEntrada());
				break;
                            
			case 4:  //  Eliminar/borrar
		//		$modelo->Eliminar($objeto->ID);
				break;
                            
                        
			
    }
}
?>
