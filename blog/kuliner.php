<?php 
  require('connect.php');
  $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 3;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;
  $result = $db->query("SELECT * FROM rumah_makan LIMIT $start, $limit");
  $customers = $result->fetch_all(MYSQLI_ASSOC);

  $result1 = $db->query("SELECT count(id) AS id FROM rumah_makan");
  $custCount = $result1->fetch_all(MYSQLI_ASSOC);
  $total = $custCount[0]['id'];
  $pages = ceil( $total / $limit );

  $Previous = $page - 1;
  $Next = $page + 1;
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Kuliner</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="blog.css">
    
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
              <li class="nav-item active">
                <a class="nav-link" href="kuliner.php">Kuliner</a>
                <span class="sr-only">(current)</span>
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
                <h2>Kuliner</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <!-- -->
                <?php
                    foreach($customers as $row) :
                      $nama = $row['nama']; ?>

                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="../admin/images/<?php echo $row['gambar'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $row['kategori'] ?></span>
                      <a href="detail-resto.php?id=<?php echo $row['id']?>"><h4><?php echo $row['nama'] ?></h4></a>
                      <!-- <ul class="post-info">
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">May 31, 2020</a></li>
                        <li><a href="#">12 Comments</a></li>
                      </ul> -->
                      <p style="height: 200px ;text-overflow: ellipsis; overflow: hidden;"><?php echo $row['deskripsi'] ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <?php
                                $sqll = "SELECT * FROM otherkategori WHERE nama='$nama'";
                                $resultt = mysqli_query($db,$sqll);
                                while ($roww = mysqli_fetch_array($resultt)) {?>
                    
                              <li><a href="searched.php?tag=<?php echo $roww['kategori']?>"><?php echo $roww['kategori'] ?></a>,</li>
                              <?php } ?>
                            </ul>
                          </div>
                          <div class="col-6">
                            <!-- <ul class="post-share">
                              <li><i class="fa fa-share-alt"></i></li>
                              <li><a href="#">Facebook</a>,</li>
                              <li><a href="#"> Twitter</a></li>
                            </ul> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- -->
              <?php endforeach; ?>
              
                <div class="col-lg-12">
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <?php
                      if ($page == 1) { ?>
                        <li class="page-item disabled"> 
                        <a class="page-link" href="kuliner.php?page=<?= $Previous; ?>" aria-label="Previous">
                          <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                      </li>
                      <?php }
                      else {?>
                        <li class="page-item"> 
                        <a class="page-link" href="kuliner.php?page=<?= $Previous; ?>" aria-label="Previous">
                          <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                      </li>
                        <?php } ?>
                      <?php for($i = 1; $i<= $pages; $i++){ ?>
                        <li class="page-item"><a class="page-link" href="kuliner.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                      <?php } ?>
                      <li class="page-item">
                        <a class="page-link" href="kuliner.php?page=<?= $Next; ?>" aria-label="Next">
                          <span aria-hidden="true">Next &raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                  
                </div>
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
          <!-- <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Behance</a></li>
              <li><a href="#">Linkedin</a></li>
              <li><a href="#">Dribbble</a></li>
            </ul>
          </div> -->
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