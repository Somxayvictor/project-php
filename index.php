<?php
include('./inc/connDB.php');
include('./inc/security.php');
$nav = 'home';
$subnav = 'home';
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Home</title>
    <style>

 .hehe {
  width: 40%;
height: 300px;
  }
  img {
    border-radius: 50px;
  }
  .d {
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
  }
button {
  padding: 20px;
  width: 140%;
  border-radius: 10px green;
  background-color: whitesmoke;
}
.a {
  border-radius: 20px;
font-size: 23px;
}
.b {
  border-radius: 20px;
  font-size: 23px;
}
.c {
  border-radius: 20px;
 padding-top: 30px;
 font-size: 23px;
}
h1 {
  font-size: 5lh;
  margin: 40px;
}
.a:hover {
  color: white;
  background-color: blue;
}
.b:hover {
  color: white;
  background-color: blue;
}
.c:hover {
  color: white;
  background-color: blue;
}
    </style>
    <?php
    include('inc/header.php');
    ?>
  </head>
  
  <body class="d" style="background-image:url('sale-bk.jpeg');">
<header>
  <!-- Fixed navbar -->
  <?php
    include('inc/nav.php');
    ?>
</header >
    <!-- Begin page content -->

    <main  class="flex-shrink-0">
        <div class="container">
            <div class="h-100 d-flex align-items-center justify-content-center">
              <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mt-5">
                <h1 class="mt-5" style="font-family: phetsarat OT; color: whitesmoke;">ລະບົບຂາຍເຄື່ອງ</h1><br><br><br>
                </div>
              <div style="font-family: phetsarat OT;">
                <a href="about.php"><button class="a">ກ່ຽວກັບ</button><br><br></a>
                <a href="sell.php"><button class="b">ຈັດການການຂາຍ</button><br><br></a>
                <a href="product-list.php"><button class="c">ຈັດການສີນຄ້າ</button></a>
              </div>
              </div>
              
            </div>
        </div>
    </main>
    <?php
    include('inc/script.php');
    ?>
  </body>
</html>
