<?php 
    $id = $_GET['id'];
    require('connect.php');
    $sql = "SELECT * FROM hotel_transit WHERE id = '$id'";
    $result = mysqli_query($db,$sql);
    $data = $result -> fetch_assoc();
    $objek = $data['nama_hotel'];
    
    if (!empty($data)) {
        $img ="../admin/images/".$data['gambar'];
        unlink($img);
    }
    
    if (!empty($data)) {
        $hapus ="DELETE FROM hotel_transit WHERE id ='$id'";
        $res1= mysqli_query($db,$hapus);

    if ($res1) {
        echo "<script type='text/javascript'>alert('Berhasil Dihapus');</script>";
        echo "<script> window.location.replace('../admin/index_hotel_transit.php') </script>";
    }
    
    } else {
        echo "<script type='text/javascript'>alert('Data Not Found');</script>";
        echo "<script> window.location.replace('../admin/index_hotel_transit.php') </script>";
    }
         
    
    ?>