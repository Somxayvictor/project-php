<?php
include('../inc/connDB.php');
setcookie ("user_id", "", time() - 3600, "/");
setcookie ("key", "", time() - 3600, "/");
header('Content-type:application/json');
echo(json_encode(array('success' => true, 'logout_message' => 'ອອກຈາກລະບົບສຳເລັດແລ້ວ')));
