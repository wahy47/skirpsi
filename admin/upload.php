<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script> window.location.replace('login.php') </script>";
}
require('connect.php');
if(isset($_POST['upload'])){
        
        $uploadsDir = "images/";
        $uploadsOther = "other/";
        $allowedFileType = array('jpg','png','jpeg');
        $db = mysqli_connect("localhost","root","","db_travel");
        $cp = 0;
        $cf = 0;
        // Velidate if files exist
        if (!empty(array_filter($_FILES['image']['name'])) && !empty($_POST['tag'])) {
            
            // Loop through file items
            foreach($_FILES['image']['name'] as $id=>$val){
                // Get files upload path
                $fileName        = $_FILES['image']['name'][$id];
                $tempLocation    = $_FILES['image']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $targetFilePathOther = $uploadsOther. $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $objek           = $_POST['objek_wisata'];
                $harga           = $_POST['harga_wisata'];
                $map             = $_POST['map_wisata'];
                $des           = $_POST['deskripsi_wisata'];

                $uploadOk = 1;
                if ($cf == 0) {
                    $cf = $cf + 1;
                    if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath)){
                            $sqlVal = "('".$fileName."', '".$objek."', '".$harga."', '".$des."', '".$map."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be uploaded');</script>";
                        }
                    
                    } else {
                        echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";
                        }
                } else {
                    if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePathOther)){
                            $sqlVall = "('".$fileName."', '".$objek."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be uploaded');</script>";
                        }
                    
                    } else {
                        echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";
                }

                }
                // Add into MySQL database
                if ($cp == 0) {
                    $cp = $cp+1;
                    if(!empty($sqlVal)) {
                    $insert = $db->query("INSERT INTO wisata (gambar, nama_wisata, harga,deskripsi,link) VALUES $sqlVal");
                    if($insert) {
                        echo "<script type='text/javascript'>alert('File Succesfully Uploaded');</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Files coudn't be uploaded due to database error');</script>";
                    }
                }
                }else {
                    if(!empty($sqlVall)) {
                    $insert = $db->query("INSERT INTO other (gambar, nama) VALUES $sqlVall");
                    if($insert) {
                        echo "<script type='text/javascript'>alert('File Succesfully Uploaded');</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Files coudn't be uploaded due to database error');</script>";
                    }
                }
                
            }
        }

        $objeks = $_POST['objek_wisata'];
        $tags  = $_POST['tag'];
        $ct    = 0;
        foreach($tags as $chk =>$val)  
            {  

                $kat  = $_POST['tag'][$chk];
                if ($ct==0) {
                    $ct = $ct + 1;
                    $sqt ="('".$kat."')";
                    $sqlk = "UPDATE wisata SET kategori=$sqt WHERE nama_wisata = '$objeks'";
                    $res= mysqli_query($db,$sqlk);
                } else {
                    $sqt ="('".$kat."', '".$objeks."')";
                    $sqlk = "INSERT INTO otherkategori (kategori, nama) VALUES $sqt";
                    $res= mysqli_query($db,$sqlk);
                }
            }

    }




        else {
            echo "<script type='text/javascript'>alert('Pilih Kategori dan Gambar');</script>";
        
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
    <title>Admin Page</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <!-- Custom CSS -->
    <link href="../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/cb.css" rel="stylesheet">
    <style type="text/css">
        .formStyle { 
        
        width: 100%; 
        margin-bottom: 20px; 
        border-bottom-width: 1px; 
        border-bottom-style: solid; 
        border-bottom-color: #ecf0f1; 
        border-top-style: none; 
        border-right-style: none; 
        border-left-style: none; 
        font-size: 20px;
        font-weight: 100;
        color: #000000;
        position: relative;
        }

        .prev{
            background-color: #ffffff;
            width: 60%;
            min-width: 450px;
            position: relative;
            margin: 50px auto;
            padding: 50px 20px;
            border-radius: 7px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.05);

        }
        input[type="file"]{
            display: none;
        }
        .imagelabel{
            display: block;
            position: relative;
            background-color: #025bee;
            color: #ffffff;
            font-size: 18px;
            text-align: center;
            width: 300px;
            padding: 18px 0;
            margin: auto;
            border-radius: 5px;
            cursor: pointer;
        }
        .num_of_files{
            text-align: center;
            margin: 20px 0 30px 0;
        }
        .preview{
            width: 90%;
            position: relative;
            margin: auto;
            display: flex;
            justify-content: space-evenly;
            gap: 20px;
            flex-wrap: wrap;
        }

        figure{
            width: 45%;

        }
        img{
            width: 100%;
        }
        figCaption{
            text-align: center;
            font-size: 2.4 vmin;
            margin-top: 0.5 vmin;
        }
    </style>

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
        <!-- Topbar header - style you can find in pages.scss -->
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
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Upload</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Upload</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
        </div>
        <div class="container-fluid">
            <form method="post" action="upload.php" enctype="multipart/form-data">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card" style="width:700px; border-radius: 25px;">
                            <div class="card-header fs-1 text-center text-dark mt-2 mb-5" style="background-color: white;">
                                TAMBAHKAN OBJEK WISATA
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="formStyle" name="objek_wisata" placeholder="Masukkan Nama Tempat Wisata">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="formStyle" name="harga_wisata" placeholder="Masukkan Harga Tempat Wisata">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="formStyle" name="map_wisata" placeholder="Masukkan Link Map Tempat Wisata">
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="formStyle" name="deskripsi_wisata" placeholder="Masukkan Deskripsi Tempat Wisata"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: 20px;
        font-weight: 100;">Tambahkan Kategori</label>
                                    <ul class="ks-cboxtags">

                        <?php
                        $sqlu = "SELECT * FROM kategori WHERE main IN ('wisata','other')";
                        $results = mysqli_query($db,$sqlu);
                        while ($row = mysqli_fetch_array($results)) {
                        if (!empty($results)) { ?>

                                        <li><input type="checkbox" name="tag[]" id="<?= $row['kategori']?>" value="<?= $row['kategori']?>"><label for="<?= $row['kategori']?>"><?= $row['kategori']?></label></li>

                                        <?php }} ?>
                                    </ul>
                                </div>
                                <div class="mb-5 prev">
                                    <input type="file" id="ima" name="image[]" accept="image/png, image/jpg, image/jpeg" onchange="preview()" multiple>
                                    <label for="ima" class="imagelabel"><i class="fas fa-upload"></i> &nbsp Choose A Photo</label>
                                    <p class="num_of_files" id="numfiles">No Files Choosen</p>
                                    <div class="preview" id="imgpreview">
                                        
                                    </div>
                                </div>
                                <div class="mb-3 text-center" >
                                    <input class="btn btn-primary" type="submit" name="upload" value="Upload Image" >  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                ?? 2021 
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
    <script type="text/javascript">
        let fileInput = document.getElementById("ima");
        let imgContainer = document.getElementById("imgpreview");
        let numoffiles = document.getElementById("numfiles");

        function preview(){
            imgContainer.innerHTML = "";
            numoffiles.textContent = fileInput.files.length +" Files Selected";
            
            for (i of fileInput.files) {
                let reader = new FileReader();
                let figure = document.createElement("figure");
                let figCap = document.createElement("figCaption");

                figCap.innerText = i.name;
                figure.appendChild(figCap);
                reader.onload=()=>{
                    let img = document.createElement("img");
                    img.setAttribute("src",reader.result);
                    figure.insertBefore(img,figCap);
                }
                imgContainer.appendChild(figure)
                reader.readAsDataURL(i);
            }
        }
    </script>
</body>

</html>