<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'php/config/config.php';
include_once 'php/clases/main.php';
include_once 'php/clases/dashboard.php'; 

$database = new Database();
$db = $database->getConnection();

$dTask = new allTask($db);
$da = new dashboard($db);
$pedidosMesActual = $da->pedidosMesActual();
$pedidosMesPasado = $da->pedidosMesPasado();
if($pedidosMesActual > $pedidosMesPasado){
    $colorPedidos = "success";
    $iconPedidos = "up";
} else {
    $colorPedidos = "danger";
    $iconPedidos = "down";
}
$clientesMesActual = $da->clientesMesActual();
$cumpleanerosdelMes = $da->clientesCumpleaniosMesActual();
$datosVentasActual = $da->datosVentasMesActual();
$datosVentasPasado = $da->datosVentasMesPasado();
if ($datosVentasActual[0]['total'] > $datosVentasPasado[0]['total']) {
    $colorVentasTotal = "success";
} else {
    $colorVentasTotal = "danger";
}
if ($datosVentasActual[0]['venta'] > $datosVentasPasado[0]['venta']) {
    $colorVentasVenta = "success";
} else {
    $colorVentasVenta = "danger";
}
if ($datosVentasActual[0]['costo'] > $datosVentasPasado[0]['costo']) {
    $colorVentasCosto = "success";
} else {
    $colorVentasCosto = "danger";
}

$d1 = new DateTime($datosVentasActual[0]['inicio']);
$fechainicio = $d1->format('d M');
$d2 = new DateTime($datosVentasActual[0]['fin']);
$fechafin = $d2->format('d M');
$diaFin = $d2->format('j');
$d3 = new DateTime($datosVentasActual[0]['inicio']);
$anio = $d3->format('Y');


$proyeccionLinealTotal = round(($datosVentasActual[0]['total'] / $diaFin) * 30, 2) ;
$proyeccionLinealVenta = round(($datosVentasActual[0]['venta'] / $diaFin) * 30, 2) ;
$proyeccionLinealCosto = round(($datosVentasActual[0]['costo'] / $diaFin) * 30, 2) ;

$detalleultimos5pedidos = $da->ultimas5Ventas();
$ventaspordia = $da->ventasPorDiaGrafico();
$ventaspordiaMP = $da->ventasPorDiaGraficoMesPasado();




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
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/app-2.css?v=0.0.2" type="text/css">

    <style>

    </style>

</head>

<body data-layout="detached" data-topbar="colored" >

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
                                                <input type="text" name="orden" class="form-control" placeholder="Buscar Orden..." aria-label="Recipient's username">
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
                                    <!-- item-->
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
                                    <input type="text" name="orden" class="form-control" placeholder="Buscar Orden...">
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
                                <a href="dashboard.php" class=" waves-effect active">
                                    <i class="mdi mdi-airplay"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-calendar-check"></i>
                                    <span>Pedidos</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a target="_blank" href="create-order.php">Crear Orden</a></li>
                                    <li><a target="_blank" href="view-order.php">Lista de pedidos</a></li>
                                </ul>
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
                                <h4 class="page-title mb-0 font-size-18 font-lemon">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active" style="color: white;">¡Bienvenido a la gestion de Verdocho!</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-tag-plus-outline"></i>
                                                </span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-size-16 mt-2">Ordenes del mes</div>
                                        </div>
                                    </div>
                                    <h4 class="mt-4"><?php echo $pedidosMesActual ?></h4>
                                    <p class="mb-0"><span class="text-<?php echo $colorPedidos ?> mr-2"> <?php echo $pedidosMesPasado ?> <i class="mdi mdi-arrow-<?php echo $iconPedidos ?>"></i> </span></p>
                                </div>
                            </div>

                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="text-white-50">
                                        <h5 class="text-white"><?php echo $clientesMesActual ?>+ Nuevos Clientes</h5>
                                        <p><?php echo $cumpleanerosdelMes ?> clientes cumplen años este mes</p>
                                        <div>
                                            <a href="view-user.php" class="btn btn-outline-dark btn-sm">Ver Usuarios</a>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-8">
                                            <div class="mt-4">
                                                <img src="assets/images/widget-img.png" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-print-none">
                                <div class="float-right">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-9 col-md-6">

                        <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Ganancias</h4>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <p><?php echo $fechainicio ?> - <?php echo $fechafin ?>, <?=$anio?>  </p>
                                                <p class="mb-2">Ganancias</p>
                                                <h4 class="d-inline-block align-middle mb-0">$ <?php echo $datosVentasActual[0]['total'] ?></h4> <span class="badge badge-soft-<?=$colorVentasTotal?>"> <?php echo $datosVentasPasado[0]['total'] ?></span>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mt-3">
                                                        <p class="mb-2 text-truncate">Venta</p>
                                                        <h5 class="d-inline-block align-middle mb-0">$ <?php echo $datosVentasActual[0]['venta'] ?></h5> <span class="badge badge-soft-<?=$colorVentasVenta?>"><?php echo $datosVentasPasado[0]['venta'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mt-3">
                                                        <p class="mb-2 text-truncate">Costo</p>
                                                        <h5 class="d-inline-block align-middle mb-0">$ <?php echo $datosVentasActual[0]['costo'] ?></h5> <span class="badge badge-soft-<?=$colorVentasCosto?>"><?php echo $datosVentasPasado[0]['costo'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div>
                                                <p>Proyeccion a: <?php echo $diaFin ?>  </p>
                                                <p class="mb-2">Ganancias</p>
                                                <h4>$ <?= $proyeccionLinealTotal ?></h4>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mt-3">
                                                        <p class="mb-2 text-truncate">Venta</p>
                                                        <h5>$ <?= $proyeccionLinealVenta ?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mt-3">
                                                        <p class="mb-2 text-truncate">Costo</p>
                                                        <h5>$ <?= $proyeccionLinealCosto ?></h5> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Mes Actual</h4>

                                    <div id="line_chart_dashed" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Mes Pasado</h4>

                                    <div id="line_chart_dashed_2" class="apex-charts" dir="ltr"></div>
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
            <h6 class="text-center mb-0">Choose Layouts</h6>

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
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- <script src="assets/js/pages/dashboard.init.js"></script> -->

    <script src="assets/js/app.js"></script>
    <script>
        options = {
            chart: {
                height: 380,
                type: "line",
                zoom: { enabled: !1 },
                toolbar: { show: !1 }
            },
            colors: ["#3b5de7", "#ff715b", "#45cb85"],
            dataLabels: { enabled: !1 },
            stroke: {
                width: [3, 4, 3],
                curve: "straight",
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Ganancias",
                data: [<?php foreach ($ventaspordia as $a) {
                    echo round($a['dif']) . ",";
                } ?>]
            }, {
                name: "Venta",
                data: [<?php foreach ($ventaspordia as $a) {
                    echo round($a['difventa']) . ",";
                } ?>]
            }],
            title: {
                text: "Ventas por día",
                align: "left"
            },
            markers: {
                size: 0,
                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: [<?php foreach ($ventaspordia as $a) {
                    echo "'" . $a['fecha'] . "',";
                } ?>]
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function(e) {
                            return e + " $";
                        }
                    }
                }, {
                    title: {
                        formatter: function(e) {
                            return e + " $";
                        }
                    }
                }]
            },
            grid: {
                borderColor: "#f1f1f1"
            }
        };
        (chart = new ApexCharts(document.querySelector("#line_chart_dashed"), options)).render();



        options = {
            chart: {
                height: 380,
                type: "line",
                zoom: { enabled: !1 },
                toolbar: { show: !1 }
            },
            colors: ["#3b5de7", "#ff715b", "#45cb85"],
            dataLabels: { enabled: !1 },
            stroke: {
                width: [3, 4, 3],
                curve: "straight",
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Ganancias",
                data: [<?php foreach ($ventaspordiaMP as $a) {
                    echo round($a['dif']) . ",";
                } ?>]
            }, {
                name: "Venta",
                data: [<?php foreach ($ventaspordiaMP as $a) {
                    echo round($a['difventa']) . ",";
                } ?>]
            }],
            title: {
                text: "Ventas por día",
                align: "left"
            },
            markers: {
                size: 0,
                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: [<?php foreach ($ventaspordiaMP as $a) {
                    echo "'" . $a['fecha'] . "',";
                } ?>]
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function(e) {
                            return e + " $";
                        }
                    }
                }, {
                    title: {
                        formatter: function(e) {
                            return e + " $";
                        }
                    }
                }]
            },
            grid: {
                borderColor: "#f1f1f1"
            }
        };
        (chart = new ApexCharts(document.querySelector("#line_chart_dashed_2"), options)).render();


    </script>

</body>

</html>