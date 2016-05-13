<?php

class BD {

    protected static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=mosquito";
        $usuario = 'root';
        $contrasena = '';
        $dwes = new PDO($dsn, $usuario, $contrasena, $opc);
        $resultado = null;
        if (isset($dwes)) {
            $resultado = $dwes->query($sql);
        }
        return $resultado;
    }


    public static function verificaUsuario($usuario, $clave) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$usuario' ";
        $sql .= "AND password='" . ($clave) . "';";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $fila = $resultado->fetch();
            if ($fila !== false)
                $verificado = true;
        }
        
        return $verificado;
    }



    
        public static function usuarioExiste($usuario) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$usuario'";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $fila = $resultado->fetch();
            if ($fila !== false)
                $verificado = true;
        }
        return $verificado;
    }
    
     public static function nuevoUsuario($usuario, $password, $nif, $nombre) {
              try {
                $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                $dsn = "mysql:host=localhost;dbname=mosquito";
                $dwes = new PDO($dsn, "root", "", $opc);
                // Ejecutamos la consulta para comprobar si ya existe
                if (self::usuarioExiste($usuario)) {
                     $info = "Usuario ya existente.";
                } else {
                     $contr_encr = md5($password);
                    //Si no se encuentran resultados
                    $sql = "INSERT INTO usuarios (usuario, password, tipo_usuario, dni, nombre_apellidos) VALUES"
                        . " ('$usuario', '$password', 'provisional', '$nif', '$nombre')";                    //var_dump($sql);
                    //Atencion, aqui no estoy comprobando que la insercion se ha hecho correctamente
                    $dwes->exec($sql);
                                header("Location: login.php");

                } 
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
                unset($dwes);
          return $info;
         
     }

    
}
