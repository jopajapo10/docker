<?php
session_start();
$nombre=$_SESSION["username"];

$date = date_create();
$cadena_fecha_actual = date_format($date, 'Y-m-d_H-i');

$host = '212.227.227.87';
$port = 22;
$username = 'root';
$password = 'Jopajapo@10';

$connection = ssh2_connect($host, $port);
ssh2_auth_password($connection, $username, $password);
$stream = ssh2_exec($connection, 'docker exec '.$nombre.'_mysql_1 /usr/bin/mysqldump -u root --password=root site9 > /var/docker/web/php/users/'.$nombre.'/'.$cadena_fecha_actual.'.sql');

$file_path = 'users/'.$nombre.'/'.$cadena_fecha_actual.'.sql';
$filename = 'holasite5.sql';

header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".$filename."\""); 
echo readfile($file_path);
?>
