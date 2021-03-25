<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Top Module</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="https://kit.fontawesome.com/ec46e56296.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <!-- <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.2.0/css/AdminLTE.min.css" rel="stylesheet"
        type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.2.0/css/skins/_all-skins.min.css" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.0.0/ui-bootstrap-tpls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/angular-datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="scripts/constants.js"></script>
    <script src="scripts/main.js"></script>
    <link href="dist/css/mystyle.css" rel="stylesheet" type="text/css" />
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('dist/loading.gif') center no-repeat #fafafa;
            /* background-size: 400px 250px; */
        }
    </style>

    <!-- <script>
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut(200);;
        });
    </script> -->
</head>
<!-- sidebar-collapse -->

<body class="skin-red fixed sidebar-mini" ng-app="AppModule" style="font-family: 'Roboto', sans-serif;">
<!-- <div class="se-pre-con"></div> -->
    <div class="wrapper" ng-cloak>
        <div ng-controller="mainheadControl">
            <header class="main-header">
                <!-- Logo -->
                <a href="dashboard.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <img src="dist/img/logotop.jpeg" width="40px">
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <img src="dist/img/logotop.jpeg" width="40px"> &nbsp;
                        <span style="font-weight: 400;">TOP-MODULE</span>
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="notifications-menu">
                                <a href="#">
                                    <i class="fa fas fa-box-open"></i>
                                    <span class="counterhider">Running Project : </span>{{runningproject}}
                                </a>
                            </li>
                            <li class="notifications-menu">
                                <a href="#">
                                    <i class="fa fas fa-box-open"></i>
                                    <span class="counterhider">Completed Projects :</span> {{completeproject}}
                                </a>
                            </li>
                            <li class="notifications-menu">
                                <a href="#">
                                    <i class="fa fas fa-box-open"></i>
                                    <span class="counterhider">Total Project :</span> {{totalproject}}
                                </a>
                            </li>
                            <!-- <li class="notifications-menu">
                                <a href="" >
                                    <i class="fa fas fa-history"></i>
                                    <span class="counterhider">Multiple Orders :</span> 
                                </a>
                            </li> -->
                            <!-- <li class="notifications-menu">
                                <a href="#" >
                                    <i class="fas fa-user-shield"></i>
                                    <span class="counterhider">Admin Users :</span> {{adminCountm}}
                                </a>
                            </li> -->
                            <li class="notifications-menu">
                                <a href="#" >
                                    <i class="fa fas fa-users"></i>
                                    <span class="counterhider">Staff :</span> {{staffCount}}
                                </a>
                            </li>
                            <li class="notifications-menu">
                                <a href="#" >
                                    <i class="fas fa-users"></i>
                                    <span class="counterhider">Vendors :</span> {{vendorCount}}
                                </a>
                            </li>
                            <li class="notifications-menu">
                                <a href="#" >
                                    <i class="fas fa-users"></i>
                                    <span class="counterhider">Customers :</span> {{customerCount}}
                                </a>
                            </li>
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header"><center>No Notification Found!</center></li>
                                    <!-- <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    No Notification Found!
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="dist/img/social.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p class="username">{{username}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fas fa-tachometer-alt"></i> <span>Dashboard</span></i>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fas fa-th-large"></i> <span> Masters</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="messagetemplete.php"><i class="fa fa-circle-o"></i> Message templetes</a></li>
                                <li><a href="parcelcategory.php"><i class="fa fa-circle-o"></i> Parcel categories</a></li>
                                <li><a href="banners.php"><i class="fa fa-circle-o"></i> App banners</a></li>
                                <li><a href="promocode.php"><i class="fa fa-circle-o"></i> Promocode</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="customers.php">
                                <i class="fa fas fa-users"></i> <span>Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="employees.php">
                                <i class="fa fas fa-users"></i> <span>Employees</span>
                            </a>
                        </li>
                        <li class="header">EXTRA</li>
                        <!-- <li><a href="accountsettings.php"><i class="fa fas fa-user-cog text-yellow"></i> <span>Account
                                    Settings</span></a></li> -->
                        <li><a href="#" ng-click="logOutData()"><i class="fa fas fa-power-off text-red"></i>
                                <span>Logout</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
        </div>