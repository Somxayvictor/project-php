<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../inc/connDB.php');
include('../inc/security.php');
$id = $_POST['id'];
$product_no = $_POST['product_no'];
$barcode = $_POST['barcode'];
$product_name = $_POST['product_name'];
$category_id = $_POST['category_id'];
$unit_id = $_POST['unit_id'];
$image = $_FILES['image'];
$image_exist = $_POST['image_exist'];
$price = str_replace(",","",$_POST['price']);

$filePath = $image_exist;
if(!empty($image["name"])) {
    $targetDir = "./../uploads/products/";
    $fileName = basename($image["name"]);
    $fileType = explode(".",$image["name"]);
    $fileType = strtolower(end($fileType));
    $newFileName = md5(time() . $fileName) . '.' . $fileType;
    $targetFilePath = $targetDir . $newFileName;
    //allow certain file formats
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        //upload file to server
        if(move_uploaded_file($image["tmp_name"], $targetFilePath)){
            $filePath = SITE_DOMAIN.'uploads/products/'.$newFileName;
            if($image_exist !=''){
                $oldFile = str_replace(SITE_DOMAIN,'',$image_exist);
                if (file_exists('./../'.$oldFile)){
                    unlink('./../'.$oldFile);
                }
            }
        }
    }
}
if($id > 0){
        $conn->query("UPDATE tblproduct SET barcode = '$barcode', product_name = '$product_name', category_id = '$category_id', unit_id = '$unit_id', price = '$price', image = '$filePath', updated_at = '$createdAt' WHERE id = ".$id);
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$product_name.'" updated')));
} else {
        $handle = fopen('./../uploads/product-no.ini','r');
        $counter = fgets($handle);
        fclose($handle);
        $handle = fopen('./..//uploads/product-no.ini','w');
        fwrite($handle,$counter+1);
        $product_no = "P".substr("00000".$counter, -5);
        $check = $conn->query("INSERT INTO tblproduct(product_no,barcode,product_name,category_id,unit_id,price,image,created_at) VALUES('$product_no','$barcode','$product_name','$category_id','$unit_id','$price','$filePath','$createdAt')");
        if($check){
            header('Content-type:application/json');
            echo(json_encode(array('success' => true, 'message' => '"'.$product_name.'" added')));
        } else {
            header('Content-type:application/json');
            echo(json_encode(array('success' => false, 'message' => 'Error add')));
        }
        
}