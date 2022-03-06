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

    $destinasi = data("SELECT * FROM transportasi");
    $hotel = data("SELECT * FROM hotel");
    $resto = data("SELECT * FROM rumah_makan");
    $wisata = data("SELECT * FROM wisata");
    $rental = data("SELECT * FROM rental");
    $hotel_transit = data("SELECT * FROM hotel_transit");
    $bus = data("SELECT * FROM bus");
    $sql = "SELECT * FROM wisata";
    $result = mysqli_query($db,$sql);
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
            <h5 class="text-center" style="color: #505050;">Rencanakan Perjalanan Anda</h5>
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
                <select name="tujuan" id="tujuan" onChange="seltra(this);" class="" style="border-color: white;">
                    <option value="-">Pilih Asal Kota</option>
                    <?php 
                        foreach($destinasi as $row) : 
                    ?>
                    <option value="<?= $row['pesawat'] ?>" data="<?php echo $row['status'] ?>"><?= $row['asal'] ?></option>

                    <?php 
                        endforeach; 
                    ?>
                </select>
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
                                <div class="handle-counter" id="handleCounter">
                                    <button id="orangMinus" class="counter-minus btn btn-primary">-</button>
                                    <input type="text" value="1" id="orang">
                                    <button id="orangPlus" class="counter-plus btn btn-primary">+</button>
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
                                <div class="handle-counter" id="handleCounter2">
                                    <button id="hariMinus" class="counter-minus btn btn-primary">-</button>
                                    <input type="text" value="1" id="hari">
                                    <button id="hariPlus" class="counter-plus btn btn-primary">+</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-------------------------------- transportasi ------------------------------->
                    <script>
                                function trans(s_nama) {
                                $.ajax({
                                    url:"ajax/modal.php?nama="+s_nama,
                                    type :"GET",
                                    success: function(response){
                                        var data = JSON.parse(response);
                                        $('#namwis').html(data.nama_wisata);
                                        $('#detaildesc').html(data.deskripsi);
                                        document.getElementById("maplink").target = "_self";
                                        document.getElementById("maplink").href = "";
                                        if (data.map === "") {
                                            document.getElementById("maplink").href = "javascript:void(0)";
                                        }else{
                                            document.getElementById("maplink").target = "_blank";
                                            document.getElementById("maplink").href = data.map;
                                        }
                                        
                                        $('#gambardetail').html('');
                                        let gambar =`<div class="carousel-item active">
                                    <img src="admin/images/${data.gambar}" class="d-block w-100" alt="...">
                                    </div>`;
                                        $('#gambardetail').append(gambar);
                                        if (data.othergambar.length > 0) {

                                            for (var i = 0;i < data.othergambar.length; i++) {
                                               let gambar = `<div class="carousel-item">
                                    <img src="admin/other/${data.othergambar[i]}" class="d-block w-100" alt="...">
                                    </div>`;
                                            $('#gambardetail').append(gambar);
                                            }
                                        }

                                    $('#detailtag').html('');
                                    let tag = `${data.kategori}`;
                                    $('#detailtag').append(tag);
                                    if (data.otherkategori.length > 0) {
                                        for (var i=0; i < data.otherkategori.length; i++) {
                                          let tag = `, ${data.otherkategori[i]}`;
                                          $('#detailtag').append(tag);
                                        }
                                    }


                                    }
                                })
                                }
                                
                            </script>
                    <script>
                        function seltra(x){
                            $('#nm-trans').html('');
                            $('#hg-trans').html('');
                            $('#nm-transk').html('');
                            $('#hg-transk').html('');
                            $('#nm-hotelt').html('');
                            $('#hg-hotelt').html('');
                            $('#transport').html('');
                            $('#transportkapal').html('');
                             $('#accordionFlushExample').html('');
                        //console.log($('#tujuan').find('option:selected').text());    
                        $harga = $('#tujuan').find(":selected").val();
                        $kota_asal = $('#tujuan').find('option:selected').text();
                        $status = $('#tujuan').find('option:selected').attr('data');
                        
                        if ($kota_asal != "" && $kota_asal != "Makassar") {
                            // ----------------------------------------
                            let html=`
                            <div id="coba">
                            <input id="plane" type="radio" onChange="selecttrans(this)" name="transportation" class="radio-hidden">
                                <label for="plane" class="transportation w-100" onClick="label(this)" >
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">Pesawat</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR </span><span class="hg-asal"></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>
                                </div>`
                                $('#transport').append(html);
                                
                                // ----------------------------------------
                            
                        // ----------------------------------------
                        } else if ($kota_asal == "Makassar" || $kota_asal == "makassar") {
                            let html=`<input id="plane" type="radio" onChange="selecttrans(this)" name="transportation" class="radio-hidden">
                                <label for="plane" class="transportation w-100" onClick="label(this)">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">Pesawat</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR </span><span class="hg-asal"></span>
                                            </div>

                                        </div>
                                    </div>
                                </label>`;
                                
                            let htmlkapal=`<input type="radio" name="transportation" onChange="selecttrans(this)" id="ship" class="radio-hidden" value="200000">
                                <label for="ship" class="transportation w-100" onClick="label(this)">
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2">Kapal</h6>
                                            <div class="fw-bold f2">
                                                <span class="clr2">IDR </span><span class="">200.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>`;
                                $('#transport').append(html);
                                $('#transportkapal').append(htmlkapal);

                        }

                        if ($status == "transit" || $status == "Transit") {

                            // ----------------------------------------
                            let accordetail=`<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="">
        Detail Penerbangan
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body text-dark">
        <ul class="timeline text-dark">
            <li>
                <h6 class="nm-asal"></h6>
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
  </div>`
                            $('#accordionFlushExample').append(accordetail);
                            // ----------------------------------------
                            let accorhotel=`<div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="">
                            Hotel di Makassar
                            </button>
                            </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-dark">
                                        <div class="row row-cols-3 row-cols-md-4">
                            <?php 
                            $limit = 8;
                            $i=1;
                            foreach($hotel_transit as $row ):
                                //  var_dump($row['standard']);
                                
                                // if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="radio" name="hoteltransit" id="hotel<?= $i ?>" class="radio-hidden" >
                                <label for="hotel<?= $i ?>" class="hoteltransit" onClick="hoteltransit(this)">
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
                                                <select name="" id="kelas<?= $i ?>"
                                                    class="kelas form-control form-control-sm">
                                                    <?php
                                                $standar = $row['standar'];
                                                $deluxe = $row['deluxe'];
                                                $superior = $row['superior'];
                                                $harga_aktif = '';
                                                
                                                if($row['standar']>0){
                                                    $harga_aktif = $standar;
                                                    echo "<option value='$standar'>Standard - $standar</option>";
                                                }
                                                
                                                if($row['deluxe']>0){
                                                    if(!$harga_aktif) $harga_aktif = $deluxe;
                                                    
                                                    echo "<option value=".$row['deluxe'].">Deluxe - ".$row['deluxe']."</option>";
                                                }

                                                if($row['superior']>0){
                                                    if(!$harga_aktif) $harga_aktif = $superior;
                                                    
                                                    echo "<option value=".$row['superior'].">Superior - ".$row['superior']."</option>";
                                                }
                                                 ?>
                                                </select>
                                                
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
                                    </div>
                                </div>
                        </div>`
                        $('#accordionFlushExample').append(accorhotel);
                        //------------------------
                        }else if($status == 'langsung' || $status =='Langsung'){
                            let accorkapal=`<div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed uper" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="">
                            Bus & Travel
                            </button>
                            </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-dark">
                                        <div class="row row-cols-3 row-cols-md-4">
                            <?php 
                            $limit = 8;
                            $i=1;
                            foreach($bus as $row ):
                                //  var_dump($row['standard']);
                                
                                // if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="radio" name="bus" id="bus<?= $i ?>" class="radio-hidden" >
                                <label for="bus<?= $i ?>" class="bus" onClick="bus(this)">
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
                                    </div>
                                </div>
                        </div>`
                        $('#accordionFlushExample').append(accorkapal);
                        }
                        }
                    </script>
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Transportasi</h5>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4" data-aos="fade-up">
                            <div id="transport" class="col mb-4">

                            </div>
                            <div id="transportkapal" class="col mb-4">
                                
                            </div>
                        </div>
                        <!--accordion-->
                    <div class="accordion accordion-flush" id="accordionFlushExample" name="accordion_transport">
                        
                    </div>
                            <!--accordion-->
                    </section>

                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Hotel</h5>
                        <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            $limit = 8;
                            $i=1;
                            foreach($hotel as $row ):
                                //  var_dump($row['standard']);
                                
                                // if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="radio" name="hotel" id="plane<?= $i ?>" class="radio-hidden">
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
                                                <select name="" id="kelas<?= $i ?>"
                                                    class="kelas form-control form-control-sm">
                                                    <?php
                                                $standar = $row['standard'];
                                                $deluxe = $row['deluxe'];
                                                $superior = $row['superior'];
                                                $harga_aktif = '';
                                                
                                                if($row['standard']>0){
                                                    $harga_aktif = $standar;
                                                    echo "<option value='$standar'>Standard - $standar</option>";
                                                }
                                                
                                                if($row['deluxe']>0){
                                                    if(!$harga_aktif) $harga_aktif = $deluxe;
                                                    
                                                    echo "<option value=".$row['deluxe'].">Deluxe - ".$row['deluxe']."</option>";
                                                }

                                                if($row['superior']>0){
                                                    if(!$harga_aktif) $harga_aktif = $superior;
                                                    
                                                    echo "<option value=".$row['superior'].">Superior - ".$row['superior']."</option>";
                                                }
                                                 ?>
                                                </select>
                                                <div class="fw-bold f2 mt-1">
                                                    <span class="clr2">IDR </span><span
                                                        class="price"><?= $harga_aktif; ?></span>
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
                    </section>

                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Restaurant</h5>
                        <div class="row row-cols-2 row-cols-md-4" data-aos="fade-up">
                            <?php 
                            foreach ($resto as $i => $row) :
                                if($i >= $limit) break;
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="restaurant" id="resto<?= $i ?>" class="radio-hidden"
                                    value="<?= $row['harga_max'] ?>" data-hgmin="<?= $row['harga_min'] ?>">
                                <label for="resto<?= $i ?>" class="resto">
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
                            <script>
                                function select(s_nama) {
                                $.ajax({
                                    url:"ajax/modal.php?nama="+s_nama,
                                    type :"GET",
                                    success: function(response){
                                        var data = JSON.parse(response);
                                        $('#namwis').html(data.nama_wisata);
                                        $('#detaildesc').html(data.deskripsi);
                                        document.getElementById("maplink").target = "_self";
                                        document.getElementById("maplink").href = "";
                                        if (data.map === "") {
                                            document.getElementById("maplink").href = "javascript:void(0)";
                                        }else{
                                            document.getElementById("maplink").target = "_blank";
                                            document.getElementById("maplink").href = data.map;
                                        }
                                        
                                        $('#gambardetail').html('');
                                        let gambar =`<div class="carousel-item active">
                                    <img src="admin/images/${data.gambar}" class="d-block w-100" alt="...">
                                    </div>`;
                                        $('#gambardetail').append(gambar);
                                        if (data.othergambar.length > 0) {

                                            for (var i = 0;i < data.othergambar.length; i++) {
                                               let gambar = `<div class="carousel-item">
                                    <img src="admin/other/${data.othergambar[i]}" class="d-block w-100" alt="...">
                                    </div>`;
                                            $('#gambardetail').append(gambar);
                                            }
                                        }

                                    $('#detailtag').html('');
                                    let tag = `${data.kategori}`;
                                    $('#detailtag').append(tag);
                                    if (data.otherkategori.length > 0) {
                                        for (var i=0; i < data.otherkategori.length; i++) {
                                          let tag = `, ${data.otherkategori[i]}`;
                                          $('#detailtag').append(tag);
                                        }
                                    }


                                    }
                                })
                                }
                                
                            </script>
                            <?php
                            $selected_id = 0;
                            foreach ($wisata as $i => $row) :
                                
                                $nama_wisata = $row['nama_wisata'];
                                if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="wisata" id="wisata<?= $i ?>" class="radio-hidden"
                                    value=<?= $row['harga'] ?>>
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
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#detailwisata" onclick="select('<?php echo $row['nama_wisata']; ?>')">
                                        detail
                                    </button>             
                                </div>

                            </div>
                            
                            <?php
                            
                          endforeach;
                        ?>

                            <div class="col-12 w-100 d-flex justify-content-center">
                                <button class="btn text-light" style="background-color: #2563eb;"
                                    data-mdb-toggle="modal" data-mdb-target="#wisataModal">lihat
                                    lainnya</button>
                            </div>
                        </div>

                    </section>
                    
                    <section class="selection pt-3">
                        <span class="bullet"></span>
                        <h5 class="mb-4">Rental</h5>
                        <div class="row row-cols-3 row-cols-md-4" data-aos="fade-up">

                            <?php
                            foreach ($rental as $i => $row) :
                                if($i >= $limit) break; 
                        ?>
                            <div class="col mb-4">
                                <input type="checkbox" name="rental" id="rental<?= $i ?>" class="radio-hidden" 
                                    value=<?= $row['harga'] ?>>
                                <label for="rental<?= $i ?>" class="rental" >
                                    <div class="rounded-5 shadow-2-strong box w-100">
                                        <div class="gambar-container rounded-5" style="width: 100%!important;">
                                            <img src="admin/images/<?= $row['gambar'] ?>" alt="" class=""
                                                width="100%" loading="lazy">
                                        </div>
                                        <div class="px-3 py-3 bg-secondry d-flex flex-column justify-content-center">
                                            <h6 class="fw-bold f2"><?= $row['nama'] ?></h6>
                                            <span class="f1 abu"><?= $row['alamat'] ?></span>
                                            <span class="f1">telp : <?= $row['telepon'] ?></span>
                                            <span class="f2">Jumlah Kendaraan :</span>
                                            <input type="number" class="jrental" min="0" datanama="<?php echo $row['nama'] ?>" dataharga="<?php echo $row['harga'] ?>" value="0" style="height: 30px; width:90%; border-width: 1px;" >
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

                </div>
                <div class="summary-container col-lg-3">
                    <div class="summary container-fluid shadow-2-strong rounded-4 bg-primary py-3 text-light">
                        <h6 class="fw-bold pb-3">Ringkasan</h6>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Transportasi :</div>
                            <div class="row">
                                <div id="nm-trans" class="col text-start"></div>
                                <div id="hg-trans" class="col text-end"></div>
                            </div>
                            <div class="row">
                                <div id="nm-transk" class="col text-start"></div>
                                <div id="hg-transk" class="col text-end"></div>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Penginapan :</div>
                            <div class="row">
                                <div id="nm-hotel" class="col text-start"></div>
                                <div id="hg-hotel" class="col text-end"></div>
                            </div>
                            <div class="row">
                                <div id="nm-hotelt" class="col text-start"></div>
                                <div id="hg-hotelt" class="col text-end"></div>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Rumah Makan :</div>
                            <div class="row">
                                <div id="nm-resto" class="col-8 text-start"></div>
                                <div id="hg-resto" class="col-4 text-end"></div>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Wisata :</div>
                            <div class="row">
                                <div id="nm-wisata" class="col-8 text-start"></div>
                                <div id="hg-wisata" class="col text-end"></div>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Rental :</div>
                            <div class="row">
                                <div id="nm-rental" class="col-8 text-start"></div>
                                <div id="hg-rental" class="col text-end"></div>
                            </div>
                        </div>
                        <div class="mt-2 f2 pb-2 border-bottom">
                            <div class="fw-bold">Total :</div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="nm-total" class="col text-start"><span id="jmOrang">1</span> Orang</div>
                                </div>
                                <div class="col-12">
                                    <div id="hr-total" class="col text-start"><span id="jmHari">1</span> Hari</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-4">
                                    <div id="" class="text-start">Minimal</div>
                                    </div>
                                    <div class="col-8">
                                    <div id="hgMin" class="text-end">Rp. 0</div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                    <div id="" class="text-start">Maksimal</div>
                                    </div>
                                    <div class="col-8">
                                    <div id="hg-total" class="text-end">Rp. 0</div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="mt-4 w-100">
                            <button id="tmbl" class="btn btn-light w-100">hitung</button>
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
                                    <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#detailwisata" onclick="select('<?php echo $row['nama_wisata']; ?>')">
                                        detail
                                    </button>             
                                </div>                                   
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
    <!-- -->    
                    <div class="modal fade" id="detailwisata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="namwis" class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <h6 id="detailtag" class="f1 abu"></h6>
                                </div>
                            <!-- -->
                            <div id="detailimage" class="carousel slide" data-mdb-ride="false">
                                <div id="gambardetail" class="carousel-inner">
                                    
                                </div>
                                <button class="carousel-control-prev" type="button" data-mdb-target="#detailimage" data-mdb-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-mdb-target="#detailimage" data-mdb-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                </div>
                            <!-- -->
                            <div class="mt-3" style="text-align: justify;">
                                <h5 id="detaildesc" class="f2 fw-bold"></h5>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                <a id="maplink" type="button" href="" class="btn btn-primary">Lihat Map</a>
                            </div>
                            </div>
                        </div>
                    </div>
                                            
                    <!-- -->
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