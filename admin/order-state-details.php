<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'php/config/config.php';
include_once 'php/clases/main.php';

$database = new Database();
$db = $database->getConnection();

$dTask = new allTask($db);

$numero_orden = $_REQUEST['orden'];
$carrito = $dTask->mostrarCarrito($numero_orden);
$pedido = $dTask->mostrarPedido($numero_orden);

$nivel = $_SESSION['nivel'];

$nombre = substr($pedido[0]['nombre'], 1, strpos($pedido[0]['nombre'], " ")) ;
// echo "EXTRAIDO " . $nombre . " HASTA AQUI ";

// if ($pedido[0]['tipo_pago'] == )

// $cliente = $dTask->mostrarCliente();

$nombre_tipo_pago = "";
switch ($pedido[0]['tipo_pago']) {
    case '1':
        $nombre_tipo_pago = "Efectivo";
        break;
    case '2':
        $nombre_tipo_pago = "Tarjeta";
        break;
    case '3':
        $nombre_tipo_pago = "Transferencia";
        break;
    
    default:
        $nombre_tipo_pago = "Error";
        break;
}

if ($pedido[0]['estado1']) {
    $f1 = new DateTime($pedido[0]['estado1']);
    $fecha1 = $f1->format('M, d');
    $est_f1 = "success";
} else {
    $fecha1 = '<i class="mdi mdi-spin mdi-loading"></i>';
    $est_f1 = "danger";
}

if ($pedido[0]['estado2']) {
    $f2 = new DateTime($pedido[0]['estado2']);
    $fecha2 = $f2->format('M, d');
    $est_f2 = "success";
} else {
    $fecha2 = '<i class="mdi mdi-spin mdi-loading"></i>';
    $est_f2 = "danger";
}

if ($pedido[0]['estado3']) {
    $f3 = new DateTime($pedido[0]['estado3']);
    $fecha3 = $f3->format('M, d');
    $est_f3 = "success";
} else {
    $fecha3 = '<i class="mdi mdi-spin mdi-loading"></i>';
    $est_f3 = "danger";
}

if ($pedido[0]['estado4']) {
    $f4 = new DateTime($pedido[0]['estado4']);
    $fecha4 = $f4->format('M, d');
    $est_f4 = "success";
} else {
    $fecha4 = '<i class="mdi mdi-spin mdi-loading"></i>';
    $est_f4 = "danger";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | VERDOCHO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dashboard y administración de Verdocho" name="description" />
    <meta content="Daniel Antonio Sánchez Romero" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- jquery.vectormap css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/app-2.css?v=0.0.1" type="text/css">
    <!-- SELECT2-->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="container-fluid">
                        <div class="float-right">

                            <div class="dropdown d-inline-block d-lg-none ml-2">
                                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-magnify"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                                    <form class="p-3" action="order-state-details.php" metohd="GET">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Buscar Orden..." aria-label="Recipient's username">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="dropdown d-none d-lg-inline-block ml-1">
                                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                    <i class="mdi mdi-fullscreen"></i>
                                </button>
                            </div>



                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-verdocho.jpg" alt="Header Avatar">
                                    <span class="d-none d-xl-inline-block ml-1"><?php echo $_SESSION['nombre'] ?></span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                                </div>
                            </div>

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                    <i class="mdi mdi-settings-outline"></i>
                                </button>
                            </div>

                        </div>
                        <div>
                            <!-- LOGO -->
                            <div class="navbar-brand-box">
                                <a href="index.html" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="assets/images/logo-sm.png" alt="" height="20">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="assets/images/logo-dark.png" alt="" height="17">
                                    </span>
                                </a>

                                <a href="index.html" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="assets/images/logo-sm.png" alt="" height="20">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="assets/images/logo-light-2.png" alt="" height="19">
                                        <!-- <img src="assets/images/logo-sm.png" alt="" height="19"> -->
                                        <!-- <h1>VERDOCHO</h1> -->
                                    </span>
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>

                            <!-- App Search-->
                            <form class="app-search d-none d-lg-inline-block" action="order-state-details.php" metohd="GET">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Buscar Orden...">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div class="h-100">

                    <div class="user-wid text-center py-4">
                        <div class="user-img">
                            <img src="assets/images/users/avatar-verdocho.jpg" alt="" class="avatar-md mx-auto rounded-circle">
                        </div>

                        <div class="mt-3">

                            <a href="#" class="text-dark font-weight-medium font-size-16 font-lemon"><?php echo $_SESSION['nombre'] ?></a>
                            <p class="text-body mt-1 mb-0 font-size-13"><?php echo $_SESSION['nivel'] ?></p>

                        </div>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-calendar-check"></i>
                                    <span>Pedidos</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create-order.php">Crear Orden</a></li>
                                    <li><a href="view-order-2.php">Lista de pedidos</a></li>
                                </ul>
                            </li>

                            <?php
                            if($nivel == "Administrador"){
                                echo '

                                <li>
                                <a href="dashboard.php" class=" waves-effect">
                                    <i class="mdi mdi-airplay"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                                
                                <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-archive-outline"></i>
                                    <span>Stock</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create-stock.php">Añadir Producto</a></li>
                                    <li><a href="view-stock.php">Gestionar Stock</a></li>
                                    <li><a href="edit-stock.php">Editar Stock</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-outline"></i>
                                    <span>Clientes</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create-cliente.php">Añadir Clientes</a></li>
                                    <li><a href="view-cliente.php">Gestionar Clientes</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-multiple-outline"></i>
                                    <span>Usuarios</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create-user.php">Añadir Usuario</a></li>
                                    <li><a href="view-user.php">Gestionar Usuarios</a></li>
                                </ul>
                            </li>

                                ';
                            }
                            ?>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18 font-lemon">Ver Pedido</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active" style="color: white;">Puedes ver el estado del pedido</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="timeline-count p-4">
                                        <!-- Timeline row Start -->
                                        <div class="row">

                                            <!-- Timeline 1 -->
                                            <div class="timeline-box col-sm-12 col-md-4 col-lg-4">
                                                <div class="timeline-spacing">
                                                    <div class="item-lable bg-<?php echo $est_f1 ?> rounded">
                                                        <p class="text-center text-white"><?php echo $fecha1 ?></p>
                                                    </div>
                                                    <div class="timeline-line active">
                                                        <div class="dot bg-<?php echo $est_f1 ?>"></div>
                                                    </div>
                                                    <div class="vertical-line">
                                                        <div class="wrapper-line bg-light"></div>
                                                    </div>
                                                    <div class="bg-light p-4 rounded mx-3 text-center">
                                                        <h5>Registro</h5>
                                                        <!-- <p class="text-muted mt-1 mb-0">Sed ut perspiciatis unde omnis it voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Timeline 1 -->

                                            <!-- Timeline 2 -->
                                            <div class="timeline-box col-sm-12 col-md-4 col-lg-4">
                                               <div class="timeline-spacing">
                                               <div class="item-lable bg-<?php echo $est_f2 ?> rounded">
                                                    <p class="text-center text-white"><?php echo $fecha2 ?></p>
                                                </div>
                                                <div class="timeline-line active">
                                                    <div class="dot bg-<?php echo $est_f2 ?>"></div>
                                                </div>
                                                <div class="vertical-line">
                                                    <div class="wrapper-line bg-light"></div>
                                                </div>
                                                <div class="bg-light p-4 rounded mx-3 text-center">
                                                    <h5>Preparado</h5>
                                                    <!-- <p class="text-muted mt-1 mb-0">Vivamus ultrices massa tellus, sed convallis urna interdum eu. Pellentesque habitant morbi tristique eget justo sit amet est varius mollis et quis nisi. Suspendisse potenti. senectus et netus et malesuada fames ac turpis egestas. Donec vitae blandit ipsum. Donec ac tempus nulla.</p> -->

                                                </div>
                                               </div>
                                            </div>
                                            <!-- Timeline 2 -->

                                            <!-- Timeline 3 -->
                                            <div class="timeline-box col-sm-12 col-md-4 col-lg-4">
                                                <div class="timeline-spacing">
                                                    <div class="item-lable bg-<?php echo $est_f3 ?> rounded">
                                                        <p class="text-center text-white"><?php echo $fecha3 ?></p>
                                                    </div>
                                                    <div class="timeline-line active">
                                                        <div class="dot bg-<?php echo $est_f3 ?>"></div>
                                                    </div>
                                                    <div class="vertical-line">
                                                        <div class="wrapper-line bg-light"></div>
                                                    </div>
                                                    <div class="bg-light p-4 rounded mx-3 text-center">
                                                        <h5>Completado</h5>
                                                        <!-- <p class="text-muted mt-1">At vero eos dignissimos ducimus quos dolores et</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Timeline 3 -->

                                            <!-- Timeline 4 
                                            <div class="timeline-box col-sm-12 col-md-6 col-lg-3">
                                                <div class="timeline-spacing">
                                                    <div class="item-lable bg-<?php echo $est_f4 ?> rounded">
                                                        <p class="text-center text-white"><?php echo $fecha4 ?></p>
                                                    </div>
                                                    <div class="timeline-line active">
                                                        <div class="dot bg-<?php echo $est_f4 ?>"></div>
                                                    </div>
                                                    <div class="vertical-line">
                                                        <div class="wrapper-line bg-light"></div>
                                                    </div>
                                                    <div class="bg-light p-4 rounded mx-3 text-center">
                                                        <h5>Completado</h5>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <!-- Timeline 4 -->
                                        </div>
                                        <!-- Timeline row Over -->

                                       

                                        

                                        <!-- Timeline row Over -->
                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="title">Estado de pedido</h4>
                                    <p class="card-title-desc">Detalles del pedido</p>

                                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-right font-size-16">Order # <?php echo $numero_orden ?></h4>
                                        <div class="mb-4">
                                            <img src="assets/images/logo-sm-dark.png" alt="logo-small" height="30" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                    <strong>Contacto:</strong><br>
                                                    <?php echo $pedido[0]['nombre'] ?><br>
                                                    <?php echo $pedido[0]['telefono'] ?><br>
                                                    <?php echo $pedido[0]['correo'] ?><br>
                                                    <!-- Springfield, ST 54321 -->
                                                </address>
                                        </div>
                                        <div class="col-6 text-right">
                                            <address>
                                                    <strong>Enviar a:</strong><br>
                                                    <?php echo $pedido[0]['direccion'] ?><br>
                                                    <?php echo $pedido[0]['municipio'] ?><br>
                                                    <?php echo $pedido[0]['departamento'] ?><br>
                                                    <!-- Springfield, ST 54321 -->
                                                </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-3">
                                            <address>
                                                    <strong>Tipo de pago:</strong><br>
                                                    <?php echo $nombre_tipo_pago ?><br>
                                                    <!-- jsmith@email.com -->
                                                </address>
                                        </div>
                                        <div class="col-6 mt-3 text-right">
                                            <address>
                                                    <strong>Fecha Creación:</strong><br>
                                                    <?php echo $pedido[0]['fecha'] ?><br><br>
                                                </address>
                                        </div>
                                    </div>
                                    <div class="py-2 mt-3">
                                        <h3 class="font-size-15 font-weight-bold">Resumen de orden:</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap" style="color: black;">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th style="width: 70px;">Cantidad.</th>
                                                    <th style="width: 70px;">$ Unitario</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $envio = "";
                                                foreach($carrito as $da){
                                                    if (substr($da['producto'], 0, 14) == "COSTO DE ENVIO") {
                                                        $envio = $da['total_unti'];
                                                    } else {

                                                        echo "<tr>";
                                                        echo "<td>" . $da['producto'] . "</td>";
                                                        echo "<td>" . $da['cantidad'] . "</td>";
                                                        echo "<td>" . $da['total_unti'] . "</td>";
                                                        echo "<td class='text-right'>$" . $da['total_articulo'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                                <!-- <tr>
                                                    <td colspan="2" class="text-right">Sub Total</td>
                                                    <td class="text-right">$1397.00</td>
                                                </tr> -->
                                                <tr>
                                                    <td colspan="3" class="border-0 text-right">
                                                        <strong>Envio</strong></td>
                                                    <td class="border-0 text-right">$ <?php echo $envio ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="border-0 text-right">
                                                        <strong>Total</strong></td>
                                                    <td class="border-0 text-right">
                                                        <h4 class="m-0">$<?php echo $pedido[0]['monto'] ?></h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-print-none">
                                        <div class="float-right">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            <button  onclick="enviarMail('<?php echo $numero_orden ?>')" class="btn btn-primary w-md waves-effect waves-light">Enviar</button>
                                            <i class="mdi mdi-spin mdi-loading" style="display: none;" id="loader"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Amarusv.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                Hecho con <i class="mdi mdi-heart text-danger"></i> Por Daniel Sánchez
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0">Configuración</h5>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Elige el tema</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                    <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                    <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                </div>
            </div>

        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->

    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- <script src="assets/js/pages/dashboard.init.js"></script> -->
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script>

    function enviarMail(orden){
        console.log("Enviando correo...");
        $.ajax({
            url: 'php/action.php',
            method: 'POST',
            data: {"n_orden" : orden, "opt" : "enviar-mail-pedido"},
            beforeSend: function(){
                $("#loader").show('fast');

            },
            success: function(data){
                console.log(data);

                if(data == 1){
                    Swal.fire('Enviado', 'Se ha notificado al cliente', 'success');

                } else {
                    Swal.fire('¡Algo ocurrio!', 'Intenta de nuevo...', 'error');
                }
                $("#loader").hide('fast');

            },
            error: function(){
                Swal.fire('¡Algo ocurrio!', 'Intenta de nuevo...', 'error');
            }

        })

    }
    function goBack() {
        window.history.back();
        console.log("entro aqui");
    }
        $(document).ready(function(){
            console.info("Pagina cargada");
            <?php
                if($nombre == ""){

                    echo "Swal.fire({
                        title: '¡Orden no encontrada!',
                        text: 'La orden que has buscado no se encuentra',
                        type: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        confirmButtonText: 'Regresar',
                        footer: '<button class=\'btn btn-primary\' onclick=\'goBack()\'>Regresar</button>',
                      })";
                } else {

                }

            ?>
        });
    </script>

</body>

</html>