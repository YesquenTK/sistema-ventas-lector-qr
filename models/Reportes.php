<?php
require_once("../view/Main/sesion.php");
require_once("../config/conexion.php");

class Reportes extends Conectar {
    public function obtenerVentasHoy() {
        try {
            $this->Conexion(); 
            $this->set_names(); 

            $hoy = date('Y-m-d');
            $query = "SELECT COUNT(*) AS ventasHoy FROM tm_compras WHERE DATE(fecha) = :hoy";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':hoy', $hoy, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row['ventasHoy'];
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            return 0;
        } finally {
            $this->dbh = null; 
        }
    }

    public function obtenerVentasMes() {
        try {
            $this->Conexion();
            $this->set_names();
    
            $primerDiaMes = date('Y-m-01');
            $hoy = date('Y-m-d');
    
            $query = "SELECT SUM(cantidad * precio) AS total FROM tm_compras WHERE fecha BETWEEN :primerDiaMes AND :hoy";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':primerDiaMes', $primerDiaMes, PDO::PARAM_STR);
            $stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            return 0;
        } finally {
            $this->dbh = null;
        }
    }
    

    public function obtenerIngresoMes() {
        try {
            $this->Conexion(); 
            $this->set_names(); 


            $query = "SELECT IngresoMes FROM tm_reportes";
            $result = $this->dbh->query($query);

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                return $row['IngresoMes'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            return 0;
        } finally {
            $this->dbh = null;
        }
    }
}

$reportes = new Reportes();

if ($_GET["op"] == "obtenerVentasHoy") {
    $ventasHoy = $reportes->obtenerVentasHoy();
    echo $ventasHoy;
    exit(); 
}


if ($_GET["op"] == "obtenerNVMes") {
    $ventasMes = $reportes->obtenerVentasMes();
    echo $ventasMes;
    exit(); 
}


if ($_GET["op"] == "obtenerIngresoMes") {
    $IngresoMes = $reportes->obtenerIngresoMes();
    echo $IngresoMes;
    exit();
}

?>
