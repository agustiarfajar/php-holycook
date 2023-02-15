<?php
session_id('rpl2');
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id_user', '', time() - 7200);
setcookie('email', '', time() - 7200);
setcookie('password', '', time() - 7200);

header('Location: home.php');
?>