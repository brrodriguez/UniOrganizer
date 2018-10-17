<?php
		error_reporting(E_ERROR);
		include_once '../Functions/LibraryFunctions.php';
		if (!IsAuthenticated()) {
			header('Location:../index.php');
		}
		include_once '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
		include_once '../Views/header.php';
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<script type="text/javascript" src="../css/lib/alertify.js"></script>
				<link rel="stylesheet" href="../css/themes/alertify.core.css" />
				<link rel="stylesheet" href="../css/themes/alertify.default.css" />
			</head>
			
			<div class="container">
				<?php
					$c=0;
					foreach ($_SESSION['Lunes'] as $day => $value) {				  
					  $c++;
					  if($c<1){
						$date = new dateTime($value["fecha"]);
						$format = $date->format('d-m-Y');
						?>
						<h3><?= $strings["Week of Monday "].$format ?></h3>
					<?php }}?>
				<?php if ($_SESSION['semana']-1 == 0) {
					$semanaA = 52;
				  } else{
					$semanaA = $_SESSION['semana']-1;
				  }?>
				<table>
					<thead>
					<tr>
					<th align="left" width=1000>
						<form method="post" action="../Functions/Acceso.php" role="login">
						  <input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
                          <input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
						  <input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
						  <input type="number" name="wk" value="<?= $semanaA ?>" hidden=true>
						  <button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><?= $strings["Anterior Semana"] ?></button>
						</form>
					</th>
						<?php if ($_SESSION['semana']+1 == 53){
						  $semanaN=1;
						}else{
						  $semanaN = $_SESSION['semana']+1;
						}?>
					<th>
						<form method="post" action="../Functions/Acceso.php" role="login">
							<input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
							<input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
							<input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
							<input type="number" name="wk" value="<?= $semanaN ?>" hidden=true>
							<button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><?= $strings["Próxima Semana"] ?></button>
						</form>
					</th>   
					</tr>
				  </thead>
				</table>
				
				<div class="row top-buffer">
				<table class="table">
				  <thead>
					<?php
					$array_date = getDate();
					$date = $_SESSION['fecha'];
					$dia = date('N', strtotime($date));
					if($dia==1){
						$lunes = $date;
						$martes = strtotime( '+1 day' , strtotime( $date ));
						$martes = date ( 'Y-m-j' , $martes );
						$miercoles = strtotime( '+2 day' , strtotime( $date ));
						$miercoles = date ( 'Y-m-j' , $miercoles );
						$jueves = strtotime( '+3 day' , strtotime( $date ));
						$jueves = date ( 'Y-m-j' , $jueves );
						$viernes = strtotime( '+4 day' , strtotime( $date ));
						$viernes = date ( 'Y-m-j' , $viernes );
						$sabado = strtotime( '+5 day' , strtotime( $date ));
						$sabado = date ( 'Y-m-j' , $sabado );
						$domingo = strtotime( '+6 day' , strtotime( $date ));
						$domingo = date ( 'Y-m-j' , $domingo );
					}else{
						if($dia==2){
							$lunes = strtotime( '-1 day' , strtotime( $date ));
							$martes = $date;
							$miercoles = strtotime( '+1 day' , strtotime( $date ));
							$jueves = strtotime( '+2 day' , strtotime( $date ));
							$viernes = strtotime( '+3 day' , strtotime( $date ));
							$sabado = strtotime( '+4 day' , strtotime( $date ));
							$domingo = strtotime( '+5 day' , strtotime( $date ));
						}else{
							if($dia==3){
								$lunes = strtotime( '-2 day' , strtotime( $date ));
								$martes = strtotime( '-1 day' , strtotime( $date ));
								$miercoles = $date;
								$jueves = strtotime( '+1 day' , strtotime( $date ));
								$viernes = strtotime( '+2 day' , strtotime( $date ));
								$sabado = strtotime( '+3 day' , strtotime( $date ));
								$domingo = strtotime( '+4 day' , strtotime( $date ));
							}else{
								if($dia==4){
									$lunes = strtotime( '-3 day' , strtotime( $date ));
									$martes = strtotime( '-2 day' , strtotime( $date ));
									$miercoles = strtotime( '-1 day' , strtotime( $date ));
									$jueves = $date;
									$viernes = strtotime( '+1 day' , strtotime( $date ));
									$sabado = strtotime( '+2 day' , strtotime( $date ));
									$domingo = strtotime( '+3 day' , strtotime( $date ));
								}else{
									if($dia==5){
										$lunes = strtotime( '-4 day' , strtotime( $date ));
										$martes = strtotime( '-3 day' , strtotime( $date ));
										$miercoles = strtotime( '-2 day' , strtotime( $date ));
										$jueves = strtotime( '-1 day' , strtotime( $date ));
										$viernes = $date;
										$sabado = strtotime( '+1 day' , strtotime( $date ));
										$domingo = strtotime( '+2 day' , strtotime( $date ));
									}else{
										if($dia==6){
											$lunes = strtotime( '-5 day' , strtotime( $date ));
											$martes = strtotime( '-4 day' , strtotime( $date ));
											$miercoles = strtotime( '-3 day' , strtotime( $date ));
											$jueves = strtotime( '-2 day' , strtotime( $date ));
											$viernes = strtotime( '-1 day' , strtotime( $date ));
											$sabado = $date;
											$domingo = strtotime( '+1 day' , strtotime( $date ));
										}else{
											if($dia==7){
												$lunes = strtotime( '-6 day' , strtotime( $date ));
												$lunes = date ( 'Y-m-j' , $lunes );
												$martes = strtotime( '-5 day' , strtotime( $date ));
												$martes = date ( 'Y-m-j' , $martes );
												$miercoles = strtotime( '-4 day' , strtotime( $date ));
												$miercoles = date ( 'Y-m-j' , $miercoles );
												$jueves = strtotime( '-3 day' , strtotime( $date ));
												$jueves = date ( 'Y-m-j' , $jueves );
												$viernes = strtotime( '-2 day' , strtotime( $date ));
												$viernes = date ( 'Y-m-j' , $viernes );
												$sabado = strtotime( '-1 day' , strtotime( $date ));
												$sabado = date ( 'Y-m-j' , $sabado );
												$domingo = $date;
											}
										}
									}
								}
							}
						}
					}
					?>
					<tr>
					  <th><?= $lunes ?></th>
					  <th><?= $martes ?></th>
					  <th><?= $miercoles ?></th>
					  <th><?= $jueves ?></th>
					  <th><?= $viernes ?></th>
					  <th><?= $sabado ?></th>
					  <th><?= $domingo ?></th>
					</tr>
					<tr>
					  <th><?= $strings['Monday'] ?></th>
					  <th><?= $strings['Tuesday'] ?></th>
					  <th><?= $strings['Wednesday'] ?></th>
					  <th><?= $strings['Thursday'] ?></th>
					  <th><?= $strings['Friday'] ?></th>
					  <th><?= $strings['Saturday'] ?></th>
					  <th><?= $strings['Sunday'] ?></th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td width=50 bgcolor=#C0C0C0>
					  <?php foreach ($_SESSION['Lunes'] as $day => $value) {?>
								<b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>
										<div style="color: blue;">
											<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
							  <?php } else { ?>
										<div style="color: orange;">
											<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>
										</div>	
							  <?php } ?>						  
							  <hr>
						  <?php }?>
						</td>
						<td width=50>
						  <?php foreach ($_SESSION['Martes'] as $day => $value) {?>
								<b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<div style="color: blue;">
											<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
							  <?php } else { ?>
										<div style="color: orange;">
											<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>
										</div>										
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50 bgcolor=#C0C0C0>
						  <?php foreach ($_SESSION['Miercoles'] as $day => $value) {?>
							  <b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
										<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>										
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50>
						  <?php foreach ($_SESSION['Jueves'] as $day => $value) {?>
							  <b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
										<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50 bgcolor=#C0C0C0>
						  <?php foreach ($_SESSION['Viernes'] as $day => $value) {?>
							  <b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
										<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50>
						  <?php foreach ($_SESSION['Sabado'] as $day => $value) {?>
							  <b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
										<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50 bgcolor=#C0C0C0>
						  <?php foreach ($_SESSION['Domingo'] as $day => $value) {?>
							  <b><li><?php echo $value["fecha"] ?></li></b>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){?>							
										<li><a><?php echo $value["nombreAsignatura"]."\n" ?></a></li>
										<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
					  </tr>
				  </tbody>
				</table>
				</div>
				</div>

		<?php
		include_once '../Views/footer.php';
?>