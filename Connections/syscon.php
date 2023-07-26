<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bis = "localhost";
$database_bis = "db";
$username_bis = "root";
$password_bis = "";
$bis = mysqli_connect($hostname_bis, $username_bis, $password_bis, "$database_bis") or trigger_error(mysqli_error(),E_USER_ERROR); 
$result = mysqli_set_charset($bis, 'utf8'); //mysqli_query($bis,"SET CHARACTER SET 'utf8'");
if (!$result) {
die("Charset Failed");
}
?>