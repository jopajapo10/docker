<?php
// Inmicia sesion
session_start();
 
// Comprubea si el usuario ya esta logeado, si lo esta lo redirecciona a la pagina de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Incluir configuracion
require_once "config.php";
 
// Definir variables e inicializar con valores vac�os
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Procesa los datos del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Comprueba si el nombre esta vacio
    if(empty(trim($_POST["username"]))){
        $username_err = "Introduce nombre de usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Comprueba si la contrase�a esta vacia
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduce tu contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        // Prepara la consulta select
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Enlazar variables
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parametros
            $param_username = $username;
            
            // Ejecuta
            if(mysqli_stmt_execute($stmt)){
                // Almacena resultados
                mysqli_stmt_store_result($stmt);
                
                // Comprobar usuario, si existe, comprobar contrase�a
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Enlazar variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Contrase�a correcta, incia sesion
                            session_start();
                            
                            // Almacenar datos en las variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redireciona a los usuarios a la pagina de bienvenida
                            header("location: welcome.php");
                        } else{
                            // La contrase�a es incorrecta, genera un mensaje
                            $login_err = "Contraseña incorrecta.";
                        }
                    }
                } else{
                    // Usuario no existe, genera un mensaje
                    $login_err = "Este usuario no existe...";
                }
            } else{
                echo "Jo! Algo ha salido mal...";
            }

            // Cerrar
            mysqli_stmt_close($stmt);
        }
    }
    
    // Cerrar conexion
    mysqli_close($link);
}
// COOKIES
// Si han aceptado la política
if(isset($_REQUEST['politica-cookies'])) {
    // Calculamos la caducidad, en este caso un año
    $caducidad = time() + (60 * 60 * 24 * 365);
    // Crea una cookie con la caducidad
    setcookie('politica', '1', $caducidad);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    #div-cookies {
        position: fixed;
        bottom: 0px;
        left: 0px;
        width: 100%;
        background-color: white;
        box-shadow: 0px -5px 15px gray;
        padding: 7px;
        text-align: center;
        z-index: 99;
        }
    </style>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src='https://www.google.com/recaptcha/api.js?render=6LcrIo8cAAAAAIxBAJr5hY4ZzPzEuQb-x-uqw065'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cssindex/styleola.css">
    <link rel="stylesheet" href="cssindex/style.css">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <!-- Global site tag (gtag.js) - Google Ads: 306724947 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-306724947"></script>
    <script>
        grecaptcha.ready(function() {
        grecaptcha.execute('6LcrIo8cAAAAAIxBAJr5hY4ZzPzEuQb-x-uqw065', {action: 'formulario'})
        .then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
        });});
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-306724947');
    </script>
    <!-- Event snippet for Website traffic conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-306724947/SU7ICPGVpfECENOAoZIB'});
    </script>
    <!-- Event snippet for Website traffic conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-306724947/SU7ICPGVpfECENOAoZIB'});
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background-color: white;">
<!-- COOKIES -->
<div id="div-cookies" style="display: none;">
    <div >
            <a style="position:static; right:0px; font-size: 15px;">Necesitamos usar cookies para que funcione todo, si permanece aquí acepta su uso, más información en <a style="position:static; right:0px; font-size: 15px; color: #2e87fe;" href="politicasdeprivacidad.php">Politicas de Privacidad.</a></a>
    </div>
        <button type="button" class="btn btn-sm btn-primary" onclick="acceptCookies()">
            Acepto el uso de cookies
        </button>
</div>
    <script>
        function checkAcceptCookies() {
            if (localStorage.acceptCookies == 'true') {} else {
            $('#div-cookies').show();
            }
        }

        function acceptCookies() {
            localStorage.acceptCookies = 'true';
            $('#div-cookies').hide();
        }
        $(document).ready(function() {
            checkAcceptCookies();
        });
    </script>
<!-- COOKIES FIN -->
<!--Hey! This is the original version of Simple CSS Waves-->
<div class="header">
<!-- AVISO ERRORES -->
    <?php 
        if(!empty($login_err)){
            echo '<div style="border-color: white; border-radius: 10px 10px 10px 10px; color: black; background-color: #03aac1;" class="alert alert-danger">' . $login_err . '</div>';
        }        
    ?>
    <?php 
        if(!empty($password_err)){
            echo '<div style="border-color: white; border-radius: 10px 10px 10px 10px; color: black; background-color: #03aac1;" class="alert alert-danger">' . $password_err . '</div>';
        }        
    ?>
    <?php 
        if(!empty($username_err)){
            echo '<div style="border-color: white; border-radius: 10px 10px 10px 10px; color: black; background-color: #03aac1;" class="alert alert-danger">' . $username_err . '</div>';
        }        
    ?>
    <!-- AVISO ERRORES FIN -->
<!--Content before waves-->
    <div class="inner-header flex">
    </div>
<!-- LOGIN -->
    <div >

        <form class="login" method="post">


                <input style="border-style: solid; border-width: 1px; border-color: #b5d4db;" type="text" name="username"  placeholder="Nombre usuario(e.j: site1)">
                <input style="border-style: solid; border-width: 1px; border-color: #b5d4db;" placeholder="contraseña" type="password" name="password">
		
                <button>Entrar</button>

            <p><a style="color:black;" href="register.php">Registrate ya!</a></p>
        </form>
    </div>
    <!-- LOGIN FINAL -->
<!--Waves Container-->
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
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
</div>
    <!--Header ends-->
<!--Content starts-->
        <div class="content flex">
            <p>HostUp | 2021 | Jose Pablo Jaraba Porras</p>
        </div>
        <!--recaptcha -->
        <?php
            if (isset($_POST['action']) && ($_POST['action'] == 'process')) {

                $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
                $recaptcha_secret = '6LcrIo8cAAAAAD9PKxn1Tb0itV1IxngKt8hPSabr'; 
                $recaptcha_response = $_POST['recaptcha_response']; 
                $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
                $recaptcha = json_decode($recaptcha); 
        
                if($recaptcha->score >= 0.7){
        
          // código para procesar los campos y enviar el form
        
                } else {
        
          // código para lanzar aviso de error en el envío
        
                }
        
                }   
        ?>
        <!--recaptcha fin -->
</body>
</html>
