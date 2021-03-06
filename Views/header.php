<!DOCTYPE html>
<html lang="en">
    <head>
		<link rel="shortcut icon" href="../img/LogoUO.png">
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

		<!-- Incluimos las librerías en la página que contiene el formulario a validar -->  
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
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
										<input type="number" name="curso" value="0" hidden=true>
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
								<?php
									$array_date = getDate();
									$date = $array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
									$fecha1 = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
									$fecha2 = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
									$num = numEventosAlertas($fecha1, $fecha2);
                                 
									if($num > 0){
										if($num > 1){?>
									<div style="background-color:grey; border-radius: 5px 5px 5px 5px;">
										<b>
											<FONT FACE="arial" SIZE=4 COLOR="red"><?php echo 'Tienes '. $num .' eventos en los próximos 2 días.'?></FONT>
										</b>
									</div>	
								<?php 	
										}else{?>
									<div style="background-color:grey; border-radius: 5px 5px 5px 5px;">
										<b>
											<FONT FACE="arial" SIZE=4 COLOR="red"><?php echo 'Tienes '. $num .' evento en los próximos 2 días.'?></FONT>
										</b>
									</div>
								<?php	}
									} ?>
                                </div>

                            </div>	
                    </nav>
                    <?php if (ConsultarTipoUsuarioLogin() != 1) { ?>
                                    <br>
                                <?php } ?>
						
                </div>
            </div>
        </header>