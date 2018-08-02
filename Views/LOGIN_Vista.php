<?php

class Login {

    var $view;

//VISTA REALIZAR EL LOGIN
    function __construct() {
        $this->render();
    }

    function render() {
        include '../Locates/Strings_Castellano.php';
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                 <link rel="shortcut icon" href="../img/Gym.ico">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
                <title>UniOrganizer</title>
                <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
                <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
                <link rel="stylesheet" type="text/css" href="../css/stylesLogin.css" />

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
            </head>
            <body>

                <section class="container">
                    <section class="login-form">
                        <form method="post" action="./Acceso.php" role="login">
                            <img src="../img/LogoUO.png" class="img-responsive" alt="" />
                            <input type="text" name="username" placeholder="<?php echo $strings['username']; ?>" required class="form-control input-lg" id="username" />
                            <input type="password" name="password" placeholder="<?php echo $strings['password']; ?>" required class="form-control input-lg" id="password" />
                            <button type="submit" name="accion" class="btn btn-lg btn-primary btn-block" value="Login">Sign in</button>
                            <div>
                                <!--SELECCION DE IDIOMA-->
                                <p><select name="IDIOMA">
                                        <option value="Castellano">Castellano</option>
                                        <option value="Galego">Galego</option>
                                        <option value="English">English</option>
                                    </select></p>
                                    <div aling='center'>
                                <a href='../index.php'><?php echo $strings['Volver']; ?> </a>
                                    </div>
                            </div>



                        </form>
                    </section>
                </section>

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="../js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }

}
?>