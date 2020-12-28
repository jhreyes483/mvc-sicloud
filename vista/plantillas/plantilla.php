<?php

//Funcion que me permite exportar codigo HTML si repetir 
function inihtml()
{

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos/css/jav.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- data tables -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">->
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">



        <title>web</title>
    </head>

    <body>

    <?php } ?>

    <?php
    function setMessage()
    {

        $_SESSION['message'] = null;
        $_SESSION['color'] = null;
    }


    ?>


    <?php
    function cardAviso()
    {
    ?>

        <div class="row">
            <div class="card mb-5 p-4 col-sm-12 col-lg-6 mx-auto  ">
                <div class="col-md-10 col-12 mx-auto mt-6 ">
                    <div class="row">
                        <div class="col-md-12  mx-auto text-center text-white ">
                            <div class="card text-white bg-dark shadow">
                               
                                <div class="card-body">
                                    <h4 class="card-title text-warning">IMCO<spaim class=" whi">ABHER <style>.whi{ color: white !important; }</style>  </spaim >  </h4>
                                    <p class="card-text">Los mejores productos, con calidad y economia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <?php
    }
    ?>



    <?php
    function form1()
    { ?>
        <!-- Plantilla formulario -->
        <form action="par_inpar.php" method="POST">
            <div class="form-group"><input class="form-control" name="num1" placeholder="Primer numero" type="number" step="0.01"></div>
            <div class="form-group"><button class="form-control btn btn-primary" type="submit">Ingrese decimales</button></div>
        </form>
    <?php  } ?>


    <?php
    function cardtitulo($x)
    {
        $titulo = $x;

    ?>

        <div class="container-pt-4 my-4">
            <div class="card card-body col-md-4 text-center mx-auto bk-rgb shadow p-3 mb-5 bg-white ">
                <h4 class ="ee"><?php echo $titulo ?></h4>
            </div>
        </div><br><br>
    <?php
        return $titulo;
    } ?>


    <?php
    function cardtituloS($x)
    {
        $titulo = $x;

    ?>
        <div class="my-4">
            <div class="col-md-8 mx-auto card card-body text-center bk-rgb">
                <h5><?php echo $titulo ?></h5>
            </div>
        </div><br><br>
    <?php
        return $titulo;
    } ?>







<?php 
function truncateFloat($number, $digitos)
{
$multiplicador = 100000;
$resultado = ((int)($number * $multiplicador)) / $multiplicador;
return number_format($resultado, $digitos);

}



?>








    <?php
    function finhtml()
    { ?>
        <!-- Complementos bootstrap java script-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/451d49791e.js" crossorigin="anonymous"></script>
        <!-- data tables----------------------------------------------------------------------------------  -->
        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="popper/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->
        <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <script type="text/javascript" src="main.js"></script>




    </body>







    </html>
<?php } ?>