<?php

class datosModelo {

    private $pdo;  //  Variable que contendrá la conexión a la base de datos.

    //  constructor de la clase, que lo único que hace es crear la conexión a la base de datos y guardar esa conexión en $pdo

   public function __CONSTRUCT() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=mosquito', 'root', '', array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //  De momento sólo implementamos la funcion/método de Listar, luego implementaremos el resto.
    public function Listar() {
        try {
            $sc = "Select * From datos";
            $stm = $this->pdo->prepare($sc);
            $stm->execute();
            return ($stm->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //FUNCION INSERTAR  //CARMEN 

    
    //Nota mental: no se para que usabamos la bandera en esta funcion
    public function Insertar($objeto) {
        $bandera = 0;
        try {
            $sc = "INSERT INTO datos(tmosquito, zcuerpo, fecha, hora, latitud, longitud) VALUES(?, ?, ?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sc);
            $stm->execute(
                    array($objeto->tmosquito, $objeto->zcuerpo, $objeto->fecha, $objeto->hora, $objeto->latitud, $objeto->longitud)
            );
        } catch (Exception $e) {
            $bandera = 1;
            die($e->getMessage());
        }
        if ($bandera == 0) {
            header('Location:correcto.html');
        }
    }

    
    //FUNCION PARA EL SELECT DE TIPO DE MOSQUITO    //MARCO
    public function SelectEntrada() {
        try {
            $sc = "Select * From tipos_mosquitos";
            $stm = $this->pdo->prepare($sc);
            $stm->execute();
           return ($stm->fetchAll(PDO::FETCH_ASSOC));
   //         return "todo bien";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}
//FUNCION PARA COMPROBAR SI EL NOMBRE DE USUARIO ESTA DISPONIBLE 
    
    //LO DEJO ASI DE MOMENTO PORQUE NO LO ENTIENDO BIEN 
    

       /* public function NombreDisponible($usuario){
                    $sql = "SELECT usuario FROM usuarios WHERE usuario='$usuario'";

            try{
                $sc = "Select usuario From usuarios where usuario='$usuario'";
            } catch (Exception $ex) {

            }
        }


}*/
//  class datosModelo
?>

