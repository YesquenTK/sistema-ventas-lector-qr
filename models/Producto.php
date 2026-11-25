<?php
class Producto extends Conectar {
    
    public function get_producto() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                    productos.id, 
                    productos.codigo,
                    productos.cat_id,  
                    tm_categoria.cat_nom, 
                    productos.producto, 
                    productos.precio, 
                    productos.prod_cant, 
                    productos.imagen,
                    productos.QR
                FROM 
                    productos 
                INNER JOIN 
                    tm_categoria 
                ON 
                    productos.cat_id = tm_categoria.cat_id 
                WHERE 
                    productos.est = 1;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_producto_x_id($id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM productos WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_producto__x_cod($producto_cod) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM productos WHERE codigo = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $producto_cod);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_producto($id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos
                SET
                    est = 0,
                    fech_elim = now()
                WHERE
                    id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_producto($cat_id, $codigo, $producto, $precio, $prod_cant, $imagen, $QR) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO productos 
                (id, codigo, cat_id, producto, precio, prod_cant, imagen, QR, fech_crea, fech_modi, fech_elim, est) 
                VALUES 
                (NULL, ?, ?, ?, ?, ?, ?, ?, now(), NULL, NULL, 1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $codigo);
        $sql->bindValue(2, $cat_id);
        $sql->bindValue(3, $producto);
        $sql->bindValue(4, $precio);
        $sql->bindValue(5, $prod_cant);
        $sql->bindValue(6, $imagen);
        $sql->bindValue(7, $QR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_producto($id, $cat_id, $codigo, $producto, $precio, $prod_cant, $imagen, $QR) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos
                SET
                    cat_id = ?,
                    codigo = ?,
                    producto = ?,
                    precio = ?,
                    prod_cant = ?,
                    imagen = ?,
                    QR = ?,
                    fech_modi = now()
                WHERE
                    id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $codigo);
        $sql->bindValue(3, $producto);
        $sql->bindValue(4, $precio);
        $sql->bindValue(5, $prod_cant);
        $sql->bindValue(6, $imagen);
        $sql->bindValue(7, $QR);
        $sql->bindValue(8, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_producto_solo_imagen($id, $cat_id, $codigo, $producto, $precio, $prod_cant, $imagen) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos
                SET
                    cat_id = ?,
                    codigo = ?,
                    producto = ?,
                    precio = ?,
                    prod_cant = ?,
                    imagen = ?,
                    fech_modi = now()
                WHERE
                    id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $codigo);
        $sql->bindValue(3, $producto);
        $sql->bindValue(4, $precio);
        $sql->bindValue(5, $prod_cant);
        $sql->bindValue(6, $imagen);
        $sql->bindValue(7, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_producto_solo_qr($id, $cat_id, $codigo, $producto, $precio, $prod_cant, $QR) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos
                SET
                    cat_id = ?,
                    codigo = ?,
                    producto = ?,
                    precio = ?,
                    prod_cant = ?,
                    QR = ?,
                    fech_modi = now()
                WHERE
                    id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $codigo);
        $sql->bindValue(3, $producto);
        $sql->bindValue(4, $precio);
        $sql->bindValue(5, $prod_cant);
        $sql->bindValue(6, $QR);
        $sql->bindValue(7, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_producto_sin_img($id, $cat_id, $codigo, $producto, $precio, $prod_cant) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos
                SET
                    cat_id = ?,
                    codigo = ?,
                    producto = ?,
                    precio = ?,
                    prod_cant = ?,
                    fech_modi = now()
                WHERE
                    id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $codigo);
        $sql->bindValue(3, $producto);
        $sql->bindValue(4, $precio);
        $sql->bindValue(5, $prod_cant);
        $sql->bindValue(6, $id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>
