<?php
    session_start();
 
    if (!isset($_SESSION['username'])) {
    echo "<script> window.location.replace('login.php') </script>";
}
require('connect.php');
if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script> window.location.replace('login.php') </script>";
}
if (isset($_POST['user'])) {
    echo "<script> window.location.replace('user_page.php') </script>";
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Monsterlite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Monster admin lite design, Monster admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Page</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <!-- Custom CSS -->
    <link href="../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <a href="index.php" class="navbar-brand ms-5">Admin Page</a>

                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse justify-content-md-end" id="navbarSupportedContent" data-navbarbg="skin5">
                    <form method="post">
                    <button class="btn btn-secondary me-md-4" name="user">User</button>
                    <button class="btn btn-secondary me-md-4" name="logout" onClick="return confirm('Are you sure want to logout?')">Logout</button>
                    </form>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="me-3 fas fa-server"
                                    aria-hidden="true"></i><span class="hide-menu">Database Objek Wisata</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index_hotel.php" aria-expanded="false">
                                <i class="me-3 fas fa-server" aria-hidden="true"></i><span
                                    class="hide-menu">Database Hotel</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index_hotel_transit.php" aria-expanded="false">
                                <i class="me-3 fas fa-server" aria-hidden="true"></i><span
                                    class="hide-menu">Database Hotel Makassar</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index_resto.php" aria-expanded="false">
                                <i class="me-3 fas fa-server" aria-hidden="true"></i><span
                                    class="hide-menu">Database Rumah Makan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="upload.php" aria-expanded="false">
                                <i class="me-3 fas fa-upload" aria-hidden="true"></i><span
                                    class="hide-menu">Tambahkan Objek Wisata</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="upload_hotel.php" aria-expanded="false">
                                <i class="me-3 fas fa-upload" aria-hidden="true"></i><span
                                    class="hide-menu">Tambahkan Hotel</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="upload_hotel_transit.php" aria-expanded="false">
                                <i class="me-3 fas fa-upload" aria-hidden="true"></i><span
                                    class="hide-menu">Tambahkan Hotel Transit</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="upload_resto.php" aria-expanded="false">
                                <i class="me-3 fas fa-upload" aria-hidden="true"></i><span
                                    class="hide-menu">Tambahkan Rumah Makan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="transportasi.php" aria-expanded="false">
                                <i class="me-3 fas fa-plane" aria-hidden="true"></i><span
                                    class="hide-menu">Pesawat</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="bus.php" aria-expanded="false">
                                <i class="fas fa-bus" aria-hidden="true"></i><span
                                    class="hide-menu">&nbsp Bus</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="rental.php" aria-expanded="false">
                                <i class="me-3 fas fa-car" aria-hidden="true"></i><span
                                    class="hide-menu">Rental</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="kategori.php" aria-expanded="false">
                                <i class="fas fa-tags" aria-hidden="true"></i><span
                                    class="hide-menu">Kategori</span></a></li> 
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="col-md-6 col-8 align-self-center">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Objek Wisata</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
        </div>                
            <div class="container-fluid table-responsive" style="overflow-x:auto ; height: 1000px; overflow: scroll;">
                <table class="table align-middle" >
  <thead class="table-primary">
    <tr>
      <th scope="col">Gambar</th>
      <th scope="col">Objek Wisata</th>
      <th scope="col">Harga</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Edit</th>
      
    </tr>
  </thead>
  <tbody class="table-light">
    <?php
        $sql = "SELECT * FROM wisata";
        $result = mysqli_query($db,$sql);
        while ($row = mysqli_fetch_array($result)) {
            
               ?> <tr>
                    <td><?php echo "<img src='images/".$row['gambar']."' class='img-thumbnail' width='300' >" ?></td>
                    <td><?php echo $row['nama_wisata'] ?></td>
                    <td><?php echo $row['harga'] ?></td>
                    <td><?php echo $row['deskripsi'] ?></td>
                    <td>
                        <div class="btn-group-vertical" style="display: flex; align-items: center;">
                            <a class="btn btn-success" href="edit_wisata.php?nama=<?php echo $row['id']?>"> Edit </a>
                            <a class="btn btn-danger" href="delete_wisata.php?id=<?php echo $row['id']?>" onClick="return confirm('Are you sure want to delete?')"> Delete </a>   
                        </div>
                    </td>
                    </tr>
                    <?php
            }
        
    ?>
</tbody>
</table>

            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2021
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>