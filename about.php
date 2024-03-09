
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
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>
<header>
  <!-- Fixed navbar -->
  <?php
    include('inc/nav.php');
    ?>
</header>
<div class="column">
  <div class="column">
  <img src="./uploads/logo/somxay.jpeg" alt="" width="100%">
    <p >ທ້າວ ສົມໄຊ ເຮີ</p>
  </div>
  <div class="column">
  <img src="./uploads/logo/liew.jpeg" alt="" width="100%">
        <p >ທ້າວ ຫລີວດາວັນ</p>
  </div>
  <div class="column">
  <img src="./uploads/logo/lambo.jpeg" alt="" width="100%">
        <p >ທ້າວ ແລມໂບ້</p>
  </div>
</div>

</body>
</html>
