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
    <?php
    include('inc/header.php');
    ?>
  </head>
  
  <body class="d-flex flex-column h-100" style="background-image:url('webbg2.jpeg');">
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
                  <h1 class="mt-5" style="font-family: phetsarat OT,red" >Welcome to Stock-Shop</h1>
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
