<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    if($LOGON_USER_ROLE != 'admin'){
        header("location:index.php");
    }
    if($LOGON_USER_ROLE != 'admin'){
        header("location:index.php");
    }
    $id = 0;
    $name = "";
    $email = "";
    $role = "user";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $item = $conn->query("SELECT * FROM tbluser WHERE id = ".$id);
        while($row = $item->fetch_assoc()){
            $name = $row['name'];
            $email = $row['email'];
            $role = $row['role'];
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
                    <form id="submit-form"><!-- Form submit -->
                    <input type="hidden" name="id" value="<?php echo($id);?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="<?php echo($name);?>" id="name" placeholder="Name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email address:</label>
                            <input type="email" name="email" class="form-control" value="<?php echo($email);?>" id="email" placeholder="Email address">
                        </div>
                        <div class="form-group mt-3">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirm-pwd">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm-pwd" placeholder="Confirm Password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="admin">
                                <input type="radio" name="role" id="admin" value="admin" <?php echo($role=='admin'?'checked':'');?>> &nbsp;admin
                            </label> &nbsp;&nbsp;
                            <label for="user">
                                <input type="radio" name="role" id="user" value="user" <?php echo($role=='user'?'checked':'');?>> &nbsp;user
                            </label> &nbsp;&nbsp;
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-submit">Submit</button>
                            <a href="user-list.php" class="btn btn-danger">Cancel</a>
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
            $('.btn-submit').on('click',function(){
                $.ajax({
                    type: "POST",
                    url: "./action/user-action.php", 
                    data: $('#submit-form').serialize(),
                    success: function (data) {
                        if(data.success){
                            Swal.fire('Success',data.message,'success');
                            setTimeout(() => {
                                window.location.href="user-list.php";
                            }, 2000);
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
