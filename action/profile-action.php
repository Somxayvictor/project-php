<?php
include('../inc/connDB.php');
include('./inc/security.php');
    $id = 0;
// var_dump($_POST);
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$options = [
    'cost' => 12,
];
// $password = password_hash($password, PASSWORD_BCRYPT, $options);
if($password == $confirm_password){
    $password = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn->query("UPDATE tbluser SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$name.'" updated')));
} else {
    header('Content-type:application/json');
    echo(json_encode(array('success' => false, 'message' => 'Password invalid')));
}
