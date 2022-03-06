<?php
    session_start();
 require('connect.php');
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
    $nama = $_POST['nama'];
    $sql = "SELECT * FROM bus WHERE nama = '$nama'";
    $resulta = mysqli_query($db,$sql);
    $datao = $resulta -> fetch_assoc();

    if (empty($datao)) {
        if (!empty(array_filter($_FILES['image']['name']))) {
            $uploadsDir = "images/";
            $allowedFileType = array('jpg','png','jpeg');
            $cp = 0;
            // Loop through file items
            foreach($_FILES['image']['name'] as $id=>$val){

                // Get files upload path
                $fileName        = $_FILES['image']['name'][$id];
                $tempLocation    = $_FILES['image']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $nama = $_POST['nama'];
                $telepon =$_POST['telepon'];
                $uploadOk = 1;
                
                if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath) ){
                            $sqlVal = "('".$fileName."', '".$nama."', '".$telepon."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be updated');</script>";
                        }
                } else {
                    echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";
                }
                 
               
                // Add into MySQL database
                        if(!empty($sqlVal)) {
                        $insert = $db->query("INSERT INTO bus (gambar, nama, telepon) VALUES $sqlVal");
                        if ($insert) {
                            echo "<script type='text/javascript'>alert('Berhasil Menambahkan Data');</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('gagal Menambahkan Data');</script>";
                        }
                        } else {
                            echo "<script type='text/javascript'>alert('Data Telah ada');</script>";
                        }
                }
        }else{
            echo "<script type='text/javascript'>alert('Anda Belum Memilih Gambar');</script>";
        }
}else{
    echo "<script type='text/javascript'>alert('Data Telah ada');</script>";
}}
if (isset($_POST['edit'])) {
    $idedit = $_POST['edit'];
    $uploadsDir = "images/";
    $allowedFileType = array('jpg','png','jpeg');
    $cp = 0;
    $sql = "SELECT * FROM bus WHERE id = '$idedit'";
                $resulta = mysqli_query($db,$sql);
                $datao = $resulta -> fetch_assoc();
                $checkimage= $datao['gambar'];
    if (empty($checkimage)) {
    if (!empty(array_filter($_FILES['image']['name']))) {
                
            // Loop through file items
            
            foreach($_FILES['image']['name'] as $id=>$val){
                

                // Get files upload path
                $fileName        = $_FILES['image']['name'][$id];
                $tempLocation    = $_FILES['image']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $nama = $_POST['nama'];
                $telepon =$_POST['telepon'];
                $uploadOk = 1;
                
                if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath) ){
                            $sqlVal = "('".$fileName."', '".$nama."', '".$telepon."')";
                        } else {
                            echo "<script type='text/javascript'>alert('File could not be updated');</script>";
                        }
                } else {
                    echo "<script type='text/javascript'>alert('Only .jpg, .jpeg and .png file formats allowed');</script>";
                }
                 
               
                // Add into MySQL database
                        if(!empty($sqlVal)) {
                        $insert = $db->query("UPDATE bus SET gambar='$fileName', nama='$nama', telepon='$telepon' WHERE id='$idedit'");
                        }
                        if($insert) {
                                echo "<script type='text/javascript'>alert('File Succesfully Updated');</script>";
                        
                    } else {
                        echo "<script type='text/javascript'>alert('Files coudn't be updated due to database error');</script>";
                    }
                }
            }
        } else {
            $nama = $_POST['nama'];
            $telepon =$_POST['telepon'];
            $inserto = $db->query("UPDATE bus SET nama='$nama', telepon='$telepon' WHERE id='$idedit'");
            if ($inserto) {
                echo "<script type='text/javascript'>alert('Berhasil Diperbarui');</script>";
            }
        }
}

if (isset($_POST['delete'])) {
    $iddelete = $_POST['delete'];
    $sqll = "SELECT * FROM bus WHERE id = '$iddelete'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();
    $img ="../admin/images/".$dataa['gambar'];
    if (!empty($dataa)) {
    unlink($img);
    $sqlk = "DELETE FROM bus WHERE id = '$iddelete'";
    $res= mysqli_query($db,$sqlk);
    }
}
if(isset($_POST['deletemain'])){
    $iddelete = $_POST['deletemain'];
    $sql = "SELECT * FROM bus WHERE id ='$iddelete'";
    $result = mysqli_query($db,$sql);
    $data = $result -> fetch_assoc();
    $img ="../admin/images/".$data['gambar'];
    unlink($img);
    $isi="";
    $sqlk = "UPDATE bus SET gambar='$isi' WHERE id = '$iddelete'";
    $res= mysqli_query($db,$sqlk);
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
        input[type="file"].upg{
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
                    <button class="btn btn-secondary me-md-4"name="user">User</button>
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
                                    <li class="breadcrumb-item active" aria-current="page">Trasportasi</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
        </div>                
            <div class="container-fluid table-responsive" style="overflow-x:auto ; height: 1000px;">
                <table class="table align-middle" >
  <thead class="table-primary">
    <tr class="text-center">
      <th scope="col">Gambar</th>
      <th scope="col">Nama</th>
      <th scope="col">Telepon</th>
      <th scope="col">Edit</th>
      
    </tr>
  </thead>
  <tbody class="table-light">
    <?php
        $sql = "SELECT * FROM bus";
        $result = mysqli_query($db,$sql);
        while ($row = mysqli_fetch_array($result)) {
            $cg = $row['gambar'];
               ?> <tr class="text-center">
                    <td><img style="height:200px; width: auto;" src="../admin/images/<?php echo $row['gambar'] ?>"></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['telepon'] ?></td>
                    <td>
                        <form method="post" action="bus.php" >
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
                                    <form method="post" action="bus.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama">Nama Bus</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $row['nama']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" value="<?= $row['telepon']?>">
                                        </div>
                                        <?php 
                                        if (!empty($cg)) {?>                                            
                                        <div class="text-center">
                                               <img src="images/<?= $row['gambar']?>" style="height:200px; width: 200px;"><br /><br/>
                                               <button class="btn btn-secondary" name="deletemain" value="<?php echo $row['id']?>" onClick="return confirm('Are you sure want to delete?')"> Delete </button><br /><br />
                                        </div>
                                        <?php } else { ?>
                                         <div class="mb-3">
                                    <label for="uplaod_gambar_hotel" class="form-label">Upload Gambar</label><br>
                                    <input id="uplaod_gambar_hotel" type="file" name="image[]" multiple>
                                </div>
                                        <?php }
                                        ?>
                                        
                                            
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
    <tr class="text-center">
        <td colspan="3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
  Tambahkan Data
</button>
        </td>
    </tr>
</tbody>
</table>
    
    <!-- modal -->
    <!-- ============================================================== -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Admin</h5>
                        </button>
                    </div>
                    <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                    data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                    <div class="modal-body">
                        <form method="post" action="bus.php" enctype="multipart/form-data">
                            <div class="form-group">
                                            <label for="nama">Nama Bus</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama Bus">
                                        </div>
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" placeholder="Nomor Telepon">
                                        </div>
                                        <div class="mb-5 prev">
                                    <input type="file" class="upg" id="ima" name="image[]" accept="image/png, image/jpg, image/jpeg" onchange="preview()">
                                    <label for="ima" class="imagelabel"><i class="fas fa-upload"></i> &nbsp Choose A Photo</label>
                                    <p class="num_of_files" id="numfiles">No Files Choosen</p>
                                    <div class="preview" id="imgpreview">
                                        
                                    </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center fixed-bottom">
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