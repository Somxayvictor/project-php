<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>
    <style>
      .container {
        margin-top: 100px;
        background-color: lightblue ;
        border-radius: 20px;
      }
    .hehe {
      width: 100px;
      height: 33px;
      border-radius: 4px;
      text-align: center;
      color: white;
      background-color: #007AFF;
      border: solid 0px;
      margin: 50px;
     margin-top: 1px;
    padding: 4px;
    }
    .container {
      padding: 8px;
  
      height: 423px;
    }
    </style>
    <?php
    include('inc/header.php');
    ?>
  </head>
<body class="d-flex flex-column h-100" style="background-color: whitesmoke;">
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container" style="border: solid 2px black;width: 350px;">
            <div class="h-100 d-flex align-items-center justify-content-center">
              <div class="row">
              
                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mt-5">
                <img src="./uploads/logo/logo2.jpeg" alt="" width="60">
                  
                <h1 style="font-family: phetsarat OT;text-align:center;font-size:25px" class="mt-5">ລອກອີນສູ່ລະບົບ</h1>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                  <form style="font-family: phetsarat OT;" id="login-form">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">ທີ່ຢູ່ອີເມວ</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">ຄົນອື່ນຈະບໍ່ສາມາດໃຊ້ອີເມວນີ້ລອກອີນໄດ້ອີກຕໍ່ໄປ.</div>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">ລະຫັດ</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="button" class="btn btn-primary btn-submit">ລອກອີນ</button>
                   
                    <button type="button" class="hehe" onclick="alert('ອີເມວ:admin123#@gmail.com/ລະຫັດ:admin123#@')">ຂໍ້ມູນລອກອີນ</button>
                    

       
                  </form>
                </div>
              </div>
            </div>
        </div>
    </main>
    <?php
    include('inc/script.php');
    ?>
    <script>
      $(document).ready(function(){
            $('.btn-submit').on('click',function(){
                $.ajax({
                    type: "POST",
                    url: "./action/login-action.php", 
                    data: $('#login-form').serialize(),
                    success: function (data) {
                        if(data.success){
                          window.location.href = "http://localhost/stock-learning/index.php";
                        } else {
                            Swal.fire('ລອກອີນຜິດພາດ',data.message,'ລອກອີນຜິດພາດ');
                        }
                    },
                    error: function (err) {
                        Swal.fire('ລອກອີນຜິດພາດ','Something went wrong','ລອກອີນຜິດພາດ');
                    }
                });
            })
        })
      </script>
  </body>
</html>
