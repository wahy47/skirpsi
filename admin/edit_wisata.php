<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script> window.location.replace('login.php') </script>";
}
$nama = $_GET['nama'];
require('connect.php');
$sqlu = "SELECT * FROM wisata WHERE id = '$nama'";
$resultu = mysqli_query($db,$sqlu);
$datu = $resultu -> fetch_assoc();
$checknama = $datu['nama_wisata'];
if(isset($_POST['upload'])){
        
        $uploadsDir = "images/";
        $uploadsother = "other/";
        $allowedFileType = array('jpg','png','jpeg');
        $cp = 0;

        $sql = "SELECT * FROM wisata WHERE id = '$nama'";
        $resulta = mysqli_query($db,$sql);
        $datao = $resulta -> fetch_assoc();
        $checknamas = $datao['nama_wisata'];


        // Velidate if files exist
        if (!empty(array_filter($_FILES['image']['name']))) {
            
            // Loop through file items
            foreach($_FILES['image']['name'] as $id=>$val){

                $sql = "SELECT * FROM wisata WHERE id = '$nama'";
                $resulta = mysqli_query($db,$sql);
                $datao = $resulta -> fetch_assoc();
                $checkimage = $datao['gambar'];
                $checknama = $datao['nama_wisata'];

                $sqlu = "SELECT * FROM other WHERE nama = '$checknama'";
                $resultau = mysqli_query($db,$sqlu);
                $dataou = $resulta -> fetch_assoc();

                // Get files upload path
                $fileName        = $_FILES['image']['name'][$id];
                $tempLocation    = $_FILES['image']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $targetFilePathOther = $uploadsother . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $objek_wisata    = $_POST['objek_wisata'];
                $harga_wisata    =$_POST['harga_wisata'];
                $map             =$_POST['map_wisata'];
                $deskripsi       =$_POST['deskripsi'];
                $uploadOk = 1;
                

                if (empty($checkimage)) {
                if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath) ){
                            $gambar_2 = $fileName;
                            $objek_2 = $objek_wisata;
                            $harga = $harga_wisata;
                            $rating = $rating;
                            $sqlVal = "('".$fileName."', '".$objek_wisata."', '".$harga_wisata."', '".$deskripsi."', '".$map."')";
                            $sqlVall ="('".$fileName."', '".$objek_wisata."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be updated');</script>";
                        }
                    
                } else {
                    echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";

                }} else if (!empty($checkimage)) {
                    if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePathOther) ){
                            $gambar_2 = $fileName;
                            $objek_2 = $objek_wisata;
                            $harga = $harga_wisata;
                            $sqlVal = "('".$fileName."', '".$objek_wisata."', '".$harga_wisata."', '".$deskripsi."', '".$map."')";
                            $sqlVall ="('".$fileName."', '".$objek_wisata."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be updated');</script>";
                        }
                    
                } else {
                    echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";

                }
                } else {
                    echo "<script type='text/javascript'>alert('File could not be updated');</script>";
                }
                 
               
                // Add into MySQL database
                if (empty($checkimage)) {
                        if(!empty($sqlVal)) {
                        $insert = $db->query("UPDATE wisata SET gambar ='$fileName', nama_wisata='$objek_2', harga='$harga', deskripsi='$deskripsi', link='$map' WHERE id='$nama'");
                        if (!empty($datao)) {
                            $inserto = $db->query("UPDATE other SET nama='$objek_2' WHERE nama='$checknamas'");
                        }else{

                        }
                        if($insert) {
                                echo "<script type='text/javascript'>alert('File Succesfully Updated');</script>";
                        
                    } else {
                        echo "<script type='text/javascript'>alert('Files coudn't be updated due to database error');</script>";
                    }
                }
                }else {
                    if(!empty($sqlVall)) {
                    $insert = $db->query("UPDATE wisata SET nama_wisata='$objek_2', harga='$harga', deskripsi='$deskripsi', link='$map' WHERE id='$nama'");
                    $inserto = $db->query("INSERT INTO other (gambar, nama) VALUES $sqlVall");
                    if($insert) {
                        if ($inserto) {
                           echo "<script type='text/javascript'>alert('File Succesfully Uploaded');</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Files coudn't be uploaded due to database error');</script>";
                    }
                }
            }
        }
        } else {

            $objek_wisata    = $_POST['objek_wisata'];
            $harga_wisata    =$_POST['harga_wisata'];
            $deskripsi  =$_POST['deskripsi'];
            $map = $_POST['map_wisata'];
            $insert = $db->query("UPDATE wisata SET nama_wisata='$objek_wisata', harga='$harga_wisata', deskripsi='$deskripsi', link='$map' WHERE id='$nama'");
            $inserto = $db->query("UPDATE other SET nama='$objek_wisata' WHERE nama='$checknama'");
            if($insert) {
                if ($inserto) {
                   echo "<script type='text/javascript'>alert('File Succesfully Updated');</script>";
                }
            } else {
            echo "<script type='text/javascript'>alert('Files coudn't be updated due to database error');</script>";

        }
    }
    // $tag=$_POST['tag'];
    // $sqvalue = "";
    // $h = 0;

    // foreach ($tag as $key) {
    //     $sql = "SELECT * FROM wisata WHERE nama = '$checknama'";
    //     $result = mysqli_query($db,$sql);
    //     $data = $result -> fetch_assoc();
    //     $kat =$data['kategori'];
    //   if (empty($kat)) {
    //          $inserto = $db->query("UPDATE wisata SET kategori='$key' WHERE nama='$checknama'");
    //          if ($inserto) {
    //             echo "<script type='text/javascript'>alert('Success');</script>";
    //          }
    //     }
    // }

}

if(isset($_POST['deletemain'])){
    $sql = "SELECT * FROM wisata WHERE id = '$nama'";
    $result = mysqli_query($db,$sql);
    $data = $result -> fetch_assoc();
    $img ="../admin/images/".$data['gambar'];
    unlink($img);
    $isi="";
    $sqlk = "UPDATE wisata SET gambar='$isi' WHERE id = '$nama'";
    $res= mysqli_query($db,$sqlk);
    }

if(isset($_POST['deleteother'])){
    $idother = $_POST['deleteother'];
    $sqll = "SELECT * FROM other WHERE id = '$idother'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();
    if (!empty($dataa)) {
    $img ="../admin/other/".$dataa['gambar'];
    unlink($img);
    $sqlk = "DELETE FROM other WHERE id = '$idother'";
    $res= mysqli_query($db,$sqlk);
    }
    }

if(isset($_POST['dtagmain'])){
    $isi = "";
    $sqlk = "UPDATE wisata SET kategori='$isi' WHERE id = '$nama'";
    $res= mysqli_query($db,$sqlk);
    }

if(isset($_POST['dtagsec'])){
    $dtagsec = $_POST['dtagsec'];
    $sqlk = "DELETE FROM otherkategori WHERE nama = '$checknama' AND kategori='$dtagsec'";
    $res= mysqli_query($db,$sqlk);
    }

if(isset($_POST['adtag'])){
    $tags = $_POST['adtag'];
    $sqll = "SELECT * FROM wisata WHERE nama_wisata = '$checknama'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();
    $kat =$dataa['kategori'];
    if (empty($kat)) {
        $sqlk =("UPDATE wisata SET kategori='$tags' WHERE nama_wisata='$checknama'");
        $res= mysqli_query($db,$sqlk);
    } else {
        $sqlVall ="('".$tags."', '".$checknama."')";
        $sqlk =("INSERT INTO otherkategori (id, kategori, nama) VALUES (NULL, '$tags', '$checknama')");
        $res= mysqli_query($db,$sqlk);
    }
    }

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
    <title>Edit data</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <!-- Custom CSS -->
    <link href="../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/cb.css" rel="stylesheet">
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
        <!-- End Left Sidebar-->
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
                        <h3 class="page-title mb-0 p-0">Database</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="index.php">Database</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
        </div>
        <?php
        $nama = $_GET['nama'];
        $sql = "SELECT * FROM wisata WHERE id = '$nama'";
        $result = mysqli_query($db,$sql);
        $data = $result -> fetch_assoc();
        $objek = $data['nama_wisata'];
        $mt = $data['kategori'];
        

    ?>
            <div class="container-fluid">
                <form method="post" action="edit_wisata.php?nama=<?php echo $nama?>" enctype="multipart/form-data">
                    <div class="container" id="">
                        <div class="row justify-content-center">                         
                            <div class="card">
                                <div class="card-header fs-1 text-center bg-secondary text-light">
                                Edit Data
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                    <label for="objek_wisata" class="form-label">Objek Wisata</label>
                                    <input type="text" class="form-control" name="objek_wisata" value="<?= $data['nama_wisata']?>">
                                    </div>
                                    <div class="mb-3">
                                    <label for="harga_wisata" class="form-label">Harga</label>
                                    <input type="text" class="form-control" name="harga_wisata" value="<?= $data['harga']?>">
                                    </div>
                                    <div class="mb-3">
                                    <label for="map_wisata" class="form-label">Link Map</label>
                                    <input type="text" class="form-control" name="map_wisata" value="<?= $data['link']?>">
                                    </div>
                                    <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="textare" class="form-control" name="deskripsi" value=""><?php echo $data['deskripsi']?></textarea>
                                    </div>

                                    <div>
                                    <label class="form-label">Kategori</label>
                                    <ul>
                                    <?php 
                                    if (!empty($data['kategori'])) {?>
                                        <li>
                                        <span><?= $data['kategori']?>&emsp;</span><button class="btn btn-link" name="dtagmain" ><i class="fas fa-trash"></i></button>
                                        </li>
                                     
                                        <?php }
                                        $sqlu = "SELECT * FROM otherkategori WHERE nama='$objek'";
                                        $results = mysqli_query($db,$sqlu);
                                        while ($row = mysqli_fetch_array($results)) {
                                        if (!empty($results)) { ?>
                                            <li>
                                        <span><?= $row['kategori']?>&emsp;</span><button class="btn btn-link" name="dtagsec" value="<?= $row['kategori']?>"><i class="fas fa-trash"></i></button>
                                        </li>
                                    <?php }}?>
                                    </ul>
                                    </div>
                                    <div>
                                    <label class="form-label">Tambahkan Kategori</label>
                                    <ul>
                                    <?php
                                    $tag = "wisata";
                                    $sqlu = "SELECT * FROM kategori WHERE kategori <> '$mt' AND kategori NOT IN (SELECT kategori FROM otherkategori WHERE nama='$objek') AND main IN ('wisata','other')";
                                    $results = mysqli_query($db,$sqlu);
                                    while ($row = mysqli_fetch_array($results)) {
                                    if (!empty($results)) { ?>
                                    <button name="adtag" class="btn btn-info" value="<?php echo $row['kategori'] ?>"><i class="fas fa-plus"></i>&ensp;<?php echo $row['kategori'] ?></button>
                                    <?php 
                                    }}
                                    ?>
                                    </ul>
                                    </div>
                                    
                                    <div class="mb-3">
                                    <label for="gambar_wisata" class="form-label">Gambar</label>
                                    <div class="table-responsive">
                                    <table class="table table-borderless align-center">
                                        <tr>
                                            <td class="text-center">
                                               <img src="images/<?=$data['gambar']?>" style="height:200px;"><br /><br/>
                                               <button class="btn btn-secondary" name="deletemain" onClick="return confirm('Are you sure want to delete?')"> Delete </button>
                                            </td>
                                            <?php 
                                            $sqll = "SELECT id, gambar FROM other WHERE nama='$objek'";
                                            $resultt = mysqli_query($db,$sqll);
                                            while ($row = mysqli_fetch_array($resultt)) {
                                                if (!empty($resultt)) { ?>
                                                    <td class="text-center">
                                                <img src="other/<?=$row['gambar']?>" style="height:200px;"><br /><br/>
                                               <button class="btn btn-secondary" name="deleteother" onClick="return confirm('Are you sure want to delete?')" value="<?php echo $row['id'] ?>"> Delete </button>
                                            </td>        
                                            <?php
                                            }
                                        }
                                            ?>

                                        </tr>
                                    </table>
                                    </div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="uplaod_gambar_wisata" class="form-label">Upload Gambar</label><br>
                                    <input id="uplaod_gambar_wisata" type="file" name="image[]" multiple>
                                </div>
                                <div class="mb-3">
                                    <div class="d-grid col-2 mx-auto">
                                    <input class="btn btn-primary" type="submit" name="upload" value="Simpan">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            
            ?>
            </div>
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