<?php
require('connect.php');
    session_start();
 
    if (!isset($_SESSION['username'])) {
    echo "<script> window.location.replace('login.php') </script>";
}

if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script> window.location.replace('login.php') </script>";
}
if (isset($_POST['user'])) {
    echo "<script> window.location.replace('user_page.php') </script>";
}

if (isset($_POST['add'])) {
    $tag = $_POST['kategori'];
    $main = $_POST['maintag'];
    $sqlVal = "('".$main."','".$tag."')";
    $sql = "SELECT * FROM kategori WHERE kategori = '$tag'";
    $resulta = mysqli_query($db,$sql);
    $datao = $resulta -> fetch_assoc();

    if (empty($datao)) {
        $insert = $db->query("INSERT INTO kategori (main,kategori) VALUES $sqlVal");
            if ($insert) {
                echo "<script type='text/javascript'>alert('Berhasil Menambahkan Kategori');</script>";
            }
    } else {
        echo "<script type='text/javascript'>alert('Kategori telah ada');</script>";
    }
    
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $tag = $_POST['tag'];

    $sqll = "SELECT * FROM kategori WHERE id = '$id'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();
    $beff = $dataa['kategori'];

    $inserto = $db->query("UPDATE kategori SET kategori='$tag' WHERE id='$id'");
    $inserta = $db->query("UPDATE wisata SET kategori='$tag' WHERE kategori = '$beff'");
    $insertel = $db->query("UPDATE hotel SET kategori='$tag' WHERE kategori = '$beff'");
    $inserter = $db->query("UPDATE rumah_makan SET kategori='$tag' WHERE kategori = '$beff'");
    $inserther = $db->query("UPDATE otherkategori SET kategori='$tag' WHERE kategori = '$beff'");
    if ($inserto || $inserta || $insertel || $inserter || $inserther) {
        echo "<script type='text/javascript'>alert('Berhasil Diperbarui');</script>";
    }
}

if (isset($_POST['delete'])) {
    $iddelete = $_POST['delete'];
    $sqll = "SELECT * FROM kategori WHERE id = '$iddelete'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();

    if (!empty($dataa)) {
    $sqlk = "DELETE FROM kategori WHERE id = '$iddelete'";
    $res= mysqli_query($db,$sqlk);
    }
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
    <link href="css/kat.css" rel="stylesheet">
    
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
                                    <li class="breadcrumb-item active" aria-current="page">Rental</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
        </div>   
        <div class="text-end me-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
  <i class="fas fa-plus me-1"></i> Tambahkan Kategori
</button>
        </div>
        <!-- modal add -->

        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Kategori</h5>
                        </button>
                    </div>
                    <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                    data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                    <div class="modal-body">
                        <form method="post" action="kategori.php">
                            <div class="form-group">
                                <label for="select">Main tag&emsp;</label>
                                <select id="select" name="maintag">
          <option selected> Pilih Jenis Kategori </option>
          <option value="wisata">Wisata</option>
          <option value="akomodasi">Akomodasi</option>
          <option value="kuliner">Kuliner</option>
          <option value="other">Lainnya</option>
      </select><br>
                                <label for="kat">Kategori</label>
                                <input type="text" id="kat" class="form-control" name="kategori" placeholder="Masukkan Kategori">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal add -->
            <div class="container-fluid table-responsive" style="overflow-x:auto ; height: 700px; width: 700px;">
                <table class="table align-middle" >
  <thead class="table-primary">
    <tr class="text-center">
    <th scope="col">Main Tag</th>
      <th scope="col">Kategori</th>
      <th scope="col">Edit</th>
      
    </tr>
  </thead>
  <tbody class="table-light">
    <?php
        $sql = "SELECT * FROM kategori ORDER BY main,kategori ASC ";
        $result = mysqli_query($db,$sql);
        while ($row = mysqli_fetch_array($result)) {
            
               ?> <tr class="text-center">
                <td><?php echo $row['main'] ?></td>
                    <td><?php echo $row['kategori'] ?></td>
                    <td>
                        <form method="post" action="kategori.php">
                        <div class="btn-group-vertical" style="display: flex; align-items: center;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id']; ?>">Edit</button>
                        <button type="submit" class="btn btn-secondary" name="delete" onClick="return confirm('Are you sure want to delete?')" value="<?php echo $row['id'] ?>"> Delete </button>   
                        </div>
                        </form>
                    </td>
                    </tr>
                    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="kategori.php">
                                        <div class="form-group">
                                            <label for="tag">Kategori</label>
                                            <input type="text" class="form-control" name="tag" value="<?= $row['kategori']?>">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="edit" class="btn btn-primary" value="<?php echo $row['id']?>">Simpan</button>
                             </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
            }
        
    ?>
</tbody>
</table>

            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                2021
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