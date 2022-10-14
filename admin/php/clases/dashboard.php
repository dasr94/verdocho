<?php
class dashboard{

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }

    function pedidosMesActual(){
        try {
            $query = "SELECT count(*) as total FROM pedidos where month(date(fecha)) = month(date(current_timestamp())) and YEAR(date(fecha)) = YEAR(date(current_timestamp())) ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function pedidosMesPasado(){
        try {
            $query = "SELECT count(*) as total FROM pedidos where month(date(fecha)) = month(date(current_timestamp())) - 1 and YEAR(date(fecha)) = YEAR(date(current_timestamp()))";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function clientesMesActual(){
        try {
            $query = "SELECT count(*) as total FROM clientes where month(date(fecha_creado)) = month(date(current_timestamp())) and YEAR(date(fecha)) = YEAR(date(current_timestamp()))";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function clientesCumpleaniosMesActual(){
        try {
            $query = "SELECT count(*) as total FROM clientes where month(date(fecha_nac)) = month(date(current_timestamp())) and YEAR(date(fecha)) = YEAR(date(current_timestamp()))";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function datosVentasMesActual(){
        try {
            $query = "SELECT  round( sum( (b.cantidad * c.venta) - (b.cantidad * c.costo) ) , 2) as total, round( sum(b.cantidad * c.venta) , 2) as venta, round( sum(b.cantidad * c.costo) , 2) as costo, min(a.fecha) as inicio, max(a.fecha) as fin from pedidos as a inner join detalle_pedido as b ON a.codigo_pedido = b.numero_orden inner join stock as c on b.producto = c.producto where  month(date(a.fecha)) = month(curdate()) and YEAR(date(fecha)) = YEAR(date(current_timestamp()))";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function datosVentasMesPasado(){
        try {
            $query = "SELECT  round( sum( (b.cantidad * c.venta) - (b.cantidad * c.costo) ) , 2) as total, round( sum(b.cantidad * c.venta) , 2) as venta, round( sum(b.cantidad * c.costo) , 2) as costo, min(a.fecha) as inicio, max(a.fecha) as fin from pedidos as a inner join detalle_pedido as b ON a.codigo_pedido = b.numero_orden inner join stock as c on b.producto = c.producto where  month(date(a.fecha)) = month(curdate()) - 1 and YEAR(date(fecha)) = YEAR(date(current_timestamp()))";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function ultimas5Ventas(){
        try {
            $query = "SELECT a.codigo_pedido as pedido, a.fecha as fecha, a.estado as estado, (b.cantidad * c.venta) - (b.cantidad * c.costo) as dif, b.cantidad, c.costo, c.venta, b.cantidad * c.costo AS difcosto,  b.cantidad * c.venta AS difventa from pedidos as a inner join detalle_pedido as b ON a.codigo_pedido = b.numero_orden inner join stock as c on b.producto = c.producto order by a.fecha desc limit 5";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function ventasPorDiaGrafico(){
        try {
            $query = "SELECT day(date(a.fecha)) as fecha, 
            round(sum((b.cantidad * c.venta) - (b.cantidad * c.costo))) as dif, 
            sum(c.costo), sum(c.venta), sum(b.cantidad * c.costo) AS difcosto,  
            sum(b.cantidad * c.venta) AS difventa from pedidos as a inner join detalle_pedido as b ON a.codigo_pedido = b.numero_orden inner join stock as c on b.producto = c.producto  where month(date(a.fecha)) = month(date(curdate())) and YEAR(date(fecha)) = YEAR(date(current_timestamp())) group by date(a.fecha)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function ventasPorDiaGraficoMesPasado(){
        try {
            $query = "SELECT day(date(a.fecha)) as fecha, 
            round(sum((b.cantidad * c.venta) - (b.cantidad * c.costo))) as dif, 
            sum(c.costo), sum(c.venta), sum(b.cantidad * c.costo) AS difcosto,  
            sum(b.cantidad * c.venta) AS difventa from pedidos as a inner join detalle_pedido as b ON a.codigo_pedido = b.numero_orden inner join stock as c on b.producto = c.producto  where month(date(a.fecha)) = month(date(curdate())) - 1 and YEAR(date(fecha)) = YEAR(date(current_timestamp())) group by date(a.fecha)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function vistaProductos7DiasAtras(){
        try {
            $query = "SELECT sum(cantidad) as total , producto from detalle_pedido as a inner join pedidos as b on a.numero_orden = b.codigo_pedido where day(date(b.fecha)) - 7 and b.estado = 'completado' group by producto";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }




}

?>