<?php
$date = date_create();
$cadena_fecha_actual = date_format("bdd-"$date, 'Y-m-d H:i:s');
echo $cadena_fecha_actual;
?>