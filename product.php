<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    $id = 0;
    $product_no = "";
    $barcode = "";
    $product_name = "";
    $category_id = "";
    $unit_id = "";
    $price = "";
    $image_exist = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $item = $conn->query("SELECT * FROM tblproduct WHERE id = ".$id);
        while($row = $item->fetch_assoc()){
            $product_no = $row['product_no'];
            $barcode = $row['barcode'];
            $product_name = $row['product_name'];
            $category_id = $row['category_id'];
            $unit_id = $row['unit_id'];
            $price = $row['price'];
            $image_exist = $row['image'];
        }
        if($price != ""){
            $price = number_format($price);
        }
    }
    $categoryItems = $conn->query("SELECT * FROM tblcategory ORDER BY category_name");
    $unitItems = $conn->query("SELECT * FROM tblunit ORDER BY unit_name");
    $nav = 'product';
    $subnav = 'product';
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Product</title>
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
                            <label for="product-no">Product No:</label>
                            <input type="text" name="product_no" value="<?php echo($product_no);?>" 
                            class="form-control" id="product-no" placeholder="Product No" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="barcode">Barcode:</label>
                            <input type="text" name="barcode" value="<?php echo($barcode);?>" 
                            class="form-control" id="barcode" placeholder="Barcode">
                        </div>
                        <div class="form-group mt-3">
                            <label for="product-name">Product Name:</label>
                            <input type="text" name="product_name" class="form-control" 
                            id="product-name" placeholder="Product Name" value="<?php echo($product_name);?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="category">Category:</label>
                            <select name="category_id" class="form-control" id="category">
                                <option value="">-- Select Category --</option>
                                <?php
                                    while($categoryRow = $categoryItems->fetch_assoc()){
                                ?>
                                <option value="<?php echo($categoryRow['id']);?>" <?php echo($category_id==$categoryRow['id'] ? 'selected' : '');?>>
                                    <?php echo($categoryRow['category_name']);?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="unit">Unit:</label>
                            <select name="unit_id" class="form-control">
                                <option value="">-- Select Unit --</option>
                                <?php
                                    while($unitRow = $unitItems->fetch_assoc()){
                                ?>
                                <option value="<?php echo($unitRow['id']);?>" <?php echo($category_id==$unitRow['id'] ? 'selected' : '');?>>
                                    <?php echo($unitRow['unit_name']);?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image">Image:</label>
                            <?php
                                if($image_exist != ''){
                                    echo("<img src='".$image_exist."' width='50'>");
                                }
                            ?>
                            <input type="file" name="image" class="form-control" id="image" placeholder="Image">
                            <input type="hidden" name="image_exist" value="<?php echo($image_exist);?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" 
                            id="price" placeholder="Price" value="<?php echo($price);?>">
                        </div>
                        <div class="form-group mt-5">
                            <button type="button" class="btn btn-primary btn-submit">Submit</button>
                            <a href="product-list.php" class="btn btn-danger">Cancel</a>
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
                var formData = new FormData($('#submit-form')[0]);
                $.ajax({
                    type: "POST",
                    url: "./action/product-action.php", 
                    data : formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,
                    success: function (data) {
                        if(data.success){
                            Swal.fire('Success',data.message,'success');
                            setTimeout(() => {
                                window.location.href="product-list.php";
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
