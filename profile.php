<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    $id = 0;
    $name = "";
    $email = "";
    if(isset($LOGON_USER_ID)){
        $id = $LOGON_USER_ID;
        $item = $conn->query("SELECT * FROM tbluser WHERE id = ".$id);
        while($row = $item->fetch_assoc()){
            $name = $row['name'];
            $email = $row['email'];
        }
    }
    $nav = 'user';
    $subnav = 'user';
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>User List</title>
    <?php
    include('inc/header.php');
    ?>
  </head>
  <body class="d-flex flex-column h-100">
<header>
  <!-- Fixed navbar -->
  <?php
    include('inc/nav.php');
    ?>
</header>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br><br><br><br>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <form   style="font-family: phetsarat OT;" id="submit-form"><!-- Form submit -->
                    <input type="hidden" name="id" value="<?php echo($id);?>">
                        <div class="form-group">
                            <label for="name">ຊື່:</label>
                            <input type="text" name="name" class="form-control" value="<?php echo($name);?>" id="name" placeholder="Name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">ທີ່ຢູ່ອີເມວ:</label>
                            <input type="email" name="email" class="form-control" value="<?php echo($email);?>" id="email" placeholder="Email address">
                        </div>
                        <div class="form-group mt-3">
                            <label for="pwd">ລະຫັດ:</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirm-pwd">ຢືນຢັນລະຫັດ:</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm-pwd" placeholder="Confirm Password">
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-submit">ອັດເດດຂໍ້ມູນ</button>
                            <button type="button" class="btn btn-info btn-show-password">
                            <i class="fa fa-eye"></i>
                            </button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('inc/footer.php');
    include('inc/script.php');
    ?>
    <script>
        $(document).ready(function(){
            $('.btn-show-password').on('click',function(){
                var obj=$(this);
                var pwd=$('#pwd');
                var confirm_pwd=$('#confirm-pwd');
                if(pwd.attr('type')=='password'){
                    pwd.attr('type','text');
                    confirm_pwd.attr('type','text');
                    obj.html('<i class="fas fa-eye-slash">');
                } else {
                    pwd.attr('type','password');
                    confirm_pwd.attr('type','password');
                    obj.html('<i class="fas fa-eye">');
                }
            })
            $('.btn-submit').on('click',function(){
                $.ajax({
                    type: "POST",
                    url: "./action/profile-action.php", 
                    data: $('#submit-form').serialize(),
                    success: function (data) {
                        if(data.success){
                            Swal.fire('Success',data.message,'success');
                        } else {
                            Swal.fire('Error',data.message,'error');
                        }
                    },
                    error: function (err) {
                        Swal.fire('Error','Something went wrong','error');
                    }
                });
            })
        })
    </script>
  </body>
</html>
