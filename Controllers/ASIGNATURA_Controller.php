<?php
//Controlador para la gestión de asignaturas
include '../Models/ASIGNATURA_Model.php';
include '../Views/MENSAJE_Vista.php';



if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';


$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

function get_data_form()
{
	if( isset($_REQUEST['idAsignatura']) )
	{
		$idAsignatura =$_REQUEST['idAsignatura'];
	}else{ 
		$idAsignatura = ""; 
	}
	
	if( isset($_REQUEST['nombreAsignatura']) )
	{
		$nombreAsignatura = $_REQUEST['nombreAsignatura'];
	}else{
		$nombreAsignatura = "";
	}
	
	$asignatura = new ASIGNATURA_Model( $idAsignatura, $nombreAsignatura);
	return $asignatura;
}

if ( !isset($_REQUEST['accion']) )
{
    $_REQUEST['accion'] = '';
}

switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    
	case 'vistainsertar':
		if (!tienePermisos('ASIGNATURA_ADD')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				require_once '../Views/ASIGNATURA_ADD_Vista.php';
				$datos = "";
				new ASIGNATURA_ADD($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
	break;
	
	case 'insertar':
		if (!tienePermisos('ASIGNATURA_ADD')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				$asignatura = get_data_form();
				$asignatura->Insertar();
				echo '<script> location.replace("../Controllers/ASIGNATURA_Controller.php"); </script>';
				exit(0);
		}
    break;
	
	case 'vistaeliminar':
		if (!tienePermisos('ASIGNATURA_DELETE')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
					$asignatura = get_data_form();
					$datos = $asignatura->Ver( $_REQUEST['id'] );
					require_once '../Views/ASIGNATURA_DELETE_Vista.php';
					new ASIGNATURA_DELETE($datos, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;

    case 'eliminar':
		if (!tienePermisos('ASIGNATURA_DELETE')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
					$asignatura = get_data_form();
					$asignatura->Borrar( $_REQUEST['id'] );
					$datos = $asignatura->Listar();
					$tipoUsuario = ConsultarTipoUsuario($_SESSION['login']);
					require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
					new ASIGNATURA_SHOWALL($datos, $tipoUsuario, "../Controllers/ASIGNATURA_Controller.php");
		}
    break;
    
    default: //Por defecto se realiza el show all
      

		if (ConsultarTipoUsuario($_SESSION['login']) != 2) {
			//Carga una vista con todos los cursos al ser administrador
			$asignatura = get_data_form();
			$datos = $asignatura->Listar();
			$tipoUsuario = ConsultarTipoUsuarioLogin();
		
			if (!tienePermisos('ASIGNATURA_SHOWALL')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
				new ASIGNATURA_SHOWALL($datos, $tipoUsuario,  '../Views/ASIGNATURA_SHOWALL_Vista.php');
			}
        } else {
            //Si no, cargaría una vista exactamente igual pero solo vería sus cursos
			$asignatura = get_data_form();
			$asignaturas = $asignatura->ListarAsignaturasUsuario();
			$guias = extraerAsignaturasGuia();
			$tipoUsuario = ConsultarTipoUsuarioLogin();
			$i=0;
			foreach($asignaturas as $asignatura){
				foreach($guias as $guia){
					if (strpos($guia[0], 'Dereito constitucional II') !== false) {
						$asig = "Dereito constitucional II";
					}else{
						if (strpos($guia[0], 'Dereito continental e dereito') !== false) {
							$asig = "Sistemas xurídicos contemporáneos: Dereito continental e dereito anglosaxón";
						}else{
							if (strpos($guia[0], 'Principios de eco') !== false) {
								$asig = "Principios de economía";
							}else{
								if (strpos($guia[0], 'Fundamentos de contabilidade e finanzas') !== false) {
									$asig = "Fundamentos de contabilidade e finanzas";
								}else{
									if (strpos($guia[0], 'Dereito constitucional I') !== false) {
										$asig = "Dereito constitucional I";
									}else{
										if (strpos($guia[0], 'Historia do dereito') !== false) {
											$asig = "Historia do dereito";
										}else{
											if (strpos($guia[0], 'Teor') !== false) {
												$asig = "Teoría do dereito";
											}else{
												if (strpos($guia[0], 'romano') !== false) {
													$asig = "Dereito romano";
												}else{
													if (strpos($guia[0], ' e dereito da persoa') !== false) {
														$asig = "Introdución ao dereito civil e dereito da persoa";
													}else{
														if (strpos($guia[0], 'Dereito civil I. Obrigas e contratos') !== false) {
															$asig = "Dereito civil I. Obrigas e contratos";
														}else{
															if (strpos($guia[0], 'Dereito penal II') !== false) {
																$asig = "Dereito penal II";
															}else{
																if (strpos($guia[0], 'Dereito internacional privado') !== false) {
																	$asig = "Dereito internacional privado";
																}else{
																	if (strpos($guia[0], 'Dereito da Uni') !== false) {
																		$asig = "Dereito da Unión Europea";
																	}else{
																		if (strpos($guia[0], 'Dereito administrativo II') !== false) {
																			$asig = "Dereito administrativo II";
																		}else{
																			if (strpos($guia[0], 'Dereito penal I') !== false) {
																				$asig = "Dereito penal I";
																			}else{
																				if (strpos($guia[0], 'Sistema xudicial es') !== false) {
																					$asig = "Sistema xudicial español e proceso civil";
																				}else{
																					if (strpos($guia[0], 'Dereito civil II. Dereitos reais') !== false) {
																						$asig = "Dereito civil II. Dereitos reais";
																					}else{
																						if (strpos($guia[0], 'Dereito civil III. Familia e') !== false) {
																							$asig = "Dereito civil III. Familia e sucesións";
																						}else{
																							if (strpos($guia[0], 'Dereito mercantil II') !== false) {
																								$asig = "Dereito mercantil II";
																							}else{
																								if (strpos($guia[0], 'Dereito administrativo I') !== false) {
																									$asig = "Dereito administrativo I";
																								}else{
																									if (strpos($guia[0], 'Dereito do traballo e da seguridade social') !== false) {
																										$asig = "Dereito do traballo e da seguridade social";
																									}else{
																										if (strpos($guia[0], 'Dereito procesual penal') !== false) {
																											$asig = "Dereito procesual penal";
																										}else{
																											if (strpos($guia[0], 'Dereito internacional p') !== false) {
																												$asig = "Dereito internacional público";
																											}else{
																												if (strpos($guia[0], 'Dereito financeiro e tributario II') !== false) {
																													$asig = "Dereito financeiro e tributario II";
																												}else{
																													if (strpos($guia[0], 'contenciosa-administrativa e social') !== false) {
																														$asig = "Xurisdicións contenciosa-administrativa e social";
																													}else{
																														if (strpos($guia[0], 'Dereito financeiro e tributario I') !== false) {
																															$asig = "Dereito financeiro e tributario I";
																														}else{
																															if (strpos($guia[0], 'Dereito mercantil I') !== false) {
																																$asig = "Dereito mercantil I";
																															}else{
																																if (strpos($guia[0], 'Dereito mercantil europeo') !== false) {
																																	$asig = "Dereito mercantil europeo";
																																}else{
																																	if (strpos($guia[0], 'Libre circulaci') !== false) {
																																		$asig = "Libre circulación de traballadores e políticas sociais europeas";
																																	}else{
																																		if (strpos($guia[0], ' e medio ambiente') !== false) {
																																			$asig = "Unión Europea, constitución e medio ambiente";
																																		}else{
																																			if (strpos($guia[0], 'Argumentaci') !== false) {
																																				$asig = "Argumentación e interpretación xurídica";
																																			}else{
																																				if (strpos($guia[0], 'Novas tecno') !== false) {
																																					$asig = "Novas tecnoloxías aplicadas ao dereito";
																																				}else{
																																					if (strpos($guia[0], 'Dereito de defensa da competencia') !== false) {
																																						$asig = "Dereito de defensa da competencia";
																																					}else{
																																						if (strpos($guia[0], 'Procesos especiais e ') !== false) {
																																							$asig = "Procesos especiais e métodos alternativos de solución de conflitos";
																																						}else{
																																							if (strpos($guia[0], 'Dereito tributario da Uni') !== false) {
																																								$asig = "Dereito tributario da Unión Europea e internacional";
																																							}else{
																																								if (strpos($guia[0], 'Litigaci') !== false) {
																																									$asig = "Litigación internacional e sostibilidade";
																																								}else{
																																									if (strpos($guia[0], 'Dereito penal e procesual de menores') !== false) {
																																										$asig = "Dereito penal e procesual de menores";
																																									}else{
																																										if (strpos($guia[0], 'Criminolox') !== false) {
																																											$asig = "Criminoloxía e dereito penitenciario";
																																										}else{
																																											if (strpos($guia[0], 'Dereito de danos e responsabilidade civil') !== false) {
																																												$asig = "Dereito de danos e responsabilidade civil";
																																											}else{
																																												if (strpos($guia[0], 'ticas externas') !== false) {
																																													$asig = "Prácticas externas";
																																												}else{
																																													if (strpos($guia[0], 'Traballo de Fin de Grao') !== false) {
																																														$asig = "Traballo de Fin de Grao";
																																													}
																																												}
																																											}
																																										}
																																									}
																																								}
																																							}
																																						}
																																					}
																																				}
																																			}
																																		}
																																	}
																																}
																															}
																														}
																													}
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
					if($asignatura[1]===$asig){
						$asignatura['href'] = $guia[1];
						$datos[$i] = $asignatura;
						$i++;
					}
				}
			}
		
			if (!tienePermisos('ASIGNATURA_SHOWALL')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				require_once '../Views/ASIGNATURA_SHOWALL_Vista.php';
				new ASIGNATURA_SHOWALL($datos, $tipoUsuario,  '../Views/ASIGNATURA_SHOWALL_Vista.php');
			}
        }
}


?>