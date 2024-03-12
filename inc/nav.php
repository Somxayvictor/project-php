

<style>
 a:hover {
  background-color:blue;
  color: while;
}
</style>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item" >
            <a style="font-family: phetsarat OT; " class="nav-link <?php echo($nav=='home' ? 'active' : '');?>" aria-current="page" href="index.php" >ຫນ້າຫຼັກ</a>
          </li>
          <li>
          <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='sell' ? 'active' : '');?>" aria-current="page" href="about.php">ກ່ຽວກັບ</a>
          </li>
          <li>
          <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='sell' ? 'active' : '');?>" aria-current="page" href="sell.php">ຫນ້າການຂາຍ</a>
          </li>
          <li>
          <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='bill' ? 'active' : '');?>" aria-current="page" href="bill-list.php">ຫນ້າບີນ</a>
          </li>
          <li class="nav-item">
            <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='user' ? 'active' : '');?>" href="user-list.php">ແອດມີນ</a>
          </li>
          <?php
          if($LOGON_USER_ROLE =='admin'){
          ?>
          <li class="nav-item">
            <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='unit' ? 'active' : '');?>" href="unit-list.php">ຈຳນວນ</a>
          </li>
          <li class="nav-item">
            <a style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='category' ? 'active' : '');?>" href="category-list.php">ປະເພດ/ໝວດ</a>
          </li>
          <li class="nav-item">
            <a  style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='product' ? 'active' : '');?>" href="product-list.php">ສີນຄ້າ</a>
          </li>
          <?php
          }
          ?>
          <li class="nav-item dropdown">
          <a style="font-family: phetsarat OT;" class="nav-link <?php echo($nav=='report' ? 'active' : '');?> dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ລາຍງານ
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a  style="font-family: phetsarat OT;" class="dropdown-item <?php echo($nav=='report-by-bill' ? 'active' : '');?>" href="report-by-bill.php">ໜ້າລາຍງານໃບບີນ</a></li>
            <li><a  style="font-family: phetsarat OT;" class="dropdown-item <?php echo($nav=='report-by-product-no' ? 'active' : '');?>" href="report-by-product-no.php">ໜ້າລາຍງານລະຫັດໃບບີນ</a></li>
          </ul>
        </li>
        </ul>
        <form class="d-flex">
        <a href="profile.php" class="btn btn-primary"><i class="fa fa-user-circle"></i></a>
        &nbsp;
          <button type="button" class="btn btn-danger btn-logout">
            <i class="fa fa-power-off"></i>
</button>
        </form>
      </div>
    </div>
  </nav>