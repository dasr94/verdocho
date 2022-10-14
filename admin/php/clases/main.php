<?php
class allTask{

    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }

    function generarCodigo($longitud): string {
        $key = '';
        $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
        return $key;
    }

    function agregarUsuario($params) : bool {
        try {
            $query = "INSERT INTO usuarios(usuario, contra, nombre, correo, nivel, imagen) VALUES(:usr, :pss, :nam, :crr, :nvl, 'avatar-verdocho.jpg')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":usr", $params[0]);
            $stmt->bindParam(":pss", $params[1]);
            $stmt->bindParam(":nam", $params[2]);
            $stmt->bindParam(":crr", $params[3]);
            $stmt->bindParam(":nvl", $params[4]);
            return ($stmt->execute()) ? true : false; 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function updateUsuario($params) {
        try {
            $query = "UPDATE usuarios SET usuario = :usr, contra = :pss, nombre = :nam, correo = :crr, nivel = :nlv where id = :aidi";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":usr", $params[0]);
            $stmt->bindParam(":pss", $params[1]);
            $stmt->bindParam(":nam", $params[2]);
            $stmt->bindParam(":crr", $params[3]);
            $stmt->bindParam(":nlv", $params[4]);
            $stmt->bindParam(":aidi", $params[5]);
            // return $params[5];
            // return ($stmt->execute()) ? true : false;
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false; 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function agregarCliente($params) : bool {
        try {
            $query = "INSERT INTO clientes(nombre, direccion, departamento, municipio, telefono, correo, fecha_nac, categoria, dui) VALUES(:nam, :dir, :dep, :mun, :tel, :mail, :nac, :cat, :dui)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nam", $params[0]);
            $stmt->bindParam(":dir", $params[1]);
            $stmt->bindParam(":dep", $params[2]);
            $stmt->bindParam(":mun", $params[3]);
            $stmt->bindParam(":tel", $params[4]);
            $stmt->bindParam(":mail", $params[5]);
            $stmt->bindParam(":nac", $params[6]);
            $stmt->bindParam(":cat", $params[7]);
            $stmt->bindParam(":dui", $params[8]);
            return ($stmt->execute()) ? true : false; 
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }
    function updateCliente($params) : bool {
        try {
            $query = "UPDATE clientes SET nombre = :nam, direccion = :dir, departamento = :dep, municipio = :mun, telefono = :tel, correo = :mail, fecha_nac = :nac, categoria = :cat, dui = :du where idcliente = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nam", $params[0]);
            $stmt->bindParam(":dir", $params[1]);
            $stmt->bindParam(":dep", $params[2]);
            $stmt->bindParam(":mun", $params[3]);
            $stmt->bindParam(":tel", $params[4]);
            $stmt->bindParam(":mail", $params[5]);
            $stmt->bindParam(":nac", $params[6]);
            $stmt->bindParam(":id", $params[7]);
            $stmt->bindParam(":cat", $params[8]);
            $stmt->bindParam(":du", $params[9]);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    function cargarClientes(){
        try {
            $query = "SELECT * FROM clientes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function cargarStock(){
        try {
            $query = "SELECT * FROM stock";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function agregarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario, $ids){
        try {


            $mensaje = array("code"=>0,"mensaje"=>"Sin Cargar","code2"=>0);
            $queryStock = "SELECT cantidad FROM stock where stock_id = :ids ";
            $stmt2 = $this->conn->prepare($queryStock);
            $stmt2->bindParam(":ids", $ids);
            $stmt2->execute();
            $stockActual = $stmt2->fetchColumn();

            $nuevoStock = $stockActual - $cantidad;
            if($stockActual < $cantidad){
                $mensaje = array("code"=>0,"mensaje"=>"Sin Stock para pedido","code2"=>1);
                

            } else {

                $queryActualizar = "UPDATE stock SET cantidad = :can where stock_id = :ids ";
                $stmt3 = $this->conn->prepare($queryActualizar);
                $stmt3->bindParam(":can", $nuevoStock);
                $stmt3->bindParam(":ids", $ids);
                $stmt3->execute();

                $filasAfectadas = $stmt3->rowCount();
                if($filasAfectadas > 0){

                    $query = "INSERT INTO detalle_pedido(producto, cantidad, total_unti, total_articulo, numero_orden) VALUES(:pro, :can, :tun, :tto, :num)";
                    $stmt = $this->conn->prepare($query);
                    $total_producto = $precio_unitario * $cantidad;
                    $stmt->bindParam(":pro", $id_producto);
                    $stmt->bindParam(":can", $cantidad);
                    $stmt->bindParam(":tun", $precio_unitario);
                    $stmt->bindParam(":tto", $total_producto);
                    $stmt->bindParam(":num", $numero_orden);
                    if($stmt->execute()){
                        $mensaje = array("code"=>1,"mensaje"=>"agregado al carrito","code2"=>4);

                    } else {
                        $mensaje = array("code"=>0,"mensaje"=>"No se inserto en carrito","code2"=>3);
                    }
                } else {
                    $mensaje = array("code"=>0,"mensaje"=>"No se actualizo","code2"=>2);
                }
            }

            return $mensaje;
 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario, $ids){
        try {

            $mensaje = array("code"=>0,"mensaje"=>"Sin Cargar","code2"=>0);
            $queryActualizar = "UPDATE stock SET cantidad = cantidad + :can where stock_id = :ids";
            $stmt2 = $this->conn->prepare($queryActualizar);
            $stmt2->bindParam(":can", $cantidad);
            $stmt2->bindParam(":ids", $ids);
            $stmt2->execute();
            $filasAfectadas = $stmt2->rowCount();
            if($filasAfectadas > 0){

                $query = " DELETE FROM detalle_pedido where producto = :pro and numero_orden = :num";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":pro", $id_producto);
                $stmt->bindParam(":num", $numero_orden);
                if ($stmt->execute()) {
                    $mensaje = array("code"=>1,"mensaje"=>"Eliminado correctamente","code2"=>3);
                } else {
                    $mensaje = array("code"=>0,"mensaje"=>"No se elimino en carrito","code2"=>2);
                } 

            } else {
                $mensaje = array("code"=>0,"mensaje"=>"Sin actualizar","code2"=>1);
            }

            return $mensaje;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function actualizarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario){
        try {
            $query = " UPDATE detalle_pedido SET cantidad = :can, total_articulo = :tto where producto = :pro and numero_orden = :num";
            $stmt = $this->conn->prepare($query);
            $total_producto = $precio_unitario * $cantidad;
            $stmt->bindParam(":can", $cantidad);
            $stmt->bindParam(":tto", $total_producto);
            $stmt->bindParam(":pro", $id_producto);
            $stmt->bindParam(":num", $numero_orden);
            if ($stmt->execute()) {
                $query2 = "SELECT sum(total_articulo) as total from detalle_pedido where numero_orden = :num";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(":num", $numero_orden);
                $stmt2->execute();
                $total = $stmt2->fetchColumn();
                return $total;
            } else {
                return '0';
            }
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    function mostrarCarrito($numero_orden){
        try {
            $query = "SELECT a.cantidad, b.costo, b.venta, round(a.total_articulo,2) as total_articulo, a.producto, a.total_unti  FROM detalle_pedido as a inner join stock as b on a.producto = b.producto where numero_orden = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $numero_orden);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarPedido($numero_orden){
        try {
            $query = "SELECT b.categoria, b.nombre, b.direccion, b.departamento, b.municipio, b.telefono, b.correo, a.tipo_pago, a.fecha, a.monto, a.estado1, a.estado2, a.estado3, a.estado4 FROM pedidos AS a INNER JOIN clientes AS b ON a.idcliente = b.idcliente where a.codigo_pedido = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $numero_orden);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarClienteporPedido($numero_orden){
        try {
            $query = "SELECT * FROM pedidos where codigo_pedido = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $numero_orden);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function agregarPedido($numero_orden, $total_producto, $cliente, $tipo_pago){
        try {
            $query = "INSERT INTO pedidos(codigo_pedido, idcliente, fecha, monto, tipo_pago, estado, estado1) VALUES(:cpe, :idc, current_timestamp(), :tto, :tti, 'Ingreso', current_timestamp())";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":cpe", $numero_orden);
            $stmt->bindParam(":idc", $cliente);
            $stmt->bindParam(":tto", $total_producto);
            $stmt->bindParam(":tti", $tipo_pago);
            return ($stmt->execute()) ? true : false; 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarCategorias(){
        try {
            $query = "SELECT * FROM categorias";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function agregarProducto($producto, $costo, $venta, $cantidad, $categoria){
        try {
            $query = "INSERT INTO stock(producto, costo, venta, cantidad, id_cat) VALUES(:pro, :cost, :ven, :can, :cat)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":pro", $producto);
            $stmt->bindParam(":cost", $costo);
            $stmt->bindParam(":ven", $venta);
            $stmt->bindParam(":can", $cantidad);
            $stmt->bindParam(":cat", $categoria);
            return  ($stmt->execute()) ? true : false ;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarPedidos(){
        try {
            $query = "SELECT * FROM pedidos as a inner join clientes as b ON a.idcliente = b.idcliente";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarPedidosEstado($estado){
        try {
            $query = "SELECT * FROM pedidos as a inner join clientes as b ON a.idcliente = b.idcliente where a.estado = :est";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":est", $estado);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarProductos(){
        try {
            $query = "SELECT * from stock as a inner join categorias as b on a.id_cat = b.id_cat";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarClientes(){
        try {
            $query = "SELECT * FROM clientes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarUsuarios(){
        try {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarUsuariosUnico($id){
        try {
            $query = "SELECT * FROM usuarios where id = :di";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":di",$id);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminarPedido($numero_orden, $id_pedido)  {
        try {
            $query2 = "DELETE FROM pedidos where idpedido = :num";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindParam(":num", $id_pedido);
            $stmt2->execute();

            $query = "DELETE FROM detalle_pedido where numero_orden = :num2";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num2", $numero_orden);
            return $stmt2->execute();
            // $filasAfectadas = $stmt->rowCount();
            // return $stmt2;
            // return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function eliminarProducto($id_producto) : bool {
        try {
            $query = "DELETE FROM stock where stock_id = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $id_producto);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminarCliente($id_cliente) : bool {
        try {
            $query = "DELETE FROM clientes where idcliente = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $id_cliente);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function eliminarUsuario($id_usuario) : bool {
        try {
            $query = "DELETE FROM usuarios where id = :num";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":num", $id_usuario);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function actualizarProducto($id_producto, $cantidad) : bool {
        try {
            $query = "UPDATE stock set cantidad = :can where stock_id = :ids ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":ids", $id_producto);
            $stmt->bindParam(":can", $cantidad);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function actualizarProducto2($id_producto, $costo, $venta, $nombre) : bool {
        try {
            $query = "UPDATE stock set costo = :cost, venta = :ven, producto = :nmb where stock_id = :ids ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":ids", $id_producto);
            $stmt->bindParam(":cost", $costo);
            $stmt->bindParam(":ven", $venta);
            $stmt->bindParam(":nmb", $nombre);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function mostrarClienteUnico($id){
        try {
            $query = "SELECT * FROM clientes where idcliente = :cli";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":cli", $id);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function cambiarEstado($estado, $orden){
        try {
            $query = "UPDATE pedidos set estado = :est, estado2 = current_timestamp() where codigo_pedido = :orden ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":est", $estado);
            $stmt->bindParam(":orden", $orden);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    function cambiarEstado2($estado, $orden){
        try {
            $query = "UPDATE pedidos set estado = :est, estado3 = current_timestamp() where codigo_pedido = :orden ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":est", $estado);
            $stmt->bindParam(":orden", $orden);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            return ($filasAfectadas > 0) ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }




}

?>