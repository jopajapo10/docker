<?php
session_start();
$nombre=$_SESSION["username"];

$date = date_create();
$cadena_fecha_actual = date_format($date, 'Y-m-d_H:i');

$host = '212.227.227.87';
$port = 22;
$username = 'root';
$password = 'Jopajapo@10';

$connection = ssh2_connect($host, $port);
ssh2_auth_password($connection, $username, $password);
$stream = ssh2_exec($connection, 'docker exec '.$nombre.'_mysql'.$nombre.'_1 /usr/bin/mysqldump -u root --password=root dbwordpress > /var/docker/web/php/users/'.$nombre.'/'.$nombre.'.sql');

$file_path = 'users/'.$nombre.'/'.$nombre.'.sql';
$filename = ''.$nombre.'-'.$cadena_fecha_actual.'.sql';
sleep(4);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$file_path.'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
?>
