<?php

class Registro {

    var $view;

//VISTA REALIZAR EL REGISTRO
    function __construct($numTipo) {
		$this->numTipo = $numTipo;
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
                        <form method="post" action="./Registro.php" role="registrar">
                            <img src="../img/logo.png" class="img-responsive" alt="" />
                            <input type="text" name="username" placeholder="<?php echo $strings['username']; ?>" required class="form-control input-lg" id="username" />
                            <input type="password" name="password" placeholder="<?php echo $strings['password']; ?>" required class="form-control input-lg" id="password" />
							<input type="text" name="nombre" placeholder="<?php echo $strings['nombre']; ?>" required class="form-control input-lg" id="nombre" />
                            <input type="text" name="apellidos" placeholder="<?php echo $strings['apellidos']; ?>" required class="form-control input-lg" id="apellidos" />
							<input type="text" name="dni" placeholder="<?php echo $strings['dni']; ?>" required class="form-control input-lg" id="dni" />
                            <input type="date" name="fechaNac" placeholder="<?php echo $strings['fechaNac']; ?>" required class="form-control input-lg" id="fechaNac" />
							<input type="text" name="niu" placeholder="<?php echo $strings['niu']; ?>" required class="form-control input-lg" id="niu" />
                            <input type="email" name="email" placeholder="<?php echo $strings['email']; ?>" required class="form-control input-lg" id="email" />
							<div class="form-group">
								<label class="control-label" ><?php echo $strings['tipoUsuario']; ?></label><br>
								<input class="form" id="tipoUsuario" name="tipoUsuario" size="10" type="int" required="true" value="<?php echo $this->numTipo ?>" readonly="true"/>
							</div>

                            <button type="submit" name="accion" class="btn btn-lg btn-primary btn-block" value="Registrar">Registrar</button>
							<a href='../index.php'><?php echo $strings['Volver']; ?> </a>                         

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