<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo e(asset('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/skins/_all-skins.min.css')); ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/morris.js/morris.css')); ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/jvectormap/jquery-jvectormap.css')); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="<?php echo e(asset('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="<?php echo e(asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo e(asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/extra.css')); ?>">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini <?php echo e(Request::is('pos*') ? 'sidebar-collapse ' : ''); ?>">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo e(route('dashboard')); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>D</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>Dashboard</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo e(asset('public/images/avatar5.png')); ?>" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs">Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo e(asset('public/images/avatar5.png')); ?>" class="img-circle"
                                        alt="User Image">

                                    <p>Admin</p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo e(route('my.logout')); ?>" class="btn btn-default btn-flat">Sign
                                            out</a>
                                    </div>
                                </li>
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
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview <?php echo e(Request::is('products*') ? 'active' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-camera"></i>
                            <span>Product</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('products*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('products.index')); ?>"><i class="fa fa-circle-o"></i> All Products
                                </a></li>
                            <li class="<?php echo e(Request::is('products/create*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('products.create')); ?>"><i class="fa fa-circle-o"></i> Add New
                                    Product</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo e(Request::is('bundles*') ? 'active' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-camera"></i>
                            <span>Bundle</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('bundles*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('bundles.index')); ?>"><i class="fa fa-circle-o"></i> All Bundles
                                </a></li>
                            <li class="<?php echo e(Request::is('bundles/create*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('bundles.create')); ?>"><i class="fa fa-circle-o"></i> Add New
                                    Bundle</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo e(Request::is('customers*') ? 'active' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Customer</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('customers*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('customers.index')); ?>"><i class="fa fa-circle-o"></i> All
                                    Customers
                                </a></li>
                            <li class="<?php echo e(Request::is('customers/create*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('customers.create')); ?>"><i class="fa fa-circle-o"></i> Add New
                                    Customer </a></li>
                        </ul>
                    </li>
                    <li class="<?php echo e(Request::is('pos*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('pos.index')); ?>">
                            <i class="fa fa-line-chart"></i> <span>Point Of Sale</span>
                        </a>
                    </li>
                    <?php if(Auth::user()->is_admin): ?>
                        <li class="<?php echo e(Request::is('accounts*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('accounts.index')); ?>">
                                <i class="fa fa-dollar"></i> <span>Transactions</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="treeview <?php echo e(Request::is('orders*') ? 'active' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Order</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('orders*') ? 'active' : ''); ?>"><a
                                    href="<?php echo e(route('orders.index')); ?>"><i class="fa fa-circle-o"></i> All Orders </a>
                            </li>
                        </ul>
                    </li>
                    <?php if(Auth::user()->is_admin): ?>
                        <li class="<?php echo e(Request::is('settings') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('settings.edit')); ?>">
                                <i class="fa fa-cogs"></i> <span>Settings</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php echo $__env->yieldContent('content'); ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
        </footer>

    </div>

    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('public/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo e(asset('public/bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);

    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo e(asset('public/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo e(asset('public/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo e(asset('public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo e(asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo e(asset('public/bower_components/jquery-knob/dist/jquery.knob.min.js')); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo e(asset('public/bower_components/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo e(asset('public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>">
    </script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo e(asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo e(asset('public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('public/bower_components/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('public/dist/js/adminlte.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('public/dist/js/demo.js')); ?>"></script>
    <!-- page script -->

    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH C:\wamp\www\projectNafizVai\resources\views/layouts/app2.blade.php ENDPATH**/ ?>