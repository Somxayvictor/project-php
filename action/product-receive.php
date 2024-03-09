<?php
include('../inc/connDB.php');
include('../inc/security.php');
$product_no = $_POST['product_no'];
$qty = $_POST['qty'];

$item = $conn->query("SELECT qty FROM tblproduct WHERE product_no = '$product_no'");
while($row = $item->fetch_assoc()){
    $qty +=$row['qty'];
}
$update = $conn->query("UPDATE tblproduct SET qty ='$qty' WHERE product_no = '$product_no'");
if($update){
    header('Content-type:application/json');
    echo(json_encode(array('success' => true, 'message' => 'Product Recieve Added')));
} else {
    header('Content-type:application/json');
    echo(json_encode(array('success' => false, 'message' => 'Please try again')));
}