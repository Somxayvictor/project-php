
<?php
include('../inc/connDB.php');
include('../inc/security.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $todo = $_GET['todo'];
    if($todo == 'sell-bill'){
        $items = $conn->query("SELECT * FROM tblorder ORDER BY id DESC LIMIT 10");
        $arr = array();
        while($row = $items->fetch_assoc()){
            $arr[] = array(
                'bill_no'       => $row['bill_no'],
                'total_amount'  => number_format($row['total_amount']),
                'created_at'    => date('d-m-Y H:i:s',strtotime($row['created_at']))
            );
        }
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'items' => $arr)));
    }
    if($todo == 'bill-data'){
        $bill_no = $_GET['bill_no'];
        $item = $conn->query("SELECT * FROM tblorder WHERE bill_no = '$bill_no'");
        $arr = array();
        while($row = $item->fetch_assoc()){
            $arr = array(
                'total_amount'  => number_format($row['total_amount']),
                'created_at'    => date('d-m-Y H:i:s',strtotime($row['created_at']))
            );
        }
        $items = $conn->query("SELECT tblorderlist.*, tblproduct.product_name, tblunit.unit_name FROM tblorderlist INNER JOIN tblproduct ON(tblproduct.product_no = tblorderlist.product_no) INNER JOIN tblunit ON(tblunit.id = tblorderlist.unit_id) WHERE tblorderlist.bill_no = '$bill_no'");
        $lists = array();
        while($row = $items->fetch_assoc()){
            $lists[] = array(
                'product_no'        => $row['product_no'],
                'barcode'           => $row['barcode'],
                'product_name'      => $row['product_name'],
                'unit_name'         => $row['unit_name'],
                'qty'               => $row['qty'],
                'price'             => number_format($row['price']),
                'total_price'       => number_format($row['total_price'])
            );
        }
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'item' => $arr, 'items' => $lists)));
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $todo = $_POST['todo'];
    if($todo == 'delete-bill'){
        $bill_no = $_POST['bill_no'];
        $item = $conn->query("DELETE FROM tblorder WHERE bill_no = '".$bill_no."'");
        if($item){
            $conn->query("DELETE FROM tblorderlist WHERE bill_no = '".$bill_no."'");
            header('Content-type:application/json');
            echo(json_encode(array('success' => true, 'message' => 'Record deleted successfully')));
        } else {
            header('Content-type:application/json');
            echo(json_encode(array('success' => false, 'message' => 'Please try again')));
        }
    }
}
