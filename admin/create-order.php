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

$usuarios = $dTask->cargarClientes();
$num_orden = $dTask->generarCodigo(6);
$clientes = $dTask->cargarClientes();
$stock = $dTask->cargarStock();

$nivel = $_SESSION['nivel'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Crear Pedido | VERDOCHO</title>
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
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/app-2.css?v=0.0.1" type="text/css">
    <!-- SELECT2-->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

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
                                <h4 class="page-title mb-0 font-size-18 font-lemon">Crear cliente</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active" style="color: white;">Puedes agregar un cliente</li>
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="title">Registro de Pedidos</h4>
                                            <p class="card-title-desc">Ingresa todos los datos del pedido</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="title">Número de pedido: <?php echo $num_orden ?></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-lg-0">
                                                <blockquote class="blockquote  blockquote-reverse font-size-16 mb-0">
                                                    <p id="total-pedido">$0</p>
                                                    <footer class="blockquote-footer">Total pedido</footer>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                    <form method="POST" id="frm-pedidos">

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Cliente</label>
                                            <select class="form-control col-md-9 select2-clientes" name="cliente" id="cliente">
                                                <?php
                                                if($clientes){
                                                    foreach($clientes as $key){
                                                        echo "<option value='".$key['idcliente']."'>".$key['nombre']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>  

                                        <div class="form-group row mt-4">
                                            <div class="col-md 6">
                                                <div class="mt-4 mt-lg-0">
                                                    <h5 class="font-size-14 mb-4">Tipo de Pago</h5>
                                                    <div class="custom-control custom-radio mb-2">
                                                        <input type="radio" id="customRadio1" value="1" name="tipo-pago" class="custom-control-input" checkeds>
                                                        <label class="custom-control-label" for="customRadio1">Efectivo</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-2">
                                                        <input type="radio" id="customRadio2" value="2" name="tipo-pago" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">Tarjeta</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-2">
                                                        <input type="radio" id="customRadio3" value="3" name="tipo-pago" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio3">Transferencia</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <ul id="lista-pedidos">

                                                </ul>

                                            </div>
                                        </div>

                                        <div class="spinner-border text-success m-1" id="loader" style="display: none;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>

                                        <button class="btn btn-primary m-3" type="submit" >Procesar Pedido</button>


<div class="form-group">
 <input type="text" class="form-control"  id="search" placeholder="Buscar por nombre...">
</div>

<table class="table-bordered table pull-right" id="mytable" cellspacing="0" style="width: 100%;">
<thead>
    <tr role="row">
        <th>Nombre</th>
        <th>Precio Unitario</th>
        <th>Cantidad</th>
        <th class="text-center" colspan="3">Accion</th>
    </tr>
</thead>
<tbody>
    <?php
    if ($stock) {
        $i = 0;
        foreach($stock as $pro){
            echo "<tr>";
                echo "<td>".$pro['producto']."</td>";
                echo "<td>".$pro['venta']."</td>";
                echo '<td><input name="cantidad" type="text" id="cantidad-'.$i.'" value="1"></td>';
                echo '<td> <span class="btn btn-info" onclick="agregarProducto(\''.$pro['producto'].'\', $(\'#cantidad-'.$i.'\').val(), '.$pro['venta'].', '.$pro['stock_id'].'  )"><i class="mdi mdi-briefcase-plus-outline"></i></span> </td>';
                // echo '<td> <span class="btn btn-secondary" onclick="actualizarProducto(\''.$pro['producto'].'\', $(\'#cantidad-'.$i.'\').val(), '.$pro['venta'].' )"><i class="mdi mdi-briefcase-edit-outline"></i></span> </td>';
                echo '<td> <span class="btn btn-danger" onclick="eliminarProducto(\''.$pro['producto'].'\', $(\'#cantidad-'.$i.'\').val(), '.$pro['venta'].', '.$pro['stock_id'].' )"><i class="mdi mdi mdi-briefcase-remove-outline"></i></span> </td>';
            echo "</tr>";
            $i++;
        }
    }

    ?>
</tbody>
</table>

                                        

                                        <input type="hidden" name="opt" value="create-order">
                                        <input type="hidden" name="numero_orden" id="numero_orden" value="<?php echo $num_orden ?>">
                                        <input type="hidden" name="total-pedido" id="total-pedido-input" value="0">
                                        
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
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script>

        function agregarProducto(producto, cantidad, precio_unitario, ids){
            var num_ord = $("#numero_orden").val();
            $.ajax({
                method: 'POST',
                url: 'php/action.php',
                data: { 'id_prod': producto, 'cant' : cantidad, 'opt' : 'calcular-agregar-carrito', 'num_orde' : num_ord, 'precio_unit' : precio_unitario, 'id_stock' : ids},
                beforesend: function(){
                    $("#loader").show('fast');
                },
                success: function(data){

                    console.log(data);
                    var da = JSON.parse(data);
                    if(da.code == 1){
                        var actual = parseFloat($("#total-pedido-input").val());
                        var nuevo = parseFloat(cantidad) * parseFloat(precio_unitario);
                        var total_carrito = nuevo + actual;
                        $("#total-pedido-input").val(total_carrito);
                        $("#total-pedido").html("$" + total_carrito);
                        cargarCarrito();

                    } else {
                        Swal.fire(da.mensaje , 'Codigo error: ' + da.code2 + ' - Intenta de nuevo...', 'error');
                    }
                    $("#loader").hide('fast');
                },
                error: function(){
                    $("#loader").hide('fast');
                }
            });
        }

        function actualizarProducto(producto, cantidad, precio_unitario){
            var num_ord = $("#numero_orden").val();
            $.ajax({
                method: 'POST',
                url: 'php/action.php',
                data: { 'id_prod': producto, 'cant' : cantidad, 'opt' : 'calcular-actualizar-carrito', 'num_orde' : num_ord, 'precio_unit' : precio_unitario},
                beforesend: function(){
                    $("#loader").show('fast');
                },
                success: function(data){
                    // console.log(data);
                    if(data > 1){
                        // var actual = parseFloat($("#total-pedido-input").val());
                        // var nuevo = parseFloat(cantidad) * parseFloat(precio_unitario);
                        // var total_carrito = nuevo + actual;
                        $("#total-pedido-input").val(data);
                        $("#total-pedido").html("$" + data);
                        cargarCarrito();


                    } else {
                        Swal.fire('¡Algo ocurrio!', 'Intenta de nuevo...', 'error')
                    }
                    $("#loader").hide('fast');
                },
                error: function(){
                    $("#loader").hide('fast');
                }
            });
        }
        function eliminarProducto(producto, cantidad, precio_unitario, ids){
            var num_ord = $("#numero_orden").val();
            $.ajax({
                method: 'POST',
                url: 'php/action.php',
                data: { 'id_prod': producto, 'cant' : cantidad, 'opt' : 'calcular-eliminar-carrito', 'num_orde' : num_ord, 'precio_unit' : precio_unitario, 'id_stock' : ids},
                beforesend: function(){
                    $("#loader").show('fast');
                },
                success: function(data){
                    console.log(data);
                    var da = JSON.parse(data);
                    if(da.code == 1){
                        var actual = parseFloat($("#total-pedido-input").val());
                        var nuevo = parseFloat(cantidad) * parseFloat(precio_unitario);
                        var total_carrito = actual.toFixed(2) - nuevo.toFixed(2);
                        $("#total-pedido-input").val(total_carrito);
                        $("#total-pedido").html("$" + total_carrito);
                        cargarCarrito();

                    } else {
                        Swal.fire(da.mensaje , 'Codigo error: ' + da.code2 + ' - Intenta de nuevo...', 'error');
                    }
                    $("#loader").hide('fast');
                },
                error: function(){
                    $("#loader").hide('fast');
                }
            });
        }

        function cargarCarrito(){
            var num_ord = $("#numero_orden").val();
            $.ajax({
                method: 'POST',
                url: 'php/action.php',
                data: { 'opt' : 'mostrar-todo-carrito', 'num_orde' : num_ord},
                beforesend: function(){
                    $("#loader").show('fast');
                },
                success: function(data){
                    // console.log(data);
                    $("#lista-pedidos").html(data);
                    // Swal.fire('¡Algo ocurrio!', 'Intenta de nuevo...', 'error');
                    $("#loader").hide('fast');
                },
                error: function(){
                    $("#loader").hide('fast');
                }
            });
        }

        $("input[name='cantidad']").TouchSpin({
            min: 0,
            max: 100,
            boostat: 5,
            maxboostedstep: 10
        });

        $(document).ready(function(){
            console.info("Pagina cargada");

            $("#search").keyup(function(){
                _this = this;
                // Show only matching TR, hide rest of them
                $.each($("#mytable tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
                });
            });

            $('.select2-clientes').select2();
            $('.select2-productos').select2();

            

            $("#frm-pedidos").on("submit", function(e){
                e.preventDefault();
                var num_ord = $("#numero_orden").val();
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
                        $("#loader").show('fast');
                    },
                    success: function(data) {
                        console.log(data);
                        // var dat = JSON.parse(data);
                        if (data == 1) {
                            Swal.fire(
                                'Pedido registrado',
                                'Ya puedes crearle pedidos',
                                'success'
                            )
                            var url = "order-state.php?orden=" + num_ord;
                            window.location.assign(url);
                            $("#frm-pedidos").trigger("reset");
                        } else {
                            Swal.fire(
                                '¡Algo ocurrio!',
                                'Intenta de nuevo...',
                                'error'
                            )
                        }
                        $("#loader").hide('fast');
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