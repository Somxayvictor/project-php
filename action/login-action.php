<?php
include('../inc/connDB.php');
$email = $_POST['email'];
$password = $_POST['password'];

$item = $conn->query("SELECT * FROM tbluser where email = '$email' LIMIT 1");
if($item){
    while($row = $item->fetch_assoc()){
        if($row['password'] == crypt($password, $row['password']))
        {
            setcookie('user_id', $row['id'], time() + 86400 , "/");
            setcookie('key',md5($row['id'].SECRET),time()+86400,'/');
            header('Content-type:application/json');
            echo(json_encode(array('success' => true, 'message' => 'ລອກອີນເຂົ້າສູ່ລະບົບສຳເລັດແລ້ວ')));
        } else {
            header('Content-type:application/json');
            echo(json_encode(array('success' => false, 'message' => 'ອີເມວ/ລະຫັດ ບໍ່ຖືກຕ້ອງ')));
        }
    }
} else {
    header('Content-type:application/json');
    echo(json_encode(array('success' => false, 'message' => 'ອີເມວ/ລະຫັດ ບໍ່ຖືກຕ້ອງ')));
}
?>