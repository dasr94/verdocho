<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'config/config.php';
include_once 'clases/main.php';

require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");

$database = new Database();
$db = $database->getConnection();

$dTask = new allTask($db);
$mail = new PHPMailer();

$correo = "ventas@verdocho.com";
$pass = 'W$xo7B8NL%V1';
$host = 'premium131.web-hosting.com';
$puerto = 465;

$opt = $_POST['opt'];

if ($opt == "create-user") {
    $usr = $_POST["usuario"];
    $pss = $_POST["contra"];
    $name = $_POST["nombre"];
    $email = $_POST["correo"];
    $level = $_POST["nivel"];

    $parametros = array($usr, $pss, $name, $email, $level);
    $doit = $dTask->agregarUsuario($parametros);
    echo $doit;
}
if ($opt == "update-user") {
    $usr = $_POST["usuario"];
    $pss = $_POST["contra"];
    $name = $_POST["nombre"];
    $email = $_POST["correo"];
    $level = $_POST["nivel"];
    $id = $_POST["id"];

    $parametros = array($usr, $pss, $name, $email, $level, $id );
    $doit = $dTask->updateUsuario($parametros);
    echo $doit;
}

if ($opt == "create-cliente") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $depa = $_POST["departamento"];
    $muni = $_POST["municipio"];
    $telefono = $_POST["telefono"];
    $email = $_POST["mail"];
    $birthdat = $_POST["birthday"];
    $categoria = $_POST["categoria"];
    $dui = $_POST["dui"];

    $parametros = array($nombre, $direccion, $depa, $muni, $telefono, $email, $birthdat, $categoria, $dui);
    $doit = $dTask->agregarCliente($parametros);
    echo $doit;
}
if ($opt == "update-cliente") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $depa = $_POST["departamento"];
    $muni = $_POST["municipio"];
    $telefono = $_POST["telefono"];
    $email = $_POST["mail"];
    $birthdat = $_POST["birthday"];
    $id = $_POST["id"];
    $categoria = $_POST["categoria"];
    $dui = $_POST["dui"];


    $parametros = array($nombre, $direccion, $depa, $muni, $telefono, $email, $birthdat, $id, $categoria, $dui);
    $doit = $dTask->updateCliente($parametros);
    echo $doit;
}
if ($opt == "calcular-agregar-carrito") {
    $id_producto = $_POST['id_prod'];
    $cantidad = $_POST['cant'];
    $numero_orden = $_POST['num_orde'];
    $precio_unitario = $_POST['precio_unit'];
    $id_stocK = $_POST['id_stock'];
    $doit = $dTask->agregarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario, $id_stocK);
    echo json_encode($doit);
    exit;
}
if ($opt == "calcular-actualizar-carrito") {
    $id_producto = $_POST['id_prod'];
    $cantidad = $_POST['cant'];
    $numero_orden = $_POST['num_orde'];
    $precio_unitario = $_POST['precio_unit'];
    $doit = $dTask->actualizarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario);
    echo $doit;
    
}
if ($opt == "calcular-eliminar-carrito") {
    $id_producto = $_POST['id_prod'];
    $cantidad = $_POST['cant'];
    $numero_orden = $_POST['num_orde'];
    $precio_unitario = $_POST['precio_unit'];
    $id_stocK = $_POST['id_stock'];
    $doit = $dTask->eliminarCarrito($id_producto, $cantidad, $numero_orden, $precio_unitario, $id_stocK);
    echo json_encode($doit);
    exit;
}
if ($opt == "mostrar-todo-carrito") {
    $numero_orden = $_POST['num_orde'];
    $result = "";
    $datos = $dTask->mostrarCarrito($numero_orden);
    foreach($datos as $da){
        $result .= "<li>" . $da['producto'] . " - " . $da['cantidad'] . "</li>";
    }
    echo $result;
}

if ($opt == "create-order") {
    $numero_orden = $_POST['numero_orden'];
    $cliente = $_POST['cliente'];
    $total_pedido = $_POST['total-pedido'];
    $tipo_pago = $_POST['tipo-pago'];
    $doit = $dTask->agregarPedido($numero_orden, $total_pedido, $cliente,  $tipo_pago);
    echo $doit;
}

if ($opt == "create-stock") {
    $producto = $_POST['producto'];
    $costo = $_POST['costo'];
    $venta = $_POST['venta'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];
    $data = $dTask->agregarProducto($producto, $costo, $venta, $cantidad, $categoria);
    echo $data;
}

if ($opt == "eliminar-pedido") {
    $num_orden = $_POST['n_orden'];
    $id_pedido = $_POST['idp'];
    $doit = $dTask->eliminarPedido($num_orden, $id_pedido);
    echo $doit;
}
if ($opt == "eliminar-producto") {
    $id_producto = $_POST['idp'];
    $doit = $dTask->eliminarProducto($id_producto);
    echo $doit;
}
if ($opt == "eliminar-cliente") {
    $id_cliente = $_POST['idp'];
    $doit = $dTask->eliminarCliente($id_cliente);
    echo $doit;
}
if ($opt == "eliminar-usuario") {
    $id_usuario = $_POST['idp'];
    $doit = $dTask->eliminarUsuario($id_usuario);
    echo $doit;
}
if ($opt == "actualizar-producto") {
    $id_producto = $_POST['idp'];
    $cantidad = $_POST['canti'];
    $doit= $dTask->actualizarProducto($id_producto, $cantidad);
    echo $doit;
}
if ($opt == "actualizar-producto-2") {
    $id_producto = $_POST['idp'];
    $costo = $_POST['costo'];
    $venta = $_POST['venta'];
    $nombre = $_POST['nombre'];
    $doit= $dTask->actualizarProducto2($id_producto, $costo, $venta, $nombre);
    echo $doit;
}
if ($opt == "cambiar-estado") {
    $estado = $_POST['est'];
    $num_orden = $_POST['num_orden'];
    $doit = $dTask->cambiarEstado($estado, $num_orden);
    echo $doit;
}
if ($opt == "cambiar-estado2") {
    $estado = $_POST['est'];
    $num_orden = $_POST['num_orden'];
    $doit = $dTask->cambiarEstado2($estado, $num_orden);
    echo $doit;
}







if ($opt == "enviar-mail-pedido") {
    $numero_orden = $_POST['n_orden'];

    $pedido = $dTask->mostrarPedido($numero_orden);
    $carrito = $dTask->mostrarCarrito($numero_orden);

    $Nombrecliente = $pedido[0]['nombre'];
    $clienteCorreo = $pedido[0]['correo'];
    $total = $pedido[0]['monto'];


    $mensaje = '
    <!doctype html>
    <html lang="es">
    <head>
        <title>VERDOCHO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Dashboard y administración de Verdocho" name="description" />
        <meta content="Daniel Antonio Sánchez Romero" name="author" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
        <style>
            * {
                font-family: "Open Sans", sans-serif;
            }
            body,
            html {
                margin: 0;
                padding: 0;
            }
            
            table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #eff2f7;
                border-top: 1px solid #eff2f7;
            }
            
            .table td {
                border-top: 1px solid #eff2f7;
            }
        </style>
    </head>
    <body style="background: #fff;">
        <table style="width: 100%; text-align: center; border-spacing: 0; margin: 20px">
            <tr>
                <td></td>
                <td>
                    <img style="margin: 0 auto; text-align: center; width: auto" src="http://verdocho.com/admin/assets/images/logo-sm.png">
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 90%;">
    
                    <table style="border-radius: 15px; background: #009c4c; width: 100%;">
                        <tr>
                            <td></td>
                            <td>
                                <p style="font-size: 200%; font-weight: 600; margin-bottom: 0;">¡Gracias por tu compra!</p>
                                <p style="font-size: 200%; margin-top: 0;">'.$Nombrecliente.'</p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p style="font-size: 200%; font-weight: 600; margin-bottom: 0px;">Tu codigo de seguimiento es:</p>
                                <p style="font-size: 200%; font-weight: 600; background-color: #fff; color: #009c4c; border-radius: 15px; margin-top: 5px; width: 80%; margin: 10px auto; padding: 10px;">'.$numero_orden.'</p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                            <h2>Resumen de orden:</h2>
                                <table class="table" style="border-radius: 15px; background: #fff; width: 80%; margin: 40px auto; padding: 20px;">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad.</th>
                                            <th>P. Unitario</th>
                                            <th style="text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


                                    $envio = "";
                                    foreach($carrito as $da){
                                        if (substr($da['producto'], 0, 14) == "COSTO DE ENVIO") {
                                            $envio = $da['total_unti'];
                                        } else {

                                            $mensaje .= "<tr>";
                                            $mensaje .= "<td>" . $da['producto'] . "</td>";
                                            $mensaje .= "<td>" . $da['cantidad'] . "</td>";
                                            $mensaje .= "<td>" . $da['total_unti'] . "</td>";
                                            $mensaje .= "<td style='text-align: right;' class='text-right'>$" . $da['total_articulo'] . "</td>";
                                            $mensaje .= "</tr>";
                                        }

                                    }


$mensaje .='                         

                                        <tr>
                                        <td colspan="3" style="text-align: right; border: 0;" >
                                            <strong>Envio</strong></td>
                                        <td style="text-align: right; border: 0;" >$ ' . $envio . '</td>
                                        </tr>
                                        <tr>
                                        <td colspan="3" style="text-align: right; border: 0;">
                                            <strong>Total</strong></td>
                                        <td style="text-align: right; border: 0;">
                                            <h4 class="m-0">$ ' . $total .' </h4></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                            <td></td>
                        </tr>
    
                    </table>
                </td>
                <td></td>
            </tr>
    
        </table>
    </body>
    </html>
    ';

    $correo = "ventas@verdocho.com";
    $pass = 'W$xo7B8NL%V1';
    $host = 'premium131.web-hosting.com';
    $puerto = 465;

    $mail->Mailer = "smtp";
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $correo; 
    $mail->Password = $pass;
    $mail->From = $correo;
    $mail->FromName = "Ventas Verdocho";

    $mail->AddAddress("dsanchez.atsv@gmail.com"); 
    $mail->Subject = "PEDIDO VERDOCHO";
    $mail->Body = $mensaje;
    $mail->AltBody = "Pedido Verdocho";
    $exito = $mail->Send();

    if(!$exito) {
        echo "0 - " . $mail->ErrorInfo;
    } else {
        echo "1";
    } 


    // echo "Hola";

}

?>