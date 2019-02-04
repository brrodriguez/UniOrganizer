<?php

//VISTA REALIZAR EL REGISTRO
class Registro {

    function __construct($numTipo) {
		$this->numTipo = $numTipo;
        $this->render();
    }

    function render() {
		?>
        <script type="text/javascript" src="../js/validate.js"></script>
        <?php
        include '../Locates/Strings_Castellano.php';
        ?>

        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
                <title>UniOrganizer</title>
                <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
                <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
                <link rel="stylesheet" type="text/css" href="../css/stylesLogin.css" />
            </head>
            <body>
                <section class="container">
                    <section class="login-form">
                        <form id="form" name="form" method="post" action="./Registro.php" role="registrar" >
                            <input onchange="return valida_envia_username()" type="text" id="username" name="username" placeholder="<?php echo $strings['username']; ?>*" required class="form-control input-lg"  />
                            <input onchange="return valida_envia_password()" type="password" id="password" name="password" placeholder="<?php echo $strings['password']; ?>*" required class="form-control input-lg"  />
							<input onchange="return valida_envia_nombre()" type="text" id="nombre" name="nombre" placeholder="<?php echo $strings['nombre']; ?>*" required class="form-control input-lg"  />
                            <input onchange="return valida_envia_apellidos()" type="text" id="apellidos" name="apellidos" placeholder="<?php echo $strings['apellidos']; ?>*" required class="form-control input-lg"  />
							<input onchange="return valida_envia_dni()" type="text" id="dni" name="dni" placeholder="<?php echo $strings['dni']; ?>*" required class="form-control input-lg"  />
                            <input onchange="return valida_envia_fechaNac()" type="date" id="fechaNac" name="fechaNac" placeholder="<?php echo $strings['fechaNac']; ?>*" required class="form-control input-lg"  />
							<input onchange="return valida_envia_niu()" type="int" id="niu" name="niu" size="12"  placeholder="<?php echo $strings['niu']; ?>*" required class="form-control input-lg"  />
                            <input onchange="return valida_envia_email()" type="email" id="email" name="email" placeholder="<?php echo $strings['email']; ?>*" required class="form-control input-lg"  />
							<input type="hidden" id="tipoUsuario" name="tipoUsuario" size="10" type="int" required="true" value="<?php echo $this->numTipo ?>" readonly="true"/>
							<!--SELECCION DE IDIOMA-->
                                <p>
									<select name="IDIOMA">
                                        <option value="Castellano">Castellano</option>
                                        <option value="Galego">Galego</option>
                                        <option value="English">English</option>
                                    </select>
								</p>
							<input type='submit' onclick="return valida_envia_USUARIO()" name='accion'  value="<?php echo $strings['Registrar']; ?>">
							<a href='../index.php'><?php echo $strings['Volver']; ?> </a>                         

                        </form>
                    </section>
                </section>
            </body>
        </html>
        <?php
    }

}
?>