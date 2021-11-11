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

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard Bodega | VERDOCHO</title>
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

                                    <form class="p-3">
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
                            <form class="app-search d-none d-lg-inline-block">
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
                                <a href="dashboard-bodega.php" class=" waves-effect active">
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
                                    <li><a href="view-stock.php">Gestionar Stock</a></li>
                                </ul>
                            </li>
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
                                <h4 class="page-title mb-0 font-size-18 font-lemon">Pedido</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active" style="color: white;">Información del pedido</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
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
                                            <img src="assets/images/logo-sm-dark.png" alt="logo-small" height="60" />
                                            <img src="assets/images/logo-finca.JPG" alt="logo-finca" height="60" />
                                        </div>
                                    </div>
                                    <hr>

                                    <?php

switch ($pedido[0]['categoria']) {
    case '1':
        $badge = '<span class="badge badge-pill badge-danger"> Bajo </span>';
        break;
    case '2':
        $badge = '<span class="badge badge-pill badge-warning"> Medio </span>';
        break;
    case '3':
        $badge = '<span class="badge badge-pill badge-success"> Alto </span>';
        break;
    default:
        $badge = '<span class="badge badge-pill badge-danger"> Bajo </span>';
        break;
}
                                    ?>

                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                    <strong>Cliente:</strong><br>
                                                    <?php echo $pedido[0]['nombre'] ?><br>
                                                    <?php echo $badge ?><br>
                                                    <!-- Springfield, ST 54321 -->
                                                </address>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="py-2 mt-3">
                                        <h3 class="font-size-15 font-weight-bold">Resumen de Orden</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 70px;"></th>
                                                    <th style="width: 70px;">Cantidad</th>
                                                    <th>Costo</th>
                                                    <th>Venta</th>
                                                    <th>Total</th>
                                                    <th>Item</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach($carrito as $da){
                                                    echo "<tr>";
                                                    echo '<td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck'.$i.'">
                                                        <label class="custom-control-label" for="customCheck'.$i.'"></label>
                                                    </div>
                                                </td>';
                                                    echo "<td>" . $da['cantidad'] . "</td>";
                                                    echo "<td>" . $da['costo'] . "</td>";
                                                    echo "<td>" . $da['venta'] . "</td>";
                                                    echo "<td>" . $da['total_articulo'] . "</td>";
                                                    echo "<td>" . $da['producto'] . "</td>";
                                                    echo "<td class='text-right'>$" . $da['total_unti'] . "</td>";
                                                    echo "</tr>";
                                                    $i++;

                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="border-0 text-right">
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
                                            <button onclick="cambiarEstado('Preparado', '<?php echo $numero_orden ?>')" class="btn btn-primary w-md waves-effect waves-light">Listo</button>
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
    <script src="assets/js/app.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function cambiarEstado(estado, orden){
            console.log("Cambiando estado...");
            $.ajax({
                url: 'php/action.php',
                method: 'POST',
                data: {"est" : estado, "num_orden" : orden, "opt" : "cambiar-estado"},
                beforeSend: function(){

                },
                success: function(data){
                    console.log(data);
                    if (data == 1) {
                        window.location.assign("dashboard-bodega.php");
                    } else {
                        Swal.fire('¡Algo ocurrio!', 'Intenta de nuevo...', 'error');
                    }
                },
                error: function(){

                }
            });
        }
        $(document).ready(function(){
            console.log("Pagina cargada");
        });
    </script>

</body>

</html>