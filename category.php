<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    $id = 0;
    $id = 0;
    $category_name = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $item = $conn->query("SELECT * FROM tblcategory WHERE id = ".$id);
        while($row = $item->fetch_assoc()){
            $category_name = $row['category_name'];
        }
    }
    $nav = 'category';
    $subnav = 'category-list';
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
                            <input type="text" name="category_name" class="form-control" id="name" placeholder="Name" value="<?php echo($category_name);?>">
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary btn-submit">Submit</button>
                            <a href="category.php" class="btn btn-danger">Cancel</a>
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
                    url: "./action/category-action.php", 
                    data: $('#submit-form').serialize(),
                    success: function (data){
                        if(data.success){
                            Swal.fire('Success',data.message,'success');
                            setTimeout(() => {
                                window.location.href="category-list.php";
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
