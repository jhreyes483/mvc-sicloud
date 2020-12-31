<?php
include_once '../../application/Config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?= RUTAS_APP['ruta_css'] ?>jav.css" rel="stylesheet" type="text/css" />
    <link href="<?= RUTAS_APP['ruta_css'] ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= RUTAS_APP['ruta_css'] ?>font-awesome.css" rel="stylesheet" type="text/css" />

    <link href="<?= RUTAS_APP['ruta_css'] ?>chat.css" rel="stylesheet" type="text/css" />
    <script src="<?= RUTAS_APP['ruta_js'] ?>fontawasome-ico.js"></script>

    </thead>

    <?php

    @session_start();

    if (isset($_SESSION['s_menu'])) echo $_SESSION['s_menu'];
    ?>
    <script type="text/javascript">
        // Creacion de funcion
        function ventanachat() {
            var xmlHttp;
            //detectar navegador
            //--------------------------------------------------
            if (window.XMLHttpRequest) {
                xmlHttp = new XMLHttpRequest();
            } else {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            //--------------------------------------------------
            //--------------------------------------------------
            var fetch_unix_timestamp = "";
            fetch_unix_timestamp = function() {
                return parseInt(new Date().getTime().toString().substring(0, 10))
            }
            var timestamp = fetch_unix_timestamp();
            xmlHttp.onreadystatechange = function() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("ventanachat").innerHTML = xmlHttp.responseText;
                    setTimeout('ventanachat()', 1000);
                }
            }
            //--------------------------------------------------
            //--------------------------------------------------
            //ejecuncion de peticion
            xmlHttp.open("GET", "mensaje.php" + "?t=" + timestamp, true);
            xmlHttp.send(null);
            //--------------------------------------------------
        } // fin de funcion principal ventana chat
        //----------------------------------------
        //Inicio de onload que carga en el evento carga de la pagina
        window.onload = function startrefresh() {
            setTimeout('ventanachat()', 1000);
        }
    </script>


<body>

    <!-- 

    <div class="menu">
        <div class="back"><i class="fa fa-chevron-left"></i> <img src="https://i.imgur.com/DY6gND0.png" draggable="false" /></div>
        <div class="name">Alex</div>
        <div class="last">18:09</div>
    </div>
    <ol class="chat">
        <li class="other">
            <div class="avatar"><img src="https://i.imgur.com/DY6gND0.png" draggable="false" /></div>
            <div class="msg">
                <p>Hola!</p>
                <p>Te vienes a cenar al centro?
                    <emoji class="pizza" />
                </p>
                <time>20:17</time>
            </div>
        </li>
        <li class="self">
            <div class="avatar"><img src="https://i.imgur.com/HYcn9xO.png" draggable="false" /></div>
            <div class="msg">
                <p>Puff...</p>
                <p>Aún estoy haciendo el contexto de Góngora...
                    <emoji class="books" />
                </p>
                <p>Mejor otro día</p>
                <time>20:18</time>
            </div>
        </li>

    </ol>
    <input class="textarea" type="text" placeholder="Type here!" />
    <div class="emojis"></div>
 -->




    <div class="row">
        <div class=" card-body col-lg-3 col-md-3 ">
            <form class="form-group" action="controllers/mensajeController.php" method="GET">


                </ol>
                
                <input class="textarea" type="text" placeholder="__Enviar" name="mensaje" id="enviarchat" />
               
                <div class="emojis">

                <button class="btn btn-success btn-lg" type="submit" ><i class="fas fa-greater-than"></i></button>
                </div>
            </form>
        </div>
        <div id="ventanachat" class="mx-auto">
            <div class="col-lg-12">
                <script type="text/javascript">
                    ventanachat();
                </script>
            </div>
        </div>
    </div>


</body>

<script src="<?= RUTAS_APP['ruta_js'] ?>jquery-1.9.0.js"></script>
<script src="<?= RUTAS_APP['ruta_js'] ?>bootstrap.min.js"></script>

</html>