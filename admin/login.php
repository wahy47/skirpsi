<?php
  require('connect.php');

  session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM idusers WHERE username='$username' AND password='$password'";
        $resulta = mysqli_query($db,$sql);
        $datao = $resulta -> fetch_assoc();


    if (!empty($datao)) {
        $_SESSION['username'] = $datao['username'];
        header("Location: index.php");
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Admin</title>
  </head>
  <body>
    <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>
            <form method="post" action="login.php">
            <div class="form-outline mb-4">
              <input type="text" id="username" name="username" class="form-control form-control-lg" />
              <label class="form-label" for="username">Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control form-control-lg" />
              <label class="form-label" for="password">Password</label>
            </div>


            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>