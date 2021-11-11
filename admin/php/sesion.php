<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'config/config.php';

$database = new Database();
$db = $database->getConnection();

$usuario = $_POST['usuario'];
$contrase = $_POST['pass'];

$sehizo = 0;
$query = "SELECT * FROM usuarios WHERE usuario = '" . $usuario . "' AND contra = '" . $contrase . "'";
// $query = "SELECT * FROM directorio_usuarios WHERE usuario = '" . $usuario . "' AND pass = '" . $contraseña . "'";
$stmt = $db->prepare($query);
$stmt->execute();
if($stmt->rowCount() == '0'){
    
    $nivel = 0;

}  else {

    $results = $stmt->fetchAll();
    $_SESSION['usuario'] = $results[0]['usuario']; 
    $_SESSION['nombre'] = $results[0]['nombre']; 
    $_SESSION['imagen'] = $results[0]['imagen']; 
    $_SESSION['correo'] = $results[0]['correo']; 
    $nivel = $results[0]['nivel'];
    switch ($nivel) {
        case '1':
            $_SESSION['nivel'] = 'Gestor de pedidos'; 
            break;
        case '2':
            $_SESSION['nivel'] = 'Bodeguero'; 
            break;
        case '3':
            $_SESSION['nivel'] = 'Delivery'; 
            break;
        case '4':
            $_SESSION['nivel'] = 'Administrador'; 
            break;
        
        default:
            $_SESSION['nivel'] = 'Otro'; 
            break;
    }
    
    $sehizo = 1;
    
}



echo json_encode(array('existe' => $sehizo, 'nivel' => $nivel));


?>