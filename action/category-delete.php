<?php 
include('../inc/connDB.php');
include('./inc/security.php');
    $id = 0;
$id= $_POST['id'];
$item=$conn->query("DELETE FROM tblcategory WHERE id=".$id);
if($item){
    header('Content-type:application/json');
    echo(json_encode(array('success' => true, 'message'=>'Record deleted succesfully')));
}else{
    header('Content-type:application/json');
    echo(json_encode(array('success'=> false,'message'=>'please try again')));
}
?>