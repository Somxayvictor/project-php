<?php
include('../inc/connDB.php');
include('./inc/security.php');
    $id = 0;
// var_dump($_POST);
$id = $_POST['id'];
$category_name= $_POST['category_name'];
    if($id > 0){
        $conn->query("UPDATE tblcategory SET category_name = '$category_name' WHERE id = '$id'");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$category_name.'" updated')));
    } else {
        $conn->query("INSERT INTO tblcategory(category_name,created_at) VALUES('$category_name','$createdAt')");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$category_name.'" added')));
    }
