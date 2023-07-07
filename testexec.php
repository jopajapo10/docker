<?php
require_once "welcome.php";
$nombre = $_SESSION["username"];
$a = 'version: "3"
services:
  app'.$nombre.':
    image: wordpress:latest
    restart: always
    environment:
      - WORDPRESS_DB_HOST=mysql'.$nombre.':3306
      - WORDPRESS_DB_USER='.$nombre.'
      - WORDPRESS_DB_PASSWORD='.$nombre.'
      - WORDPRESS_DB_NAME=dbwordpress
      - VIRTUAL_HOST='.$nombre.'.press2host.online
    volumes:
      - ./archivos:/var/www/html
    networks:
      - web
      - backend
    depends_on:
      - mysql'.$nombre.'

  mysql'.$nombre.':
    image: mariadb:10.5.5    
    restart: always
    environment:
      - MYSQL_ROOT_PASSWORD=root
      - MYSQL_DATABASE=dbwordpress
      - MYSQL_USER='.$nombre.'
      - MYSQL_PASSWORD='.$nombre.'
    volumes:
      - mysql:/var/lib/mysql
    networks:
      - backend
networks:
  web:
    external:
      name: dockerwordpressnet
  backend:
    driver: bridge
volumes:
  app:
  mysql:';
shell_exec("mkdir /var/www/html/users/'$nombre'");
file_put_contents("/var/www/html/users/$nombre/docker-compose.yml", "$a");

$host = '212.227.227.87';
$port = 22;
$username = 'root';
$password = 'Jopajapo@10';

$connection = ssh2_connect($host, $port);
ssh2_auth_password($connection, $username, $password);
$stream = ssh2_exec($connection, '/usr/bin/docker-compose -f /var/docker/web/php/users/'.$nombre.'/docker-compose.yml up -d');
sleep(8);
echo '<script type="text/javascript">
           window.open("https://'.$nombre.'.press2host.online/")
      </script>';
echo "<script>location.href='welcome.php';</script>";

?>
