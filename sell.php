<?php
    include('./inc/connDB.php');
    include('./inc/security.php');
    $nav = 'sell';
    $subnav = 'sell';
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Sell</title>
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
                <div class="col-md-7">
                    <div class="form-group mb-3" >
                        <input style="background-color: whitesmoke;font-family:phetsarat OT" type="text" class="form-control" placeholder="ໃສ່ລະຫັດສີນຄ້າຫຼືບາໂຄດຂອງສີນຄ້າ" 
                        v-on:change="doFilter($event.target.value)" v-model="filter">
                    </div>
                    <div class="table-responsive">
                        <form id="submit-form">
                            <table style="background-color:whitesmoke" class="table table-bordered">
                                <thead style="text-align: center">
                                    <tr style="font-family: phetsarat OT;">
                                        <th>ລຳດັບ</th>
                                        <th>ລາຍການ</th>
                                        <th>ຈຳນວນ</th>
                                        <th>ລາຄາ</th>
                                        <th>ລາຄາທັງໝົດ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in items">
                                        <td>{{ index+1 }}</td>
                                        <td>
                                            <a href="javascript:void(0)" 
                                            v-on:click="editItem(item.barcode,item.product_name,item.qty)">
                                                {{ item.product_name }}/{{ item.unit_name }}
                                            </a>
                                            <input type="hidden" name="product_no[]" 
                                            v-bind:value="item.product_no">
                                            <input type="hidden" name="barcode[]" v-bind:value="item.barcode">
                                            <input type="hidden" name="category_id[]" 
                                            v-bind:value="item.category_id">
                                            <input type="hidden" name="unit_id[]" v-bind:value="item.unit_id">
                                            <input type="hidden" name="qty[]" v-bind:value="item.qty">
                                            <input type="hidden" name="price[]" v-bind:value="item.price">
                                            <input type="hidden" name="total_price[]" 
                                            v-bind:value="item.total_price">
                                        </td>
                                        <td align="center">{{ item.qty }}</td>
                                        <td align="right">{{ item.price }}</td>
                                        <td align="right">{{ item.total_price }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="font-family: phetsarat OT;" colspan="4" align="right"><strong>ລາຄາລວມທັງໝົດ</strong></td>
                                        <td align="right">
                                            <strong>{{ total_amount }}</strong>
                                            <input type="hidden" name="total_amount" 
                                            v-bind:value="total_amount">
                                            <input type="hidden" name="todo" value="submit-sell">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                    <div align="right">
                        <button type="button" class="btn btn-primary" 
                        v-on:click="submitSell">Sell Product</button>
                    </div>
                </div>
                <div style="background-color: whitesmoke;" class="col-md-5">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead style="text-align: center;">
                                <tr style="font-family: phetsarat OT;">
                                    <th>ລຳດັບ</th>
                                    <th>ລະຫັດໃບບີນ</th>
                                    <th>ວັນທີ</th>
                                    <th>ລາຄາທັງໝົດ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in bills">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <button class="btn btn-primary" v-on:click="bill(item.bill_no)">
                                            {{ item.bill_no }}
                                        </button>
                                    </td>
                                    <td>{{ item.created_at }}</td>
                                    <td align="right">{{ item.total_amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editItemModal" tabindex="-1" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ edit_product_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" 
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-item-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="qty">Qty</label>
                                    <input type="number" name="qty" min="1" class="form-control" 
                                    v-model="edit_qty">
                                    <input type="hidden" name="barcode" v-model="edit_barcode">
                                    <input type="hidden" name="todo" value="edit-item">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" v-on:click="saveEdit">
                            <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-danger" v-on:click="remove(edit_barcode)">
                            <i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-secondary" 
                        data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bill Modal -->
        <div  class="modal fade" id="billModal" tabindex="-1" 
        aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="background-color: lightyellow;" class="modal-content">
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
                                            <img src="./uploads/logo/logo2.jpeg" alt="" width="80">
                                            <div style="font-style:italic;"><strong>Minimark</strong></div>
                                        </td>
                                        <td width="34%" align="center">Bill</td>
                                        <td width="33%" align="right">
                                            Bill No: {{ bill_no }} <br>
                                            Date: {{ billItem.created_at }}
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-sm" id="print-table">
                                    <thead style="text-align: center;">
                                        <tr style="font-family: phetsarat OT;">
                                            <th>ລຳດັບ</th>
                                            <th>ລາຍການ</th>
                                            <th>ຈຳນວນ</th>
                                            <th>ລາຄາ</th>
                                            <th>ລາຄາລວມທັງໝົດ</th>
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
                        <button type="button" class="btn btn-primary" v-on:click="print"><i class="fa fa-print"></i></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
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
                filter:'',
                items:[],
                total_amount:0,
                edit_barcode:'',
                edit_product_name:'',
                edit_qty:0,
                bills:[],
                bill_no:'',
                billItem:[],
                billItems:[],
            },
            mounted(){
                this.fetchOrder();
                this.fetchBill();
            },
            methods:{
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
                fetchBill:function(){
                    axios.get('./action/bill-action.php?todo=sell-bill')
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.bills = data.items;
                            // console.log(data)
                        }
                    })
                },
                doFilter:function(filter){
                    this.filter = '';
                    axios.get('./action/sell-action.php?todo=filter&filter='+filter)
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.fetchOrder();
                        }
                    })
                },
                fetchOrder:function(){
                    axios.get('./action/sell-action.php?todo=order-data')
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.items = data.items;
                            this.total_amount = data.total_amount;
                        }
                    })
                },
                editItem:function(barcode,product_name,qty){
                    this.edit_barcode = barcode;
                    this.edit_product_name = product_name;
                    this.edit_qty = qty;
                    $('#editItemModal').modal('show');
                },
                saveEdit:function(){
                    axios.post('./action/sell-action.php',$('#edit-item-form').serialize())
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.fetchOrder();
                            $('#editItemModal').modal('hide');
                        }
                    })
                },
                remove:function(barcode){
                    let formData = new FormData();
                    formData.append('barcode', barcode);
                    formData.append('todo', 'delete');
                    axios.post('./action/sell-action.php',formData)
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.fetchOrder();
                            $('#editItemModal').modal('hide');
                        }
                    })
                },
                submitSell:function(){
                    axios.post('./action/sell-action.php',$('#submit-form').serialize())
                    .then(res => {
                        var data = res.data;
                        if(data.success){
                            this.fetchOrder();
                            this.fetchBill();
                        }
                    })
                },
                print: function () {
                    var data = document.getElementById('print-bill').innerHTML;
                    var myWindow = window.open('', 'ພີມໃບບິນ', '');
                    //var myWindow = window.open('', 'my div', 'height=700,width=800');
                    myWindow.document.write('<html><head><title>ພີມໃບບິນ</title>');
                    var htmlToPrint = '<style type="text/css">  @font-face {font-family: "Phetsarath OT";src: url("./../../uploads/fonts/Phetsarath-OT.ttf");}@font-face {font-family: "Phetsarath OT_Bold";src: url("./../../uploads/fonts/Phetsarath-OT_Bold.ttf");}table,.bill-footer {font-family: "Phetsarath OT"; margin-top:7px;}#print-table{width:100%}#print-table,#print-table td {border: 1px solid black; border-collapse: collapse;}.logo{display:none;}.black-logo{display:block}.shop-name,.la-bold{font-size: 25px;font-family: "Phetsarath OT_Bold";}</style>';
                    myWindow.document.write('</head><body >');
                    myWindow.document.write(data);
                    myWindow.document.write('</body></html>');
                    myWindow.document.write(htmlToPrint);
                    myWindow.document.close(); // necessary for IE >= 10
                    myWindow.onload = function () { // necessary if the div contain images
                        myWindow.focus(); // necessary for IE >= 10
                        myWindow.print();
                        myWindow.close();
                    };
                    $('#billModal').modal('hide');
                },
            }
        })
    </script>
  </body>
</html>