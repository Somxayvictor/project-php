<?php
include('../inc/connDB.php');
include('../inc/security.php');
$id = $_POST['id'];

$item = $conn->query("SELECT image FROM tblproduct WHERE id = ".$id);
while($row = $item->fetch_assoc()){
    $oldFile = str_replace(SITE_DOMAIN,'',$row['image']);
    if (file_exists('./../'.$oldFile)){
        unlink('./../'.$oldFile);
    }
}
$delete = $conn->query("DELETE FROM tblproduct WHERE id = ".$id);
if($delete){
    header('Content-type:application/json');
    echo(json_encode(array('success' => true, 'message' => 'Record deleted successfully')));
} else {
    header('Content-type:application/json');
    echo(json_encode(array('success' => false, 'message' => 'Please try again')));
}