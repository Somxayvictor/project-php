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
$role = $_POST['role'];
$options = [
    'cost' => 12,
];
// $password = password_hash($password, PASSWORD_BCRYPT, $options);
if($password == $confirm_password){
    $password = password_hash($password, PASSWORD_BCRYPT, $options);
    if($id > 0){
        $conn->query("UPDATE tbluser SET name = '$name', email = '$email', password = '$password',role = '$role' WHERE id = '$id'");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$name.'" updated')));
    } else {
        $conn->query("INSERT INTO tbluser(name,email,password,role,created_at) VALUES('$name','$email','$password','$role','$createdAt')");
        header('Content-type:application/json');
        echo(json_encode(array('success' => true, 'message' => '"'.$name.'" added')));
    }
} else {
    header('Content-type:application/json');
    echo(json_encode(array('success' => false, 'message' => 'Password invalid')));
}
