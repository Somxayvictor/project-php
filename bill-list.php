<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    $items = $conn->query("SELECT * FROM tblorder ORDER BY created_at DESC");
    $nav = 'bill';
    $subnav = 'bill-list';
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Bill List</title>
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
    <main class="flex-shrink-0" id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br><br><br><br>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="text-align: center;">
                                <tr style="font-family: phetsarat OT;" >
                                    <th>ລຳດັບ</th>
                                    <th>ລະຫັດໃບບີນ</th>
                                    <th>ລາຄາທັງໝົດ</th>
                                    <th>ວັນທີ</th>
                                    <th>ແກ້ໄຂ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    while($row = $items->fetch_assoc()){
                                ?>
                                <tr id="item-<?php echo($row['bill_no']);?>">
                                    <td><?php echo($i);?></td>
                                    <td>
                                        <button class="btn btn-primary" 
                                        v-on:click="bill('<?php echo($row['bill_no']);?>')">
                                        <?php echo($row['bill_no']);?></button>
                                    </td>
                                    <td align="right"><?php echo(number_format($row['total_amount']));?></td>
                                    <td><?php echo(date('d-m-Y H:i:s',strtotime($row['created_at'])));?></td>
                                    <td align="center">
                                        <button class="btn btn-danger" v-on:click="remove('<?php echo($row['bill_no']);?>')"><i class="fa fa-trash"></i></button>
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
        <!-- Bill Modal -->
        <div class="modal fade" id="billModal" tabindex="-1" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ bill_no }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" 
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" id="print-bill">
                                <table width="100%">
                                    <tr>
                                        <td width="33%">
                                            <img src="./uploads/logo/logo.png" alt="" width="80">
                                            <div><strong>Stock Learning</strong></div>
                                        </td>
                                        <td width="34%" align="center">Bill</td>
                                        <td width="33%" align="right">
                                            Bill No: {{ bill_no }} <br>
                                            Date: {{ billItem.created_at }}
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-sm" id="print-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in billItems">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ item.product_name }}/{{ item.unit_name }}</td>
                                            <td align="center">{{ item.qty }}</td>
                                            <td align="right">{{ item.price }}</td>
                                            <td align="right">{{ item.total_price }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right"><strong>Total Amount</strong></td>
                                            <td align="right"><strong>{{ billItem.total_amount }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="print"><i class="fas fa-print"></i></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
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
        new Vue({
            el:'#app',
            data:{
                bill_no:'',
                billItem:[],
                billItems:[],
            },
            methods:{
                remove:function(bill_no){
                    Swal.fire({
                    title: 'Are you sure?',
                    text:'You want to delete?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if(result.isConfirmed){
                            $.ajax({
                                type:'post',
                                url:'./action/bill-action.php',
                                data:{'bill_no':bill_no,'todo':'delete-bill'},
                                success:function(data){
                                    if(data.success){
                                        $('#item-'+bill_no).hide(2000);
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
                },
                bill:function(bill_no){
                    this.bill_no = bill_no;
                    axios.get('./action/bill-action.php?todo=bill-data&bill_no='+bill_no)
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.billItem = data.item;
                            this.billItems = data.items;
                            $('#billModal').modal('show');
                        }
                    })
                },
                print:function(){
                    var data=document.getElementById('print-bill').innerHTML;
                    var myWindow = window.open('', 'ພີມໃບບິນ', '');
                    //var myWindow = window.open('', 'my div', 'height=700,width=800');
                    myWindow.document.write('<html><head><title>ພີມໃບບິນ</title>');
                    var htmlToPrint = '' + '<style type="text/css">@font-face {font-family: "Phetsarath OT"; src: url("./uploads/fonts/Phetsarath OT.ttf");}table {font-family: "Phetsarath OT"; margin-top:7px;' +'}' + '#print-table {border-collapse: collapse;width: 100%;}#print-table td, #print-table th {border: 1px solid #000000;padding-left: 3px;padding-right: 3px;}</style>';
                    myWindow.document.write('</head><body >');
                    myWindow.document.write(data);
                    myWindow.document.write('</body></html>');
                    myWindow.document.write(htmlToPrint);
                    myWindow.document.close(); // necessary for IE >= 10

                    myWindow.onload=function()
                    { // necessary if the div contain images
                        myWindow.focus(); // necessary for IE >= 10
                        myWindow.print();
                        myWindow.close();
                    };
                }
            }
        })
    </script>
  </body>
</html>
