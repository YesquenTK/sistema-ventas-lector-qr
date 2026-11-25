<?php

class Conectar{
    public $dbh;

    public function Conexion(){
        try{
            // Cambiar "local" por "host" en la cadena de conexión
            $this->dbh = new PDO("mysql:host=localhost;dbname=VentasQR","root","");
            return $this->dbh;
        } catch(Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public static function ruta(){
        // Local
        return "http://localhost/Producto_QR/";
        // Produccion
        // return "http://www.tudominio.com/";
    }
}
?>
