<body id="page-top" class="bg-gradient-dark">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand rotate-n-15 -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="start">
                <div class="sidebar-brand-icon ">
                    <!--<i class="fas fa-building"></i>-->
                    <img src="https://morelliadminprop.com.ar/logo/morelli.png" width="60px">
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="start">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <?php include_once("menu/category.php"); ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    //<!-- Topbar -->
                    include_once("topbar.php");
                    //<!-- End of Topbar -->

                    if($ruta==="blank"){
                        include_once("menu/blank.php");
                    }else if($ruta==="property"){
                        include_once("menu/property.php");
                    }else if($ruta==="newsletter"){
                        include_once("menu/newsletter.php");
                    }else if($ruta==="documents"){
                        include_once("menu/documents.php");
                    }else if($ruta==="payings"){
                        include_once("menu/payings.php");
                    }else if($ruta==="send"){
                        include_once("menu/send.php");
                    }else if($ruta==="publication"){
                        include_once("menu/publication.php");
                    }else if($ruta==="questions"){
                        include_once("menu/questions.php");
                    }else if($ruta==="services"){
                        include_once("menu/services.php");
                    }else if($ruta==="urgencias"){
                        include_once("menu/urgencias.php");
                    }else if($ruta==="getproperty"){
                        include_once("informes/getproperty.php");
                    }else if($ruta==="getnewsletter"){
                        include_once("informes/getnewsletter.php");
                    }else if($ruta==="getdocuments"){
                        include_once("informes/getdocuments.php");
                    }else if($ruta==="getsend"){
                        include_once("informes/getsend.php");
                    }else if($ruta==="getpayings"){
                        include_once("informes/getpayings.php");
                    }else if($ruta==="getpublish"){
                        include_once("informes/getpublish.php");
                    }else{
                        include_once("menu/dashboard.php");
                    }
                ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php
        include_once("modal.php");
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="view/assets/vendor/jquery/jquery.min.js"></script>
    <script src="view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="view/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="view/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="view/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="view/assets/js/demo/chart-area-demo.js"></script>
    <script src="view/assets/js/demo/chart-pie-demo.js"></script>

</body>