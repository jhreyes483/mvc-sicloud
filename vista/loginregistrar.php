<?php
include_once '../controlador/controladorrutas.php';
rutFromIniLogin();
?>

<link rel="stylesheet" href="../public/css/reset.min.css">
<link rel="stylesheet" href="../public/css/login.css">
<link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>

<body>

    <section class="user">
        <div class="user_options-container">
            <div class="user_options-text">
                <div class="user_options-unregistered">
                    <h2 class="user_unregistered-title">¿No tienes una cuenta?</h2>
                    <p class="user_unregistered-text">Siclod es el mejor servicio en la nube para manejo de inventarios y control de ventas.</p>
                    <button class="user_unregistered-signup" id="signup-button">Registrarse</button>
                </div>

                <div class="user_options-registered">
                    <h2 class="user_registered-title">¿Tienes una cuenta</h2>
                    <p class="user_registered-text">Siclod es el mejor servicio en la nube para manejo de inventarios y control de ventas.</p>
                    <button class="user_registered-login" id="login-button">Ingreso</button>
                </div>
            </div>

            <div class="user_options-forms" id="user_options-forms">
                <div class="user_forms-login">
                    <h2 class="forms_title">Ingreso</h2>
                    <form class="forms_form" action="../controlador/api.php?apicall=loginusuario" method="POST">
                        <fieldset class="forms_fieldset">
                            <div class="forms_field">

                                <div class="form-group">
                                    <select class="form-control" name="tDoc" id="">
                                        <option class="form-control" value="CC">CC</option>
                                        <option class="form-control" value="CE">CE</option>
                                        <option class="form-control" value="TI">TI</option>
                                    </select>
                                </div>
                            <div class="forms_field">
                                <input type="number" name="nDoc" placeholder="No. documento" class="forms_field-input" required autofocus />
                            </div>
                            <div class="forms_field">
                                <input type="password" name="pass" placeholder="Contraseña" class="forms_field-input" required />
                            </div>
                        </fieldset>
                        <div class="forms_buttons">
                            <a class="forms_buttons-forgot" href="forgot_password/dist/index.php">Olvidó la contraseña?</a>
                            <input type="submit" name="btnLogin" value="Enviar" class="forms_buttons-action">
                        </div>
                    </form>


                    <div class="my-2">
                        <?php if (isset($_SESSION['message'])) { ?>
                            <!-- alerta boostrap -->
                            <div class="alert alert-<?php echo $_SESSION['color']   ?> alert-dismissible fade show" role="alert">
                                <?php
                                echo  $_SESSION['message']  ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            setMessage();
                            //session_unset();
                        } ?>
                    </div>



                </div>
                <div class="user_forms-signup">
                    <img width="250px" src="fonts/registrarh.PNG">
                    <div class="forms_buttons">
                        <a href="./CU002-registrodeUsuario.php">
                            <input type="submit" value="Registrarse" class="forms_buttons-action">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- partial -->
    <script src="estilos/js/script.js"></script>

    <?php
    rutFromFin();
    rutFinFooterFrom();
    ?>