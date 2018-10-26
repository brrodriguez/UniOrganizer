<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="../img/Gym.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>UniOrganizer</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/responsive-slider.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link href="../css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
									<form method="post" action="../Functions/Acceso.php" role="login">
										<input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
										<input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
										<input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
										<input type="number" name="curso" value=0 hidden=true>
										<button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><img src="../img/LogoUO.png" width="250" height="100"/></button>
									</form>
                            </div>
                            <div>
                                <?php if (ConsultarTipoUsuarioLogin() != 1) { ?>
                                    <br>
                                <?php } ?>
                                <div class="menu">
                                    <ul class="nav nav-tabs" role="tablist">

                                        <?php
                                        showNavbar();
                                        ?>
                                    </ul>
                                </div>

                            </div>	
                    </nav>
                    <?php if (ConsultarTipoUsuarioLogin() != 1) { ?>
                                    <br>
                                <?php } ?>
						
                </div>
            </div>
        </header>