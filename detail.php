<?php 
    
    require('koneksi.php');
    function data($query){
        global $koneksi;
        $rows = [];
        $hasil = mysqli_query($koneksi, $query);
        while($result = mysqli_fetch_assoc($hasil)){
            $rows[] = $result;
        }

        return $rows;
    }
    $jorang = $_GET['orang'];
	$jhari = $_GET['hari'];
	$trans = $_GET['trans'];
	$ctrans= $_GET['ctrans'];
    $bus = $_GET['bus'];
	$get_hotel = $_GET['hotel'];
    $get_hoteltransit = $_GET['hoteltransit'];
	$get_kelas = $_GET['kelas'];
    $get_kelastransit = $_GET['kelastransit'];
	$get_hmax = $_GET['hmax'];
	$get_hmin = $_GET['hmin'];
	$get_rumah_makan = explode(',', $_GET['rumah_makan']);	
	$get_wisata = explode(',', $_GET['wisata']);	
	$get_rental = json_decode($_GET['jrental'],true);
    $nm_rental=[];
    foreach ($get_rental as $x){
        array_push($nm_rental, $x['nama']);
    }

	$destinasi ="";

	if ($ctrans == "Pesawat") {
		$destinasi = data("SELECT * FROM transportasi WHERE asal='$trans'");
	} else if ($ctrans == "Kapal") {
        $bus = data("SELECT * FROM bus WHERE nama='$bus'");
    }

    
    $hotel = data("SELECT * FROM hotel WHERE nama_hotel='$get_hotel'");
    $hoteltransit = data("SELECT * FROM hotel_transit WHERE nama_hotel='$get_hoteltransit'");
    
    $query_rumah_makan = implode("' OR nama = '", $get_rumah_makan);
	$rumah_makan = data("SELECT * FROM rumah_makan WHERE nama ='".$query_rumah_makan."'");

	$query_wisata = implode ("' OR nama_wisata = '", $get_wisata);
	$wisata = data("SELECT * FROM wisata WHERE nama_wisata ='".$query_wisata."'");

	$query_rental = implode("' OR nama ='",$nm_rental);
	$rental = data("SELECT * FROM rental WHERE nama ='".$query_rental."'");
		
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Selayar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="plans/css/mdb.min.css">
    <link rel="stylesheet" href="plans/css/all.css">
    <link rel="stylesheet" href="plans/css/style.css">
    <link rel="stylesheet" href="plans/css/timeline.css">
    
    <link rel="stylesheet" href="vendor/handleCounter/css/handle-counter.min.css">
    <script src="plans/sweetalert/sweetalert2.all.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>

        .uper:hover {
  background-color: #39A2DB; /* Green */
  color: white;
}
    </style>
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar fixed-top navbar-expand-md bg-white poppins" style="transition: 0.3s;box-shadow:none"
        data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="index.php">Visit Selayar</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" id="home" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="blog/destinasi.php">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="blog/akomodasi.php">Akomodasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="blog/kuliner.php">Kuliner</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="banner w-100 d-flex border-bottom align-items-center" style="background-color: #3ac2c7;">
        <div class="banner-text w-50 p-5 text-dark poppins" data-aos="fade-right">
            <h3 class="text-center" style="color: #505050;">Selamat Datang Di Wisata Selayar</h3>
            <h5 class="text-center" style="color: #505050;">Berikut Rincian Rencana yang Telah Anda Buat</h5>
        </div>
        <div class="banner-image w-50" data-aos="fade-left">
            <img src="plans/images/banner2.png" alt="" width="80%">
        </div>
    </div>
    <style>

    </style>

    <!-- Main Content Area -->
    <div class="container" id="mulai">
        <div class="row justify-content-center">
            <div class="destination d-flex shadow-2-strong rounded-5 py-3 justify-content-evenly">
                

                    <?php 
                    
                    if (!empty($destinasi)) {
                    	// code...
                    
                        foreach($destinasi as $row) : 
                    ?>
                    <span class="pb-2"><?= $row['asal'] ?></span>
                    <?php 
                        endforeach; 
                    } else {?>
                    	<span class="pb-2">Makassar</span>
                    <?php
                    }
                    ?>

                
                <!-- <span class="pb-2">Makassar<i class="fas fa-map-marker-alt ms-2"></i></span> -->
                Destination :
                <span class="pb-2">Selayar<i class="fas fa-map-marked-alt ms-2"></i></span>
            </div>
        </div>
        <div class="alert-login-berhasil" data-flashdata="hghjghjg">

            <div class="row mt-5 row-wisata">
                <div class="col-lg-9">
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Jumlah Orang</h5>
                        <div class="row pb-4" data-aos="fade-up">
                            <div class="col-12 col-md-8 col-lg-6">
                                <!-- <input type="number" min="1" name="" id="orang" class="form-control"
                                    placeholder="Masukkan jumlah orang"> -->
                                <div class="col">
                                <input id="orang" type="radio" name="orang" class="radio-hidden"
                                     checked style="">
                                <label for="orang" class="">
                                    <div class="rounded-5 shadow-2-strong box">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h4 class="fw-bold f2"><?php echo $jorang." Orang" ?></h4>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            </div>
                        </div>
                    </section>
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Jumlah Hari</h5>
                        <div class="row pb-4" data-aos="fade-up">
                            <div class="col-12 col-md-8 col-lg-6">
                                <!-- <input type="number" min="1" name="" id="orang" class="form-control"
                                    placeholder="Masukkan jumlah orang"> -->
                                <div class="col">
                                <input id="hari" type="radio" class="radio-hidden"
                                     checked style="">
                                <label for="hari" class="">
                                    <div class="rounded-5 shadow-2-strong box">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h4 class="fw-bold f2"><?php echo $jhari." Hari" ?></h4>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            </div>
                        </div>
                    </section>
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Transportasi</h5>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4" data-aos="fade-up">
                        	<?php 
                    if ($ctrans == "Pesawat") {
                        foreach($destinasi as $row) :
                        	$g = $row['status'] ;

                    ?>
                            <div class="col mb-4">
                                <input id="plane" type="radio" name="transportation" class="radio-hidden"
                                    checked>
                                <label for="plane" class="transportation w-100">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">Pesawat</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR <?php echo $row['pesawat'];?> </span><span class="hg-asal"></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>

                            </div>
                            </div>
                            <?php 
                            	if ($g == "transit") { ?>
                                    <!-- -->
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="">
        Detail Penerbangan
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body text-dark">
        <ul class="timeline text-dark">
            <li>
                <h6><?php echo $row['asal'];?></h6>
            </li>
            <li>
                <h6>Bandara Sultan Hasanuddin Makassar</h6>
            </li>
        </ul>
        <h6>Transit di Bandara Sultan Hasanuddin Makassar</h6>
        <ul class="timeline">
            <li>
                <h6>Bandara Sultan Hasanuddin Makassar</h6>
                <p class="pt-3 text-dark" style=""><i class="far fa-clock"></i>&ensp;30 Menit</p>
            </li>
            <li>
                <h6>Bandara H. Aroeppala Selayar</h6>
            </li>
        </ul>
          <h6>* Untuk pemesanan tiket dapat dilakukan secara langsung atau melalui aplikasi pemesanan tiket</h6>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Informasi Hotel di Makassar
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <?php

    ?>
                            <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            $limit = 8;
                            $i=1;
                            foreach($hoteltransit as $row ):
                                //  var_dump($row['standard']);
                                
                                // if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="radio" name="hotel" id="plane<?= $i ?>" class="radio-hidden" checked>
                                <label for="plane<?= $i ?>" class="hotel">
                                    <div class="rounded-5 w-100 shadow-2-strong htl box">
                                        <div class="gambar-container rounded-5">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt=""
                                                class="gambar" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama_hotel'] ?></h6>

                                            <span class="f1 abu"><?= $row['alamat'] ?></span>
                                            <span class="f1">telp : <?= $row['telepon'] ?></span>
                                            <div class="box2">
                                                <div class="fw-bold f2 mt-1">
                                                    <span class="clr2">IDR </span><span
                                                        class="price"><?= $get_kelastransit; ?></span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </label>
                            </div>

                            <?php 
                            $i++;
                            endforeach;
                        ?>

                        </div>
                        <h6>*Untuk pemesanan dapat dilakukan dengan aplikasi pemesanan hotel atau dengan menghubungi nomor yang tertera</h6>
      </div>
    </div>
  </div>
                                    </div>
                                    <!-- -->
                                    
                                    
                             	   
                            
                            <?php
                        } elseif ($g == "langsung") { ?>
                                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Detail Penerbangan
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body text-dark">
        <ul class="timeline">
            <li>
                <h6><?php echo $row['asal'];?></h6>
                <p class="pt-3 text-dark" style=""><i class="far fa-clock"></i>&ensp;30 Menit</p>
            </li>
            <li>
                <h6>Bandara H. Aroeppala Selayar</h6>
            </li>
        </ul>
          <h6>* Untuk pemesanan tiket dapat dilakukan secara langsung atau melalui aplikasi pemesanan tiket</h6>
      </div>
    </div>
  </div>
</div>
                        <?php } ?>
                        
                        
                        <?php
                            endforeach;
                            }else if ($ctrans =="Kapal") {
                            ?>
                    	<div class="col mb-4">
                                <input id="plane" type="radio" name="transportation" class="radio-hidden"
                                    checked>
                                <label for="plane" class="transportation w-100">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">Kapal</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR 200.000 </span><span class="hg-asal"></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                        <!-- ---------------------------------------------------------- -->
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="">
                        Detail Perjalanan
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body text-dark">
                            <ul class="timeline text-dark">
                                <li>
                                    <h6>Terminal Mallengkeri Makassar</h6>
                                    <p class="pt-3 text-dark" style=""><i class="far fa-clock"></i>&ensp;5 Jam</p>
                                </li>
                                <li>
                                    <h6>Pelabuhan Bira Bulukumba</h6>
                                    <p class="pt-3 text-dark" style=""><i class="far fa-clock"></i>&ensp;2 Jam</p>
                                </li>
                                <li>
                                    <h6>Pelabuhan Pammatata Selayar</h6>
                                    <p class="pt-3 text-dark" style=""><i class="far fa-clock"></i>&ensp;1 Jam</p>
                                </li>
                                <li>
                                    <h6>Terminal Bonea Selayar</h6>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                        <!-- --------------------------------------------------------- -->
                    
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Bus dan Travel yang Digunakan
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <?php

                            ?>
                            <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            $limit = 8;
                            $i=1;
                            foreach($bus as $row ):
                                //  var_dump($row['standard']);
                                
                                // if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="radio" name="hotel" id="plane<?= $i ?>" class="radio-hidden" checked>
                                <label for="plane<?= $i ?>" class="hotel">
                                    <div class="rounded-5 w-100 shadow-2-strong box">
                                        <div class="gambar-container rounded-5">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt=""
                                                class="gambar" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama'] ?></h6>
                                            <span class="f1">telp : <?= $row['telepon'] ?></span>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <?php 
                            $i++;
                            endforeach;
                        ?>

                        </div>
                        <h6>*Untuk pemesanan dapat dilakukan dengan menghubungi nomor yang tertera</h6>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- ------------------------------------------------------------ -->
                    <?php 
                    } else{ ?>
                    	<div class="col mb-4">
                                <input id="plane" type="radio" name="transportation" class="radio-hidden"
                                    checked>
                                <label for="plane" class="transportation w-100">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">-</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR - </span><span class="hg-asal"></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <h6>*Anda belum menentukan jenis transportasi</h6>
                    <?php }
                    ?>

                    </section>

                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Hotel</h5>
                        <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            if (!empty($hotel)) {
                            	// code...
                            
                            foreach($hotel as $row ):?>
                            <div class="col mb-4">
                                <input type="radio" name="hotel" id="hoyel" class="radio-hidden" checked>
                                <label for="hoyel" class="hotel">
                                    <div class="rounded-5 w-100 shadow-2-strong box" style="width: auto;">
                                        <div class="gambar-container rounded-5">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt=""
                                                class="gambar" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama_hotel'] ?></h6>

                                            <span class="f1 abu"><?= $row['alamat'] ?></span>
                                            <span class="f1">telp : <?= $row['telepon'] ?></span>
                                            <div class="">
                                                <div class="fw-bold f2 mt-1">
                                                    <span class="clr2">IDR </span><span
                                                        class="price"><?= $get_kelas; ?></span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </label>
                            </div>
                            </div>
                        <h6>*Untuk Pemesanan Silahkan Menghubungi Nomor yang Tertera</h6>
                            <?php 
                            endforeach;
                        } else { ?>
                        	<div class="col mb-4">
                                <input type="radio" name="hotel" id="hoyel" class="radio-hidden" checked>
                                <label for="hoyel" class="hotel">
                                    <div class="rounded-5 w-100 shadow-2-strong box" style="width: auto;">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">-</h6>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            </div>
                        <h6>*Maaf anda belum memilih hotel</h6>
                            <?php
                        }
                        ?>


                    </section>

                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Restaurant</h5>
                        <div class="row row-cols-2 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            foreach ($rumah_makan as $row) :
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="restaurant" id="resto<?= $row['id'] ?>" class="radio-hidden" checked disabled>
                                <label for="resto<?= $row['id'] ?>" class="resto">
                                    <div class="rounded-5 shadow-2-strong box">
                                        <div class="gambar-container rounded-5">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt=""
                                                class="gambar" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama'] ?></h6>
                                            <!-- <span class="f1 abu">Jln. Abdesir 1 Makassar</span> -->
                                            <!-- <div class="rating">
                                                <?php 
                                                $rating = $row['rating'];
                                                $nRating = 5 - $rating;
                                                for($j=0;$j<$rating;$j++): 
                                            ?>
                                                <i class="fas fa-star f1"></i>
                                                <?php 
                                                endfor;
                                                for($j=0;$j<$nRating;$j++) :
                                            ?>
                                                <i class="far fa-star f1"></i>
                                                <?php 
                                                endfor; 
                                            ?>
                                            </div> -->
                                            <div class="fw-bold f2">
                                                <span>Min : </span><span class="clr2">IDR </span><span
                                                    class=""><?= $row['harga_min'] ?></span>
                                            </div>
                                            <div class="fw-bold f2">
                                                <span>Max : </span><span class="clr2">IDR </span><span
                                                    class=""><?= $row['harga_max'] ?></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                            </div>
                            <?php 
                            endforeach;
                        ?>
                        </div>
                    </section>
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Wisata</h5>
                        <div class="row row-cols-2 row-cols-md-4" data-aos="fade-up">
                            <?php
                            foreach ($wisata as $row) :
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="wisata" id="wisata<?= $i ?>" class="radio-hidden" checked disabled>
                                <label for="wisata<?= $i ?>" class="wisata">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="gambar-container rounded-5" style="width: 100%!important;">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt="" class=""
                                                width="100%" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama_wisata'] ?></h6>
                                            <!-- <div class="rating">
                                                <?php 
                                                $rating = $row['rating'];
                                                $nRating = 5 - $rating;
                                                for($j=0;$j<$rating;$j++): 
                                            ?>
                                                <i class="fas fa-star f1"></i>
                                                <?php 
                                                endfor;
                                                for($j=0;$j<$nRating;$j++) :
                                            ?>
                                                <i class="far fa-star f1"></i>
                                                <?php 
                                                endfor; 
                                            ?>
                                            </div> -->
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR </span><span class=""><?= $row['harga'] ?></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                            </div>
                            <?php 
                            endforeach;
                        ?>                            
                        </div>
                    </section>
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Rental</h5>
                        <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">

                            <?php
                            foreach ($rental as $i => $row) :
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="rental" id="rental<?= $i ?>" class="radio-hidden" checked disabled>
                                <label for="rental<?= $i ?>" class="rental">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="gambar-container rounded-5" style="width: 100%!important;">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt="" class=""
                                                width="100%" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama'] ?></h6>
                                            <span class="f1 abu"><?= $row['alamat'] ?></span>
                                            <span class="f1">telp : <?= $row['telepon'] ?></span>
                                            <?php 
                                            $index = "";
                                            for ($i=0; $i < count($get_rental); $i++) { 
                                                if ($get_rental[$i]['nama'] == $row['nama']) {
                                                    $index = $i;
                                                }
                                            }
                                            ?>
                                            <span class="f1">Jumlah : <?php echo $get_rental[$index]['value'] ?></span>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR </span><span class=""><?= $row['harga'] ?></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                            </div>
                            <?php 
                            endforeach;
                        ?>

                        </div>
                        <h6>*Untuk melakukan perentalan silahkan hubungi nomor yang tertera</h6>
                    </section>

                </div>
                <div class="summary-container col-lg-3">
                    <div class="summary container-fluid shadow-2-strong rounded-4 bg-primary py-3 text-light">
                        <h6 class="fw-bold pb-3">Ringkasan</h6>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Transportasi :</div>
                            <div class="row">

                            	<?php 
                                if ($ctrans == "Pesawat") {
                                foreach ($destinasi as $row) { ?>
                            	<div class="col text-start"><?php echo $row['asal'] ?></div>
                                <div class="col text-end"><?php echo $row['pesawat'] ?></div>
                            	<?php } } else {?>
                                <div class="col text-start">Kapal</div>
                                <div class="col text-end">Rp. 200.000</div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Penginapan :</div>
                            <div class="row">
                            	<?php foreach ($hotel as $row ): ?>
                            	<div id="nm-hotel" class="col text-start"><?php echo $row['nama_hotel'] ?></div>
                                <div id="hg-hotel" class="col text-end"><?php echo $get_kelas ?></div>
                            	<?php endforeach ?>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Rumah Makan :</div>
                            <div class="row">
                            	<?php foreach ($rumah_makan as $row ): ?>
                            	<div id="nm-resto" class="col-8 text-start"><?php echo $row['nama'] ?></div>
                                <div id="hg-resto" class="col-4 text-end"><?php echo $row['harga_max'] ?></div>
                            	<?php endforeach ?>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Wisata :</div>
                            <div class="row">
                            	<?php foreach ($wisata as $row): ?>
                            	<div id="nm-wisata" class="col-8 text-start"><?php echo $row['nama_wisata'] ?></div>
                                <div id="hg-wisata" class="col text-end"><?php echo $row['harga'] ?></div>	
                            	<?php endforeach ?>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Rental :</div>
                            <div class="row">
                            	<?php foreach ($rental as $row): ?>
                            	<div id="nm-rental" class="col-8 text-start"><?php echo $row['nama'] ?></div>
                                <div id="hg-rental" class="col text-end"><?php echo $row['harga'] ?></div>
                            	<?php endforeach ?>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Total :</div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="nm-total" class="col text-start"><span id="jmOrang"><?php echo $jorang  ?></span> Orang</div>
                                </div>
                                <div class="col-12">
                                    <div id="hr-total" class="col text-start"><span id="jmHari"><?php echo $jhari ?></span> Hari</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                    <div id="" class="text-start">Minimal</div>
                                    </div>
                                    <div class="col-8">
                                    <div id="hgMin" class="text-end">Rp. <?php echo $get_hmin ?></div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                    <div id="" class="text-start">Maksimal</div>
                                    </div>
                                    <div class="col-8">
                                    <div id="hg-total" class="text-end">Rp. <?php echo $get_hmax ?></div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODALL -->
        <div>
            <!-- Modal total -->
            <div class="modal fade" id="modalTotal" tabindex="-1" aria-labelledby="modalTotalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-center" id="modalTotalLabel">Total Biaya Estimasi Perjalanan
                            </h5>
                        </div>
                        <div class="modal-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-end">Minimal : </td>
                                        <td><span class="text-primary">IDR </span><span id="totalHargaMin"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Maximal : </td>
                                        <td><span class="text-primary">IDR </span><span id="totalHarga"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                                Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="wisataModal" tabindex="-1" aria-labelledby="wisataModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="wisataModalLabel">Pilih Wisata</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-3 row-cols-md-4">
                                <?php
                                    foreach ($wisata as $i => $row) :
                                        if($i < $limit) continue; 
                                ?>
                                <div class="col mb-4">
                                    <input type="checkbox" name="wisata" id="wisata<?= $i ?>" class="radio-hidden"
                                        value="<?= $row['harga'] ?>">
                                    <label for="wisata<?= $i ?>" class="wisata">
                                        <div class="rounded-5 shadow-2-strong box w-100">
                                            <div class="gambar-container rounded-5" style="width: 100%!important;">
                                                <img src="admin/images/<?= $row['gambar'] ?>" alt=""
                                                    class="" width="100%" loading="lazy">
                                            </div>
                                            <div
                                                class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold f2"><?= $row['nama_wisata'] ?></h6>
                                                <!-- <div class="rating">
                                                    <?php 
                                                    $rating = $row['rating'];
                                                    $nRating = 5 - $rating;
                                                    for($j=0;$j<$rating;$j++): 
                                                    ?>
                                                    <i class="fas fa-star f1"></i>
                                                    <?php 
                                                    endfor;
                                                    for($j=0;$j<$nRating;$j++) :
                                                ?>
                                                    <i class="far fa-star f1"></i>
                                                    <?php 
                                                    endfor; 
                                                ?>
                                                </div> -->
                                                <div class="fw-bold f2">
                                                    <span class="clr2">IDR </span><span
                                                        class=""><?= $row['harga'] ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <?php 
                            endforeach;
                        ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                                Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-dark border-top text-center text-lg-start mt-5">
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: white;">
            © 2020 Copyright:
            <a class="text-dark" href="">wisata-selayar.com</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="plans/js/jquery.min.js"></script>
    <script src="plans/js/mdb.min.js"></script>
    <script src="vendor/handleCounter/js/handleCounter.js"></script>
    <script src="plans/js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>