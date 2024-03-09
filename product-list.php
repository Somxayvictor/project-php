<?php
include('./inc/connDB.php');
include('./inc/security.php');
$items = $conn->query("SELECT tblproduct.*,tblcategory.category_name, tblunit.unit_name FROM tblproduct INNER JOIN tblcategory ON(tblcategory.id = tblproduct.category_id) INNER JOIN tblunit ON(tblunit.id = tblproduct.unit_id) ORDER By tblproduct.created_at DESC");
$nav = 'product';
$subnav = 'product-list';
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
                <div class="col-md-12 text-right">
                    <a href="product.php" class="btn btn-primary"><i class='fa fa-plus'></i></a>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead style="text-align: center;">
                                <tr style="font-family: phesarat OT;">
                                    <th>ລຳດັບ</th>
                                    <th>ຮູບ</th>
                                    <th>ລະຫັດ</th>
                                    <th>ບາໂຄດ</th>
                                    <th>ຊື່ສີນຄ້າ</th>
                                    <th>ປະເພດ</th>
                                    <th>ຈຳນວນ</th>
                                    <th>ຈຳນວນ</th>
                                    <th>ລາຄາ</th>
                                    <th>ວັນທີ</th>
                                    <th>ວັນທີ ອັບເດດ </th>
                                    <th>ແກ້ໄຂ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    while($row = $items->fetch_assoc()){
                                ?>
                                <tr id="item-<?php echo($row['id']);?>">
                                    <td><?php echo($i);?></td>
                                    <td>
                                        <img src="<?php echo($row['image']);?>"
                                        class="img-thumbnail" width="50"
                                        alt="<?php echo($row['product_name']);?>">
                                    </td>
                                    <td><?php echo($row['product_no']);?></td>
                                    <td><?php echo($row['barcode']);?></td>
                                    <td><?php echo($row['product_name']);?></td>
                                    <td><?php echo($row['category_name']);?></td>
                                    <td><?php echo($row['unit_name']);?></td>
                                    <td class="text-center"><?php echo($row['qty']);?></class=>
                                    <td><?php echo($row['price']);?></td>
                                    <td>
                                        <?php echo(date('d-m-Y H:i:s',strtotime($row['created_at'])));?>
                                    </td>
                                    <td>
                                        <?php
                                            if($row['updated_at'] !=null){
                                                echo(date('d-m-Y H:i:s',strtotime($row['updated_at'])));
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-receive"  product_no="<?php echo($row['product_no'])?>">
                                        <i class="fa fa-plus"></i></button>
                                        <a href="product.php?id=<?php echo($row['id']);?>" 
                                        class="btn btn-primary"><i class="fa fa-book"></i></a>
                                        <button type="button" class="btn btn-danger btn-delete" 
                                        baseid="<?php echo($row['id']);?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
 <!-- Modal -->
 <div class="modal fade" id="receiveModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Receive</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="product-no">
                        <input type="number" min="1" class="form-control qty">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-submit-receive">OK</button>z
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <?php
    include('inc/footer.php');
    include('inc/script.php');
    ?>
    <script>
        $(document).ready(function(){
            $('.btn-submit-receive').on('click',function(){
                $.ajax({
                    type:'post',
                    url:'./action/product-receive.php',
                    data:{'product_no':$('#product-no').val(),'qty':$('.qty').val()},
                    success:function(data){
                        if(data.success){
                            Swal.fire('Success!',data.message,'success');
                            $('#receiveModal').modal('hide');

                        } else {
                            Swal.fire('Error!','Something went wrong','error');
                        }
                    },
                    error:function(){
                        Swal.fire('Error!','Something went wrong','error');
                    }
                })
            })
            $('.btn-receive').on ('click',function(){
                var obj = $(this);
                $('#product-no').val(obj.attr('product_no'));
                $('#receiveModal').modal('show');
            })
            $('.btn-delete').on('click',function(){
                var obj = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text:'You want to delete?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            type:'post',
                            url:'./action/delete-product.php',
                            data:{'id':obj.attr('baseid')},
                            success:function(data){
                                if(data.success){
                                    $('#item-'+obj.attr('baseid')).hide(2000);
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong.',
                                        'error'
                                    )
                                }
                            },
                            error:function(){
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                )
                            }
                        });
                    }
                })
            })
        })
    </script>
  </body>
</html>
