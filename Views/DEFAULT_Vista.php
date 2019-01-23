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
			<?php
			if(ConsultarTipoUsuarioLogin()==2){
			?>
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
				  }
				  $contE = $_SESSION['contador']-1;
				  ?>
				  
				<div class="row top-buffer">
				<table>
					<thead>
					<tr>
					<th align="left" width=450>
						<form method="post" action="../Functions/Acceso.php" role="login">
						  <input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
                          <input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
						  <input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
						  <input type="number" name="wk" value="<?= $semanaA ?>" hidden=true>
						  <input type="number" name="contador" value="<?= $contE ?>" hidden=true>
						  <input type="number" name="curso" value=0 hidden=true>
						  <button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><?= $strings["Anterior Semana"] ?></button>
						</form>
					</th>
					<th width=500>
						<form method="post" action="../Functions/Acceso.php" role="login">
							<input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
							<input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
							<input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
							<input type="number" name="wk" value="<?= $_SESSION['semana'] ?>" hidden=true>
							<input type="number" name="contador" value="<?= $_SESSION['contador'] ?>" hidden=true>
							<select name="curso">
								<option value=-1></option>
								<?php
								foreach($_SESSION['misCursos'] as $curso){
									?><option value="<?php echo $curso['idCurso'] ?>"><?php echo $curso['nombreCurso']; ?></option><?php
								}
								?>
							</select>
							<button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><?= $strings["Filtrar"] ?></button>
						</form>
					</th>
						<?php if ($_SESSION['semana']+1 == 53){
						  $semanaN=1;
						}else{
						  $semanaN = $_SESSION['semana']+1;
						}
						$contA = $_SESSION['contador']+1;
						?>
					<th>
						<form method="post" action="../Functions/Acceso.php" role="login">
							<input type="text" name="username" value="<?= $_SESSION['login'] ?>" hidden=true>
							<input type="password" name="password" value="<?= $_SESSION['pass'] ?>" hidden=true>
							<input type="text" name="IDIOMA" value="<?= $_SESSION['IDIOMA'] ?>" hidden=true>
							<input type="number" name="wk" value="<?= $semanaN ?>" hidden=true>
							<input type="number" name="contador" value="<?= $contA ?>" hidden=true>
							<input type="number" name="curso" value=0 hidden=true>
							<button type="submit" name="accion" class="btn btn-lg btn-primary" value="Login"><?= $strings["Próxima Semana"] ?></button>
						</form>
					</th>   
					</tr>
				  </thead>
				</table>
				</div>
				
				<div class="row top-buffer">
				<table class="table">
				  <thead>
					<?php
					$array_date = getDate();
					$date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
					$dia = date('N', strtotime($date));
					$cont = $_SESSION['contador'];
					
					if($cont < 0){
						$dias = $cont * 7;
						$string = (string)$dias;
						$stringOK = $string . ' day';
						$date = date('Y-m-d', strtotime( $stringOK , strtotime($date) ));
					}else{
						if($cont > 0){
							$dias = $cont * 7;
							$string = (string)$dias;
							$stringOK = '+' . $string . ' day';
							$date = date('Y-m-d', strtotime( $stringOK , strtotime($date) ));
						}
					}
				
					if($dia==1){
						$lunes = $date;
						$martes = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
						$miercoles = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
						$jueves = date('Y-m-d', strtotime( '+3 day' , strtotime($date) ));
						$viernes = date('Y-m-d', strtotime( '+4 day' , strtotime($date) ));
						$sabado = date('Y-m-d', strtotime( '+5 day' , strtotime($date) ));
						$domingo = date('Y-m-d', strtotime( '+6 day' , strtotime($date) ));
					}else{
						if($dia==2){					
							$lunes = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
							$martes = $date;
							$miercoles = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
							$jueves = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
							$viernes = date('Y-m-d', strtotime( '+3 day' , strtotime($date) ));
							$sabado = date('Y-m-d', strtotime( '+4 day' , strtotime($date) ));
							$domingo = date('Y-m-d', strtotime( '+5 day' , strtotime($date) ));
						}else{
							if($dia==3){					
								$lunes = date('Y-m-d', strtotime( '-2 day' , strtotime($date) ));
								$martes = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
								$miercoles = $date;
								$jueves = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
								$viernes = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
								$sabado = date('Y-m-d', strtotime( '+3 day' , strtotime($date) ));
								$domingo = date('Y-m-d', strtotime( '+4 day' , strtotime($date) ));
							}else{
								if($dia==4){
									$lunes = date('Y-m-d', strtotime( '-3 day' , strtotime($date) ));
									$martes = date('Y-m-d', strtotime( '-2 day' , strtotime($date) ));
									$miercoles = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
									$jueves = $date;
									$viernes = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
									$sabado = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
									$domingo = date('Y-m-d', strtotime( '+3 day' , strtotime($date) ));
								}else{
									if($dia==5){
										$lunes = date('Y-m-d', strtotime( '-4 day' , strtotime($date) ));
										$martes = date('Y-m-d', strtotime( '-3 day' , strtotime($date) ));
										$miercoles = date('Y-m-d', strtotime( '-2 day' , strtotime($date) ));
										$jueves = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
										$viernes = $date;
										$sabado = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
										$domingo = date('Y-m-d', strtotime( '+2 day' , strtotime($date) ));
									}else{
										if($dia==6){
											$lunes = date('Y-m-d', strtotime( '-5 day' , strtotime($date) ));
											$martes = date('Y-m-d', strtotime( '-4 day' , strtotime($date) ));
											$miercoles = date('Y-m-d', strtotime( '-3 day' , strtotime($date) ));
											$jueves = date('Y-m-d', strtotime( '-2 day' , strtotime($date) ));
											$viernes = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
											$sabado = $date;
											$domingo = date('Y-m-d', strtotime( '+1 day' , strtotime($date) ));
										}else{
											if($dia==7){											
												$lunes = date('Y-m-d', strtotime( '-6 day' , strtotime($date) ));
												$martes = date('Y-m-d', strtotime( '-5 day' , strtotime($date) ));
												$miercoles = date('Y-m-d', strtotime( '-4 day' , strtotime($date) ));
												$jueves = date('Y-m-d', strtotime( '-3 day' , strtotime($date) ));
												$viernes = date('Y-m-d', strtotime( '-2 day' , strtotime($date) ));
												$sabado = date('Y-m-d', strtotime( '-1 day' , strtotime($date) ));
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
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							  <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='../Controllers/ALERTA_Controller.php?idCalendarioHoras=<?php echo $value["idCalendarioHoras"] . '&accion=' . $strings['Añadir']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
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
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
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
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>										
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50>
						  <?php foreach ($_SESSION['Jueves'] as $day => $value) {?>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50 bgcolor=#C0C0C0>
						  <?php foreach ($_SESSION['Viernes'] as $day => $value) {?>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50>
						  <?php foreach ($_SESSION['Sabado'] as $day => $value) {?>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
							  <?php } else { ?>
										<li><a href='../Controllers/ALERTA_Controller.php?idAlerta=<?php echo $value["idAlerta"] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $value["asuntoAlerta"] ?></font></a></li>									
							  <?php } ?>							  
							  <hr>
						  <?php }?>
						</td>
						<td width=50 bgcolor=#C0C0C0>
						  <?php foreach ($_SESSION['Domingo'] as $day => $value) {?>
								<li><?php echo $value["horaInicio"]." - ".$value["horaFin"] ?></li>
							   <?php if($value["nombreAsignatura"]){
										if($value["asuntoEntrega"]){?>
										<div style="color: blue;">
											<li><b><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $value["asuntoEntrega"]."\n" ?></a></b></li>
											<li><a><?php echo $value["nombreCurso"]."\n" ?></a></li>
										</div>
										<?php } ?>
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
			}
		include_once '../Views/footer.php';
?>