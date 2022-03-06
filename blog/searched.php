<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Search</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Visit Selayar<em></em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="../index.php">Home
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="destinasi.php">Destinasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="akomodasi.php">Akomodasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="kuliner.php">Kuliner</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../rencana.php">Rencanakan Wisata</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Recent Posts</h4>
                <h2>Destinasi</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <?php
                require('connect.php');
                if (isset($_POST['submit_search'])) {
                  $search = mysqli_real_escape_string($db, $_POST['search_input']);
                  $sql = "SELECT * FROM wisata WHERE nama_wisata LIKE '%$search%' OR deskripsi  LIKE '%$search%' OR kategori  LIKE '%$search%'";
                  $result = mysqli_query($db,$sql);
                  $query = mysqli_num_rows($result);

                  $sqll = "SELECT * FROM hotel WHERE nama_hotel LIKE '%$search%' OR deskripsi  LIKE '%$search%' OR kategori  LIKE '%$search%'";
                  $results = mysqli_query($db,$sqll);
                  $query_hotel = mysqli_num_rows($results);
                  $sqlll = "SELECT * FROM rumah_makan WHERE nama LIKE '%$search%' OR kategori  LIKE '%$search%'";
                  $resulttt = mysqli_query($db,$sqlll);
                  $query_resto = mysqli_num_rows($resulttt);
                  $q_wisata = 0;
                  $q_hotel = 0;
                  $q_resto = 0;
                } else {
                  $search = mysqli_real_escape_string($db, $_GET['tag']);
                  $sql = "SELECT * FROM wisata WHERE kategori = '$search'";
                  $result = mysqli_query($db,$sql);
                  $query = mysqli_num_rows($result);

                  $sqll = "SELECT * FROM hotel WHERE kategori = '$search'";
                  $results = mysqli_query($db,$sqll);
                  $query_hotel = mysqli_num_rows($results);

                  $sqlll = "SELECT * FROM rumah_makan WHERE kategori = '$search'";
                  $resulttt = mysqli_query($db,$sqlll);
                  $query_resto = mysqli_num_rows($resulttt);
                  // $query = 0;
                  // $query_hotel = 0;
                  // $query_resto = 0;

                  $sq_wisata = "SELECT wisata.id, wisata.nama_wisata, wisata.gambar, wisata.deskripsi, wisata.kategori
                            FROM wisata
                            INNER JOIN otherkategori
                            ON wisata.nama_wisata=otherkategori.nama
                            WHERE otherkategori.kategori='$search'";
                  $result_wisata = mysqli_query($db,$sq_wisata);
                  $q_wisata = mysqli_num_rows($result_wisata);

                  $sq_hotel = "SELECT hotel.id, hotel.nama_hotel, hotel.gambar, hotel.deskripsi, hotel.kategori
                            FROM hotel
                            INNER JOIN otherkategori
                            ON hotel.nama_hotel=otherkategori.nama
                            WHERE otherkategori.kategori='$search'";
                  $result_hotel = mysqli_query($db,$sq_hotel);
                  $q_hotel = mysqli_num_rows($result_hotel);

                  $sq_resto = "SELECT rumah_makan.id, rumah_makan.nama, rumah_makan.gambar, rumah_makan.deskripsi, rumah_makan.kategori
                            FROM rumah_makan
                            INNER JOIN otherkategori
                            ON rumah_makan.nama=otherkategori.nama
                            WHERE otherkategori.kategori='$search'";
                  $result_resto = mysqli_query($db,$sq_resto);
                  $q_resto = mysqli_num_rows($result_resto);
                }
              ?>
              <span>Result For "<?php echo $search ?>"</span>
              <hr>
              <div class="row">
                <?php 
                  if ($query == 0 && $query_hotel == 0 && $query_resto == 0 && $q_wisata == 0 && $q_hotel == 0 && $q_resto == 0) {
                    echo "Tidak Menemukan Hasil";
                  }
                  if ($q_wisata > 0 ) {
                    while($row = mysqli_fetch_assoc($result_wisata)){ 
                      $nama = $row['nama_wisata'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-wisata.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama_wisata'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                  if ($q_hotel > 0 ) {
                    while($row = mysqli_fetch_assoc($result_hotel)){ 
                      $nama = $row['nama_hotel'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-hotel.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama_hotel'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                  if ($q_resto > 0 ) {
                    while($row = mysqli_fetch_assoc($result_resto)){ 
                      $nama = $row['nama'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-resto.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                  
                  if ($query > 0 ) {
                    while($row = mysqli_fetch_assoc($result)){ 
                      $nama = $row['nama_wisata'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-wisata.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama_wisata'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                  if ($query_hotel > 0 ) {
                    while($row = mysqli_fetch_assoc($results)){ 
                      $nama = $row['nama_hotel'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-hotel.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama_hotel'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                  if ($query_resto > 0 ) {
                    while($row = mysqli_fetch_assoc($resulttt)){ 
                      $nama = $row['nama'];?>
                      <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-resto.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama'] ?></h4></a>
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                               <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                              <li>,<a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a></li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                    <?php }
                  }
                 ?>

                

              
              </div>
            </div>
          </div>
                    <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form method="POST" action="searched.php">
                      <input type="text" name="search_input" class="searchText" placeholder="type to search..." autocomplete="on">
                      <button type="submit" name="submit_search" style="display: none;"></button>
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2>Check Others</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php
                        
                        $sql = "SELECT * FROM wisata ORDER BY RAND() LIMIT 1";
                        $result = mysqli_query($db,$sql);
                        while ($row = mysqli_fetch_array($result)) { ?>
                        <li><a href="detail-wisata.php?id=<?php echo $row['id']?>">
                          <table>
                            <tr>
                              <td rowspan="2">
                          <img src="../admin/images/<?php echo $row['gambar'] ?>" style="width: 100px; height: 100px" ></td><td>
                          <h5 style="margin-left: 20px; margin-top: 30px;"><?php echo $row['nama_wisata'] ?></h5></td></tr>
                          <tr> <td >
                          <span style="margin-left: 20px; margin-bottom: 30px;"><?php echo $row['kategori'] ?></span></td></tr>
                          
                          </table>
                        </a></li> <?php }
                        $sql = "SELECT * FROM hotel ORDER BY RAND() LIMIT 1";
                        $result = mysqli_query($db,$sql);
                        while ($row = mysqli_fetch_array($result)) {?>
                        <li><a href="detail-hotel.php?id=<?php echo $row['id']?>">
                          <table>
                            <tr>
                              <td rowspan="2">
                          <img src="../admin/images/<?php echo $row['gambar'] ?>" style="width: 100px; height: 100px" ></td><td>
                          <h5 style="margin-left: 20px; margin-top: 30px;"><?php echo $row['nama_hotel'] ?></h5></td></tr>
                          <tr> <td >
                          <span style="margin-left: 20px; margin-bottom: 30px;"><?php echo $row['kategori'] ?></span></td></tr>
                          
                          </table>
                        </a></li>
                        <?php }
                        $sql = "SELECT * FROM rumah_makan ORDER BY RAND() LIMIT 1";
                        $result = mysqli_query($db,$sql);
                        while ($row = mysqli_fetch_array($result)) {?>
                        <li><a href="detail-resto.php?id=<?php echo $row['id']?>">
                          <table>
                            <tr>
                              <td rowspan="2">
                          <img src="../admin/images/<?php echo $row['gambar'] ?>" style="width: 100px; height: 100px" ></td><td>
                          <h5 style="margin-left: 20px; margin-top: 30px;"><?php echo $row['nama'] ?></h5></td></tr>
                          <tr> <td >
                          <span style="margin-left: 20px; margin-bottom: 30px;"><?php echo $row['kategori'] ?></span></td></tr>
                          
                          </table>
                        </a></li>
                      <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Tag</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php
                        $sql = "SELECT * FROM kategori ORDER BY RAND() LIMIT 10";
                        $result = mysqli_query($db,$sql);
                        while ($row = mysqli_fetch_array($result)) {?>
                        <li><a href="searched.php?tag=<?php echo $row['kategori']?>"><?php echo $row['kategori'] ?></a></li>
                      <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>Copyright 2020</p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>