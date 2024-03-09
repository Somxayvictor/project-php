<?php
include('../inc/connDB.php');
include('./inc/security.php');
    $id = 0;
// var_dump($_POST);
$id = $_POST['id'];
$unit_name = $_POST['unit_name'];

    if($id > 0){
        $conn->query("UPDATE tblunit SET unit_name = '$unit_name' WHERE id = '$id'");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$unit_name.'" updated')));
    } else {
        $conn->query("INSERT INTO tblunit(unit_name,created_at) VALUES('$unit_name','$createdAt')");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$unit_name	.'" added')));
    }
