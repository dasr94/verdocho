<?php
session_start();
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
                                <a href="javascript: void(0);" class="has-arrow waves-effect active">
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
                                    <h4 class="title">Registro de Cliente</h4>
                                    <p class="card-title-desc">Ingresa todos los datos para registrar a los clientes</p>

                                    <form method="POST" id="frm-cliente">

                                        <div class="form-group row">
                                            <label for="nombre" class="col-md-3 col-form-label">Nombre Completo</label>
                                            <div class="col-md-9">
                                                <input name="nombre" class="form-control" type="text" id="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="col-md-3 col-form-label">Dirección</label>
                                            <div class="col-md-9">
                                                <input name="direccion" class="form-control" type="text" id="direccion">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Departamentos</label>
                                            <select class="form-control col-md-9 select2-departamentos" name="departamento">
                                                <optgroup label="Occidente">
                                                    <option value="Ahuachapán">Ahuachapán</option>
                                                    <option value="Santa Ana">Santa Ana</option>
                                                    <option value="Sonsonate">Sonsonate</option>
                                                </optgroup>
                                                <optgroup label="Centro">
                                                    <option value="La Libertad">La Libertad</option>
                                                    <option value="Chalatenango">Chalatenango</option>
                                                    <option value="Cuscatlan">Cuscatlan</option>
                                                    <option value="San Salvador">San Salvador</option>
                                                    <option value="La Paz">La Paz</option>
                                                    <option value="Cabañas">Cabañas</option>
                                                    <option value="San Vicente">San Vicente</option>
                                                </optgroup>
                                                <optgroup label="Oriente">
                                                    <option value="Usulutan">Usulutan</option>
                                                    <option value="San Miguel">San Miguel</option>
                                                    <option value="Morazan">Morazan</option>
                                                    <option value="La Union">La Union</option>
                                                </optgroup>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Municipio</label>
                                            <select class="form-control col-md-9 select2-municipios" name="municipio">
                                                <option value="AHUACHAPÁN">AHUACHAPÁN</option>
                                                <option value="APANECA">APANECA</option>
                                                <option value="ATIQUIZAYA">ATIQUIZAYA</option>
                                                <option value="CONCEPCIÓN DE ATACO">CONCEPCIÓN DE ATACO</option>
                                                <option value="EL REFUGIO">EL REFUGIO</option>
                                                <option value="GUAYMANGO">GUAYMANGO</option>
                                                <option value="JUJUTLA">JUJUTLA</option>
                                                <option value="SAN FRANCISCO MENÉNDEZ">SAN FRANCISCO MENÉNDEZ</option>
                                                <option value="SAN LORENZO">SAN LORENZO</option>
                                                <option value="SAN PEDRO PUXTLA">SAN PEDRO PUXTLA</option>
                                                <option value="TACUBA">TACUBA</option>
                                                <option value="TURÍN">TURÍN</option>
                                                <option value="CINQUERA">CINQUERA</option>
                                                <option value="DOLORES">DOLORES</option>
                                                <option value="GUACOTECTI">GUACOTECTI</option>
                                                <option value="ILOBASCO">ILOBASCO</option>
                                                <option value="JUTIAPA">JUTIAPA</option>
                                                <option value="SAN ISIDRO">SAN ISIDRO</option>
                                                <option value="SENSUNTEPEQUE">SENSUNTEPEQUE</option>
                                                <option value="TEJUTEPEQUE">TEJUTEPEQUE</option>
                                                <option value="VICTORIA">VICTORIA</option>
                                                <option value="AGUA CALIENTE">AGUA CALIENTE</option>
                                                <option value="ARCATAO">ARCATAO</option>
                                                <option value="AZACUALPA">AZACUALPA</option>
                                                <option value="CANCASQUE">CANCASQUE</option>
                                                <option value="CHALATENANGO">CHALATENANGO</option>
                                                <option value="CITALÁ">CITALÁ</option>
                                                <option value="COMALAPA">COMALAPA</option>
                                                <option value="CONCEPCIÓN QUEZALTEPEQUE">CONCEPCIÓN QUEZALTEPEQUE</option>
                                                <option value="DULCE NOMBRE DE MARÍA">DULCE NOMBRE DE MARÍA</option>
                                                <option value="EL CARRIZAL">EL CARRIZAL</option>
                                                <option value="EL PARAÍSO">EL PARAÍSO</option>
                                                <option value="LA LAGUNA">LA LAGUNA</option>
                                                <option value="LA PALMA">LA PALMA</option>
                                                <option value="LA REINA">LA REINA</option>
                                                <option value="LAS FLORES">LAS FLORES</option>
                                                <option value="LAS VUELTAS">LAS VUELTAS</option>
                                                <option value="NOMBRE DE JESÚS">NOMBRE DE JESÚS</option>
                                                <option value="NUEVA CONCEPCIÓN">NUEVA CONCEPCIÓN</option>
                                                <option value="NUEVA TRINIDAD">NUEVA TRINIDAD</option>
                                                <option value="OJOS DE AGUA">OJOS DE AGUA</option>
                                                <option value="POTONICO">POTONICO</option>
                                                <option value="SAN ANTONIO DE LA CRUZ">SAN ANTONIO DE LA CRUZ</option>
                                                <option value="SAN ANTONIO LOS RANCHOS">SAN ANTONIO LOS RANCHOS</option>
                                                <option value="SAN FERNANDO">SAN FERNANDO</option>
                                                <option value="SAN FRANCISCO LEMPA">SAN FRANCISCO LEMPA</option>
                                                <option value="SAN FRANCISCO MORAZÁN">SAN FRANCISCO MORAZÁN</option>
                                                <option value="SAN IGNACIO">SAN IGNACIO</option>
                                                <option value="SAN ISIDRO LABRADOR">SAN ISIDRO LABRADOR</option>
                                                <option value="SAN LUIS DEL CARMEN">SAN LUIS DEL CARMEN</option>
                                                <option value="SAN MIGUEL DE MERCEDES">SAN MIGUEL DE MERCEDES</option>
                                                <option value="SAN RAFAEL">SAN RAFAEL</option>
                                                <option value="SANTA RITA">SANTA RITA</option>
                                                <option value="TEJUTLA">TEJUTLA</option>
                                                <option value="CANDELARIA">CANDELARIA</option>
                                                <option value="COJUTEPEQUE">COJUTEPEQUE</option>
                                                <option value="EL CARMEN">EL CARMEN</option>
                                                <option value="EL ROSARIO">EL ROSARIO</option>
                                                <option value="MONTE SAN JUAN">MONTE SAN JUAN</option>
                                                <option value="ORATORIO DE CONCEPCIÓN">ORATORIO DE CONCEPCIÓN</option>
                                                <option value="SAN BARTOLOMÉ PERULAPÍA">SAN BARTOLOMÉ PERULAPÍA</option>
                                                <option value="SAN CRISTÓBAL">SAN CRISTÓBAL</option>
                                                <option value="SAN JOSÉ GUAYABAL">SAN JOSÉ GUAYABAL</option>
                                                <option value="SAN PEDRO PERULAPÁN">SAN PEDRO PERULAPÁN</option>
                                                <option value="SAN RAFAEL CEDROS">SAN RAFAEL CEDROS</option>
                                                <option value="SAN RAMÓN">SAN RAMÓN</option>
                                                <option value="SANTA CRUZ ANALQUITO">SANTA CRUZ ANALQUITO</option>
                                                <option value="SANTA CRUZ MICHAPA">SANTA CRUZ MICHAPA</option>
                                                <option value="SUCHITOTO">SUCHITOTO</option>
                                                <option value="TENANCINGO">TENANCINGO</option>
                                                <option value="ANTIGUO CUSCATLÁN">ANTIGUO CUSCATLÁN</option>
                                                <option value="CHILTIUPÁN">CHILTIUPÁN</option>
                                                <option value="CIUDAD ARCE">CIUDAD ARCE</option>
                                                <option value="COLÓN">COLÓN</option>
                                                <option value="COMASAGUA">COMASAGUA</option>
                                                <option value="HUIZÚCAR">HUIZÚCAR</option>
                                                <option value="JAYAQUE">JAYAQUE</option>
                                                <option value="JICALAPA">JICALAPA</option>
                                                <option value="LA LIBERTAD">LA LIBERTAD</option>
                                                <option value="NUEVO CUSCATLÁN">NUEVO CUSCATLÁN</option>
                                                <option value="QUEZALTEPEQUE">QUEZALTEPEQUE</option>
                                                <option value="SACACOYO">SACACOYO</option>
                                                <option value="SAN JOSÉ VILLANUEVA">SAN JOSÉ VILLANUEVA</option>
                                                <option value="SAN JUAN OPICO">SAN JUAN OPICO</option>
                                                <option value="SAN MATÍAS">SAN MATÍAS</option>
                                                <option value="SAN PABLO TACACHICO">SAN PABLO TACACHICO</option>
                                                <option value="SANTA TECLA">SANTA TECLA</option>
                                                <option value="TALNIQUE">TALNIQUE</option>
                                                <option value="TAMANIQUE">TAMANIQUE</option>
                                                <option value="TEOTEPEQUE">TEOTEPEQUE</option>
                                                <option value="TEPECOYO">TEPECOYO</option>
                                                <option value="ZARAGOZA">ZARAGOZA</option>
                                                <option value="CUYULTITÁN">CUYULTITÁN</option>
                                                <option value="EL ROSARIO">EL ROSARIO</option>
                                                <option value="JERUSALÉN">JERUSALÉN</option>
                                                <option value="MERCEDES LA CEIBA">MERCEDES LA CEIBA</option>
                                                <option value="OLOCUILTA">OLOCUILTA</option>
                                                <option value="PARAÍSO DE OSORIO">PARAÍSO DE OSORIO</option>
                                                <option value="SAN ANTONIO MASAHUAT">SAN ANTONIO MASAHUAT</option>
                                                <option value="SAN EMIGDIO">SAN EMIGDIO</option>
                                                <option value="SAN FRANCISCO CHINAMECA">SAN FRANCISCO CHINAMECA</option>
                                                <option value="SAN JUAN NONUALCO">SAN JUAN NONUALCO</option>
                                                <option value="SAN JUAN TALPA">SAN JUAN TALPA</option>
                                                <option value="SAN JUAN TEPEZONTES">SAN JUAN TEPEZONTES</option>
                                                <option value="SAN LUIS LA HERRADURA">SAN LUIS LA HERRADURA</option>
                                                <option value="SAN LUIS TALPA">SAN LUIS TALPA</option>
                                                <option value="SAN MIGUEL TEPEZONTES">SAN MIGUEL TEPEZONTES</option>
                                                <option value="SAN PEDRO MASAHUAT">SAN PEDRO MASAHUAT</option>
                                                <option value="SAN PEDRO NONUALCO">SAN PEDRO NONUALCO</option>
                                                <option value="SAN RAFAEL OBRAJUELO">SAN RAFAEL OBRAJUELO</option>
                                                <option value="SANTA MARÍA OSTUMA">SANTA MARÍA OSTUMA</option>
                                                <option value="SANTIAGO NONUALCO">SANTIAGO NONUALCO</option>
                                                <option value="TAPALHUACA">TAPALHUACA</option>
                                                <option value="ZACATECOLUCA">ZACATECOLUCA</option>
                                                <option value="ANAMORÓS">ANAMORÓS</option>
                                                <option value="BOLÍVAR">BOLÍVAR</option>
                                                <option value="CONCEPCIÓN DE ORIENTE">CONCEPCIÓN DE ORIENTE</option>
                                                <option value="CONCHAGUA">CONCHAGUA</option>
                                                <option value="EL CARMEN">EL CARMEN</option>
                                                <option value="EL SAUCE">EL SAUCE</option>
                                                <option value="INTIPUCÁ">INTIPUCÁ</option>
                                                <option value="LA UNIÓN">LA UNIÓN</option>
                                                <option value="LISLIQUE">LISLIQUE</option>
                                                <option value="MEANGUERA DEL GOLFO">MEANGUERA DEL GOLFO</option>
                                                <option value="NUEVA ESPARTA">NUEVA ESPARTA</option>
                                                <option value="PASAQUINA">PASAQUINA</option>
                                                <option value="POLORÓS">POLORÓS</option>
                                                <option value="SAN ALEJO">SAN ALEJO</option>
                                                <option value="SAN JOSÉ">SAN JOSÉ</option>
                                                <option value="SANTA ROSA DE LIMA">SANTA ROSA DE LIMA</option>
                                                <option value="YAYANTIQUE">YAYANTIQUE</option>
                                                <option value="YUCUAIQUÍN">YUCUAIQUÍN</option>
                                                <option value="ARAMBALA">ARAMBALA</option>
                                                <option value="CACAOPERA">CACAOPERA</option>
                                                <option value="CHILANGA">CHILANGA</option>
                                                <option value="CORINTO">CORINTO</option>
                                                <option value="DELICIAS DE CONCEPCIÓN">DELICIAS DE CONCEPCIÓN</option>
                                                <option value="EL DIVISADERO">EL DIVISADERO</option>
                                                <option value="EL ROSARIO">EL ROSARIO</option>
                                                <option value="GUALOCOCTI">GUALOCOCTI</option>
                                                <option value="GUATAJIAGUA">GUATAJIAGUA</option>
                                                <option value="JOATECA">JOATECA</option>
                                                <option value="JOCOAITIQUE">JOCOAITIQUE</option>
                                                <option value="JOCORO">JOCORO</option>
                                                <option value="LOLOTIQUILLO">LOLOTIQUILLO</option>
                                                <option value="MEANGUERA">MEANGUERA</option>
                                                <option value="OSICALA">OSICALA</option>
                                                <option value="PERQUÍN">PERQUÍN</option>
                                                <option value="SAN CARLOS">SAN CARLOS</option>
                                                <option value="SAN FERNANDO">SAN FERNANDO</option>
                                                <option value="SAN FRANCISCO GOTERA">SAN FRANCISCO GOTERA</option>
                                                <option value="SAN ISIDRO">SAN ISIDRO</option>
                                                <option value="SAN SIMÓN">SAN SIMÓN</option>
                                                <option value="SENSEMBRA">SENSEMBRA</option>
                                                <option value="SOCIEDAD">SOCIEDAD</option>
                                                <option value="TOROLA">TOROLA</option>
                                                <option value="YAMABAL">YAMABAL</option>
                                                <option value="YOLOAIQUÍN">YOLOAIQUÍN</option>
                                                <option value="CAROLINA">CAROLINA</option>
                                                <option value="CHAPELTIQUE">CHAPELTIQUE</option>
                                                <option value="CHINAMECA">CHINAMECA</option>
                                                <option value="CHIRILAGUA">CHIRILAGUA</option>
                                                <option value="CIUDAD BARRIOS">CIUDAD BARRIOS</option>
                                                <option value="COMACARÁN">COMACARÁN</option>
                                                <option value="EL TRÁNSITO">EL TRÁNSITO</option>
                                                <option value="LOLOTIQUE">LOLOTIQUE</option>
                                                <option value="MONCAGUA">MONCAGUA</option>
                                                <option value="NUEVA GUADALUPE">NUEVA GUADALUPE</option>
                                                <option value="NUEVO EDÉN DE SAN JUAN">NUEVO EDÉN DE SAN JUAN</option>
                                                <option value="QUELEPA">QUELEPA</option>
                                                <option value="SAN ANTONIO">SAN ANTONIO</option>
                                                <option value="SAN GERARDO">SAN GERARDO</option>
                                                <option value="SAN JORGE">SAN JORGE</option>
                                                <option value="SAN LUIS DE LA REINA">SAN LUIS DE LA REINA</option>
                                                <option value="SAN MIGUEL">SAN MIGUEL</option>
                                                <option value="SAN RAFAEL ORIENTE">SAN RAFAEL ORIENTE</option>
                                                <option value="SESORI">SESORI</option>
                                                <option value="ULUAZAPA">ULUAZAPA</option>
                                                <option value="AGUILARES">AGUILARES</option>
                                                <option value="APOPA">APOPA</option>
                                                <option value="AYUTUXTEPEQUE">AYUTUXTEPEQUE</option>
                                                <option value="CIUDAD DELGADO">CIUDAD DELGADO</option>
                                                <option value="CUSCATANCINGO">CUSCATANCINGO</option>
                                                <option value="EL PAISNAL">EL PAISNAL</option>
                                                <option value="GUAZAPA">GUAZAPA</option>
                                                <option value="ILOPANGO">ILOPANGO</option>
                                                <option value="MEJICANOS">MEJICANOS</option>
                                                <option value="NEJAPA">NEJAPA</option>
                                                <option value="PANCHIMALCO">PANCHIMALCO</option>
                                                <option value="ROSARIO DE MORA">ROSARIO DE MORA</option>
                                                <option value="SAN MARCOS">SAN MARCOS</option>
                                                <option value="SAN MARTÍN">SAN MARTÍN</option>
                                                <option value="SAN SALVADOR">SAN SALVADOR</option>
                                                <option value="SANTIAGO TEXACUANGOS">SANTIAGO TEXACUANGOS</option>
                                                <option value="SANTO TOMÁS">SANTO TOMÁS</option>
                                                <option value="SOYAPANGO">SOYAPANGO</option>
                                                <option value="TONACATEPEQUE">TONACATEPEQUE</option>
                                                <option value="APASTEPEQUE">APASTEPEQUE</option>
                                                <option value="GUADALUPE">GUADALUPE</option>
                                                <option value="SAN CAYETANO ISTEPEQUE">SAN CAYETANO ISTEPEQUE</option>
                                                <option value="SAN ESTEBAN CATARINA">SAN ESTEBAN CATARINA</option>
                                                <option value="SAN ILDEFONSO">SAN ILDEFONSO</option>
                                                <option value="SAN LORENZO">SAN LORENZO</option>
                                                <option value="SAN SEBASTIÁN">SAN SEBASTIÁN</option>
                                                <option value="SAN VICENTE">SAN VICENTE</option>
                                                <option value="SANTA CLARA">SANTA CLARA</option>
                                                <option value="SANTO DOMINGO">SANTO DOMINGO</option>
                                                <option value="TECOLUCA">TECOLUCA</option>
                                                <option value="TEPETITÁN">TEPETITÁN</option>
                                                <option value="VERAPAZ">VERAPAZ</option>
                                                <option value="CANDELARIA DE LA FRONTERA">CANDELARIA DE LA FRONTERA</option>
                                                <option value="CHALCHUAPA">CHALCHUAPA</option>
                                                <option value="COATEPEQUE">COATEPEQUE</option>
                                                <option value="EL CONGO">EL CONGO</option>
                                                <option value="EL PORVENIR">EL PORVENIR</option>
                                                <option value="MASAHUAT">MASAHUAT</option>
                                                <option value="METAPÁN">METAPÁN</option>
                                                <option value="SAN ANTONIO PAJONAL">SAN ANTONIO PAJONAL</option>
                                                <option value="SAN SEBASTIÁN SALITRILLO">SAN SEBASTIÁN SALITRILLO</option>
                                                <option value="SANTA ANA">SANTA ANA</option>
                                                <option value="SANTA ROSA GUACHIPILÍN">SANTA ROSA GUACHIPILÍN</option>
                                                <option value="SANTIAGO DE LA FRONTERA">SANTIAGO DE LA FRONTERA</option>
                                                <option value="TEXISTEPEQUE">TEXISTEPEQUE</option>
                                                <option value="ACAJUTLA">ACAJUTLA</option>
                                                <option value="ARMENIA">ARMENIA</option>
                                                <option value="CALUCO">CALUCO</option>
                                                <option value="CUISNAHUAT">CUISNAHUAT</option>
                                                <option value="IZALCO">IZALCO</option>
                                                <option value="JUAYÚA">JUAYÚA</option>
                                                <option value="NAHUIZALCO">NAHUIZALCO</option>
                                                <option value="NAHUILINGO">NAHUILINGO</option>
                                                <option value="SALCOATITÁN">SALCOATITÁN</option>
                                                <option value="SAN ANTONIO DEL MONTE">SAN ANTONIO DEL MONTE</option>
                                                <option value="SAN JULIÁN">SAN JULIÁN</option>
                                                <option value="SANTA CATARINA MASAHUAT">SANTA CATARINA MASAHUAT</option>
                                                <option value="SANTA ISABEL ISHUATÁN">SANTA ISABEL ISHUATÁN</option>
                                                <option value="SANTO DOMINGO DE GUZMÁN">SANTO DOMINGO DE GUZMÁN</option>
                                                <option value="SONSONATE">SONSONATE</option>
                                                <option value="SONZACATE">SONZACATE</option>
                                                <option value="ALEGRÍA">ALEGRÍA</option>
                                                <option value="BERLÍN">BERLÍN</option>
                                                <option value="CALIFORNIA">CALIFORNIA</option>
                                                <option value="CONCEPCIÓN BATRES">CONCEPCIÓN BATRES</option>
                                                <option value="EL TRIUNFO">EL TRIUNFO</option>
                                                <option value="EREGUAYQUÍN">EREGUAYQUÍN</option>
                                                <option value="ESTANZUELAS">ESTANZUELAS</option>
                                                <option value="JIQUILISCO">JIQUILISCO</option>
                                                <option value="JUCUAPA">JUCUAPA</option>
                                                <option value="JUCUARÁN">JUCUARÁN</option>
                                                <option value="MERCEDES UMAÑA">MERCEDES UMAÑA</option>
                                                <option value="NUEVA GRANADA">NUEVA GRANADA</option>
                                                <option value="OZATLÁN">OZATLÁN</option>
                                                <option value="PUERTO EL TRIUNFO">PUERTO EL TRIUNFO</option>
                                                <option value="SAN AGUSTÍN">SAN AGUSTÍN</option>
                                                <option value="SAN BUENAVENTURA">SAN BUENAVENTURA</option>
                                                <option value="SAN DIONISIO">SAN DIONISIO</option>
                                                <option value="SAN FRANCISCO JAVIER">SAN FRANCISCO JAVIER</option>
                                                <option value="SANTA ELENA">SANTA ELENA</option>
                                                <option value="SANTA MARÍA">SANTA MARÍA</option>
                                                <option value="SANTIAGO DE MARÍA">SANTIAGO DE MARÍA</option>
                                                <option value="TECAPÁN">TECAPÁN</option>
                                                <option value="USULUTÁN">USULUTÁN</option>


                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telefono" class="col-md-3 col-form-label">Teléfono</label>
                                            <div class="col-md-9">
                                                <input name="telefono" class="form-control" type="text" id="telefono">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail" class="col-md-3 col-form-label">Correo electronico</label>
                                            <div class="col-md-9">
                                                <input name="mail" class="form-control" type="email" id="mail">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail" class="col-md-3 col-form-label">DUI</label>
                                            <div class="col-md-9">
                                                <input name="dui" class="form-control" type="text" id="mail">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-md-3 control-label">Categoria</label>
                                            <select class="form-control col-md-9" name="categoria">
                                                <option value="1">Bajo</option>
                                                <option value="2">Medio</option>
                                                <option value="3">Alto</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-3 col-form-label">Nacimiento</label>
                                            <div class="col-md-9">
                                                <input name="birthday" class="form-control" type="date"  id="example-date-input">
                                            </div>
                                        </div>

                                        <input type="hidden" name="opt" value="create-cliente">
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
    <script src="assets/libs/select2/js/select2.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script>

        $(document).ready(function(){
            console.info("Pagina cargada");

            $('.select2-departamentos').select2();
            $('.select2-municipios').select2();

            $("#frm-cliente").on("submit", function(){
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
                        var dat = JSON.parse(data);
                        if (data == 1) {
                            Swal.fire(
                                'Cliente registrado con exito',
                                'Ya puedes crearle pedidos',
                                'success'
                            )
                            $("#frm-user").trigger("reset");
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