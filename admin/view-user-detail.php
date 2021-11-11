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

$id = $_REQUEST['id'];
$usuarios = $dTask->mostrarUsuariosUnico($id);

switch ($usuarios[0]['nivel']) {
    case '1':
        $nivel = 'Gestor de pedidos'; 
        break;
    case '2':
        $nivel = 'Bodeguero'; 
        break;
    case '3':
        $nivel = 'Delivery'; 
        break;
    case '4':
        $nivel = 'Administrador'; 
        break;
    default:
        $nivel = 'Otro'; 
        break;
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
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/app-2.css?v=0.0.1" type="text/css">

    <style>

    </style>

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
                                <a href="dashboard.php" class=" waves-effect">
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
                                <a href="javascript: void(0);" class="has-arrow waves-effect active">
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
                                <h4 class="page-title mb-0 font-size-18 font-lemon">Actualizar usuario</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active" style="color: white;">Puedes actualizar un usuario</li>
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
                                    <h4 class="title">Actualizacion de usuario</h4>
                                    <p class="card-title-desc">Ingresa los datos del usuario</p>

                                    <form method="POST" id="frm-user">

                                        <div class="form-group row">
                                            <label for="usuario" class="col-md-2 col-form-label">Usuario</label>
                                            <div class="col-md-10">
                                                <input name="usuario" class="form-control" type="text" id="usuario" value="<?php echo $usuarios[0]['usuario'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contra" class="col-md-2 col-form-label">Contraseña</label>
                                            <div class="col-md-10">
                                                <input name="contra" class="form-control" type="text" id="contra" minlength="6" maxlength="12" value="<?php echo $usuarios[0]['contra'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nombre" class="col-md-2 col-form-label">Nombre Completo</label>
                                            <div class="col-md-10">
                                                <input name="nombre" class="form-control" type="text" id="nombre" value="<?php echo $usuarios[0]['nombre'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="correo" class="col-md-2 col-form-label">Correo electronico</label>
                                            <div class="col-md-10">
                                                <input name="correo" class="form-control" type="email" id="correo" value="<?php echo $usuarios[0]['correo'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Nivel</label>
                                            <div class="col-md-10">
                                                <select name="nivel" class="form-control">
                                                    <option value="<?php echo $usuarios[0]['nivel'] ?>"><?php echo $nivel ?></option>
                                                    <option value="1">Gestor de Pedidos</option>
                                                    <option value="2">Bodeguero</option>
                                                    <option value="3">Delivery</option>
                                                    <option value="4">Administrador</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="opt" value="update-user">
                                        <input type="hidden" name="id" value="<?php echo $usuarios[0]['id'] ?>">

                                        <button class="btn btn-primary" type="submit">Registrar</button>


                                    </form>

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

    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function(){
            console.info("Pagina cargada");
            $("#frm-user").on("submit", function(){
                console.info("Cargando formulario...");
                $.ajax({
                    url: 'php/action.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        console.log("Cargando datos de usuario...");
                    },
                    success: function(data) {
                        console.log(data);
                        // var dat = JSON.parse(data);

                        if (data == 1) {
                            Swal.fire(
                                'Usuario actualizar con exito',
                                'Ya puedes inciar sesion',
                                'success'
                            )
                            // $("#frm-user").trigger("reset");
                        } else {
                            Swal.fire(
                                '¡Algo ocurrio!',
                                'Intenta de nuevo...',
                                'error'
                            )
                        }
                    },
                    error: function() {

                        Swal.fire(
                            'Servidor muerto',
                            'Intenta de nuevo...',
                            'error'
                        )

                    }
                });

                return false;
            });
        });
    </script>

</body>

</html>