<?php 
    $id = $_GET['id'];
    require('connect.php');
    $sql = "SELECT * FROM rumah_makan WHERE id = '$id'";
    $result = mysqli_query($db,$sql);
    $data = $result -> fetch_assoc();
    $objek = $data['nama'];
    
    $sqll = "SELECT * FROM other WHERE nama = '$objek'";
    $resultt = mysqli_query($db,$sqll);
    $dataa = $resultt -> fetch_assoc();

    $sqlll = "SELECT * FROM otherkategori WHERE nama = '$objek'";
    $resulttt = mysqli_query($db,$sqlll);
    $dataaa = $resulttt -> fetch_assoc();

    
    if (!empty($data)) {
        $img ="../admin/images/".$data['gambar'];
        unlink($img);
    }
    
    if (!empty($dataa)) {
        $imgg ="../admin/other/".$dataa['gambar'];
        unlink($imgg);
    }
    
    if (!empty($data)) {
        $hapus ="DELETE FROM rumah_makan WHERE id ='$id'";
        $res1= mysqli_query($db,$hapus);

    if(!empty($dataa)){
        $hapuss ="DELETE FROM other WHERE nama ='$objek'";
        $res2= mysqli_query($db,$hapuss);}

    if (!empty($dataaa)) {
        $hapusss ="DELETE FROM otherkategori WHERE nama ='$objek'";
        $res3= mysqli_query($db,$hapusss);}    

    if ($res1 || $res2 || $res3) {
        echo "<script type='text/javascript'>alert('Berhasil Dihapus');</script>";
        echo "<script> window.location.replace('../admin/index_resto.php') </script>";
    }
    
    } else {
        echo "<script type='text/javascript'>alert('Data Not Found');</script>";
        echo "<script> window.location.replace('../admin/index_resto.php') </script>";
    }
    ?>