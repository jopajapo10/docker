<?php
session_start();
$nombre=$_SESSION["username"];

$host = '212.227.227.87';
$port = 22;
$username = 'root';
$password = 'Jopajapo@10';

$connection = ssh2_connect($host, $port);
ssh2_auth_password($connection, $username, $password);
$stream = ssh2_exec($connection, '/usr/bin/docker-compose -f /var/docker/web/php/users/'.$nombre.'/docker-compose.yml down -v');
sleep(2);
$stream1 = ssh2_exec($connection, 'rm -r /var/docker/web/php/users/'.$nombre.'');
echo "<script>location.href='welcome.php';</script>";
