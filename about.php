
<?php
include('./inc/connDB.php');
include('./inc/security.php');
$nav = 'about';
$subnav = 'about';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>about</title>
    <?php
    include('inc/header.php');
    ?>
<style>
  .haha {
  margin: 60px;
  }
  p {
    font-family: phetsarat OT;
    padding: 130px;
    padding-top: 20px;
  }
img {
  border: 2px solid black;
  border-radius: 40%;
  margin-left: 120px;
}
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 16px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body style="background-color: grey;">
<header>
  <!-- Fixed navbar -->
  <?php
    include('inc/nav.php');
    ?>
</header>
<main  class="flex-shrink-0">
  <div style="font-family: phetsarat OT;" class="haha">
  <h2>ລະບົບຂາຍ</h2>
  <h4 >ສະມາຊິກໃນກູ່ມ:</h4>
  </div>
<div class="row">
<div class="column"><img src="./uploads/logo/somxay.jpeg" alt="" width="200px"> <br> 
<p>ທ້າວ ສົມໄຊ ເຮີ ຫ້ອງ2cw3</p>
</div>
<div class="column"><img src="./uploads/logo/liew.jpeg" alt="" width="200px"> <br> 
<p>ທ້າວ ຫລີວດາວັນ ຫ້ອງ2cw3</p>
</div>
<div class="column"><img src="./uploads/logo/lambo.jpeg" alt="" width="200px"><br>
<p>ທ້າວ ແລມໂບ້ ຫ້ອງ2cw3</p> 
</div>
</div>
</main>
<!-- <main  class="flex-shrink-0">
        <div class="container">
            <div class="h-100 d-flex align-items-center justify-content-center">
              <div class="row">
                <div style="font-family: phetsarat OT;" class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mt-5">
                <h1 class="mt-5" style="font-family: phetsarat OT; color: black;">ລະບົບຂາຍ</h1>
                <p  style="font-size: 25px;">ສະມາຊິກໃນກູ່ມ:</p>
                </div>
              </div>
            </div>
        </div>
    </main> -->
<?php
    include('inc/script.php');
    ?>
</body>
</html>
