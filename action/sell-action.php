<?php
include('../inc/connDB.php');
include('../inc/security.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
    $todo = $_GET['todo'];
    if($todo == 'filter'){
        $filter = $_GET['filter'];
        $success = false;
        if(isset($_SESSION['PRODUCT'])){
            $PRODUCT = $_SESSION['PRODUCT'];
        } else {
            $PRODUCT = array();
        }
        $item = $conn->query("SELECT * FROM tblproduct WHERE product_no = '$filter' OR barcode = '$filter' LIMIT 1");
        while($row = $item->fetch_assoc()){
            $have = false;
            foreach($PRODUCT as $key => $value){
                if($key == $row['barcode']){
                    $have = true;
                    break;
                }
            }
            if($have){
                $PRODUCT[$row['barcode']] = $PRODUCT[$row['barcode']]+1;
            } else {
                $PRODUCT[$row['barcode']] = 1;
            }
            $_SESSION['PRODUCT'] = $PRODUCT;
            $success = true;
        }
        header('Content-type:application/json');
        echo(json_encode(array('success' => $success)));
        die();
    }
        if($todo == 'order-data'){
            $arr = array();
            $total_amount = 0;
            if(isset($_SESSION['PRODUCT'])){
                $PRODUCT = $_SESSION['PRODUCT'];
                foreach ($PRODUCT as $key => $value) {
                    $item = $conn->query("SELECT * FROM tblproduct INNER JOIN tblunit ON(tblunit.id = tblproduct.unit_id) WHERE tblproduct.barcode = '$key' LIMIT 1");
                    while($row = $item->fetch_assoc()){
                        $arr[] = array(
                            'product_no'            => $row['product_no'],
                            'barcode'              => $key,
                            'product_name'          => $row['product_name'],
                            'unit_name'             => $row['unit_name'],
                            'category_id'             => $row['category_id'],
                            'unit_id'             => $row['unit_id'],
                            'qty'                   => $value,
                            'price'                 => number_format($row['price']),
                            'total_price'           => number_format($value*$row['price']),
                        );
                        $total_amount               += $value*$row['price'];
                    }
                }
            }
            header('Content-type:application/json');
            echo(json_encode(array('success' => true, 'items' => $arr, 'total_amount' => number_format($total_amount))));
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $todo = $_POST['todo'];
        if($todo == 'edit-item'){
            $barcode = $_POST['barcode'];
            $qty = $_POST['qty'];
            $PRODUCT = $_SESSION['PRODUCT'];
            if(isset($PRODUCT[$barcode])){
                $PRODUCT[$barcode] = $qty;
                $_SESSION['PRODUCT'] = $PRODUCT;
            }
            header('Content-type:application/json');
        echo(json_encode(array('success' => true)));
        }
        if($todo == 'delete'){
            $barcode = $_POST['barcode'];
            $PRODUCT = $_SESSION['PRODUCT'];
            if(isset($PRODUCT[$barcode])){
                unset($PRODUCT[$barcode]);
                if(count($PRODUCT) > 0){
                    $_SESSION['PRODUCT'] = $PRODUCT;
                } else {
                    unset($_SESSION['PRODUCT']);
                }
            }
            header('Content-type:application/json');
            echo(json_encode(array('success' => true)));
        }
        if($todo=='submit-sell'){
            $product_no = $_POST['product_no'];
            $barcode = $_POST['barcode'];
            $category_id = $_POST['category_id'];
            $unit_id = $_POST['unit_id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $total_price = $_POST['total_price'];
            $total_amount =  str_replace(",","",$_POST['total_amount']);
            if(count($product_no) > 0){
                $file_content = file_get_contents("./../uploads/bill-no.ini");
                $split = explode("|", $file_content);
                if(date('Y') > $split[1])
                {
                    $handle = fopen('./../uploads/bill-no.ini','w');
                    fwrite($handle,"2|".date('Y'));
                    $bill_no = "IV-".substr(date('Y'), -2) . '-1';
                } else {
                    $handle = fopen('./../uploads/bill-no.ini','w');
                    fwrite($handle,($split[0]+1)."|".date('Y'));
                    $bill_no = "IV-".substr(date('Y'), -2) . '-'.$split[0];
                }
                $conn->query("INSERT INTO tblorder(bill_no,total_amount,user_id,created_at,updated_at) VALUES('$bill_no','$total_amount','$LOGON_USER_ID','$createdAt','$createdAt')");
                foreach($product_no as $key => $value){
                    $str_price = str_replace(",","",$price[$key]);
                    $str_total_price = str_replace(",","",$total_price[$key]);
                    $conn->query("INSERT INTO tblorderlist(bill_no,product_no,barcode,category_id,unit_id,qty,price,total_price,created_at,updated_at) VALUES('$bill_no','$value','$barcode[$key]','$category_id[$key]','$unit_id[$key]','$qty[$key]','$str_price','$str_total_price','$createdAt','$createdAt')");
                }
                unset($_SESSION['PRODUCT']);
                header('Content-type:application/json');
                echo(json_encode(array('success' => true, 'bill_no' => $bill_no)));
            }else{
                header('Content-type:application/json');
                echo(json_encode(array('success' => false, 'message' => 'No data found')));
            }

        }
        }
    ?> 
