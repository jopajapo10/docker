<?php
// Iniciar sesi�n
session_start();
// Comprueba si el usuario esta logueado, si no es as� lo redirecciona al login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ESTILO MENU -->
  <style>
    * {box-sizing: border-box}

    /* Style the tab */
    .tab2 {
    float: left;

    width: 30%;
    }

    /* Style the buttons inside the tab */
    .tab2 button {
    display: block;
    background-color: #e9e9e9;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border-radius: 13px 13px 13px 13px;
    margin: 10px;
    border: solid 1px #e9e9e9;
    outline: none;
    text-align: left;
    cursor: pointer;
    font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab2 button:hover {
    background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab2 button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent2 {
    float: left;
    padding: 0px 12px;
    width: 70%;
    border-left: none;
    height: 300px;
    display: none;
    }

    /* Clear floats after the tab */
    .clearfix::after {
    content: "";
    clear: both;
    display: table;
    }
  </style>
  <!-- ESTILO MENU FIN -->
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HostUp</title>
  <link rel="stylesheet" media="all" href="csswelcome/stylewelcome1.css" />
  <link rel="stylesheet" media="all" href="csswelcome/stylewelcome2.css" />
</head>
<body>
  <!--Hey! This is the original version of Simple CSS Waves-->
<div class="header">
  <a href="https://josepa.online/"><img width="300" height="150" src="logohost.png"></a>
  <!--Content before waves-->
  <div style="display: inherit; height: vh;" class="inner-header flex">
        <!-- PANEL DE CONTROL -->
        <!-- MENU ARRIBA -->
      <div class="warpper" style="margin-top: 25px;">
        <input class="radio" id="one" name="group" type="radio" checked>
        <input class="radio" id="two" name="group" type="radio">
        <input class="radio" id="three" name="group" type="radio">
        <div class="tabs">
          <label class="tab" id="one-tab" for="one">Inicio</label>
          <label class="tab" id="two-tab" for="two">Recuperaciones</label>
          <label class="tab" id="three-tab" for="three">Sobre nosotros</label>
        </div>
          <!-- MENU ARRIBA FIN -->
        <div class="panels">
        <div class="panel" id="one-panel">
        <div style="color: #324659;" class="panel-title"><center>WORDPRESS GRATIS</center></div>
          <h4 class="name"><center><a href="http://<?php echo htmlspecialchars($_SESSION["username"]);?>.press2host.online" target="_blank"><b><?php echo htmlspecialchars($_SESSION["username"]);?>.press2host.online</b></a></center></h4>
          <h5 style="color: black;" class="name"><center><small>Dale y entra!</small></center></h5>
          <center><a style="padding: 20px; margin-top:20px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-primary" href="testexec.php"><b>CREAR WEB</b></a></center>
            <a class="btn btn-danger" style="margin-top:40px; margin-left:230px;" href="/logout.php">Cerrar Sesión</a>
        </div>
        <div class="panel" id="two-panel">
          <!-- MENU -->
          <div class="tab2">
            <button class="tablinks" onmouseover="openCity(event, 'estado')">Estado</button>
            <button class="tablinks" onmouseover="openCity(event, 'copia')">Copias de seguridad</button>
            <button class="tablinks" onmouseover="openCity(event, 'info')">Proximo</button>
          </div>

          <div id="estado" class="tabcontent2">
            <h3 style="color: #324659;">Estado de la web</h3>
            <p>
              <a style="margin: 30px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-primary" href="/start.php"><b>Iniciar</b></a>
              <a style="margin: 30px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-danger" href="/stop.php"><b>Detener</b></a>
            </p>
          </div>

          <div id="copia" class="tabcontent2">
            <h3 style="color: #324659;">Backups de la web</h3>
            <p>
              <a style="margin: 5px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-primary" href="/download.php"><b>Copiar DB</b></a>
              <a style="margin: 5px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-primary" href="/subir.php"><b>Explorar Archivos</b></a>
              <a style="margin: 5px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-primary" href="/backuparchivos.php"><b>Copia Archivos</b></a>
              <a style=" margin: 5px; border-radius:8px 8px 8px 8px; box-shadow: 1px 1px 1px #00000080;" class="btn btn-danger" href="/borrar.php"><b>Borrar</b></a>
            </p> 
          </div>

          <div id="info" class="tabcontent2">
            <h3 style="color: #324659;">Proximamente</h3>
            <p>Se viene cositas.</p>
          </div>

          <div class="clearfix"></div>

          <script>
            function openCity(evt, cityName) {
              var i, tabcontent2, tablinks;
              tabcontent2 = document.getElementsByClassName("tabcontent2");
              for (i = 0; i < tabcontent2.length; i++) {
                tabcontent2[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
            }
          </script>
        </div>

          <!-- MENU FIN -->
        <div class="panel" id="three-panel">
        <h3 style="color: #324659;" class="panel-title">¿Por qué hacemos esto?</h3>
          <p>Ofrecemos la oportunidad de poder crear tu propia web totalmente gratis y con un dominio para poder acceder a ella desde donde quieras. No tenemos tarifas ni pagos, todo es al momento y sin coste alguno. Siempre podras hacer una copia de tu web y transladarla a donde quieras.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- PANEL DE CONTROLfinal -->
</div>
<!--Waves Container-->
<div>
  <svg style="position:static; background: linear-gradient(161deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);" class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
  viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
      <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
      <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
      <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
      <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
      <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
    </g>
  </svg>
</div>
<!--Waves end-->
<!--Header ends-->

<!--Content starts-->
<div class="content flex">
  <p>HostUp | 2021 | Jose Pablo Jaraba Porras</p>
</div>
<!--Content ends-->
</body>
</html>
