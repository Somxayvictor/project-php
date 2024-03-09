<?php
if(isset($_COOKIE['user_id'])){
    $checkLogin = $conn->query("SELECT * FROM tbluser where id = ".$_COOKIE['user_id']." LIMIT 1");
    if($checkLogin){
        while($checkRow = $checkLogin->fetch_assoc()){
            if($_COOKIE['key'] == md5($checkRow['id'].SECRET)){
                $LOGON_USER_ID = $checkRow['id'];
                $LOGON_USER_NAME = $checkRow['name'];
                $LOGON_USER_ROLE = $checkRow['role'];
            } else {
                include('login.php');
                die();
            }
        }
    } else {
        include('login.php');
        die();
    }
} else {
    include('login.php');
    die();
}
?>