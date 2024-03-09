<?php
include('./inc/connDB.php');
include('./inc/security.php');
$items = $conn->query("SELECT * FROM tbluser ORDER BY created_at DESC");
$nav = 'user';
$subnav = 'user-list';
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
                    <a href="user.php" class="btn btn-primary"><i class='fa fa-user-circle'></i></a>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead style="font-family: phesarat OT;">
                                <tr style="text-align: center;">
                                    <th>ລຳດັບ</th>
                                    <th>ຊື່</th>
                                    <th>ທີ່ຢູ່ອີເມວ</th>
                                    <th>ຕຳແຫນ່ງ</th>
                                    <th>ວັນທີ</th>
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
                                    <td><?php echo($row['name']);?></td>
                                    <td><?php echo($row['email']);?></td>
                                    <td><?php echo(ucfirst($row['role']));?> 
                                </td>
                                    <td><?php echo(date('d-m-Y H:i:s',strtotime($row['created_at'])));?></td>
                                    <td class="text-center">
                                        <?php

                                        if ($LOGON_USER_ROLE == 'admin'){
                                            ?>
    
                                       
                                        <a href="user.php?id=<?php echo($row['id']);?>" 
                                        class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger btn-delete" 
                                        baseid="<?php echo($row['id']);?>">Delete</button>
                                        <?php
                                        }
                                        ?>
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
    <?php
    include('inc/footer.php');
    include('inc/script.php');
    ?>
    <script>
        $(document).ready(function(){
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
                            url:'./action/delete-user.php',
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
