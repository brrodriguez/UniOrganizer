<?php

//Controlador para la gestión de cursos
include '../Models/CURSO_Model.php';
include '../Models/ASIGNATURA_Model.php';
include '../Views/MENSAJE_Vista.php';
include_once '../Functions/LibraryFunctions.php';

if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Views/header.php';
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';


$pags = generarIncludes(); //Realizamos los includes de las páginas a las que tiene acceso
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

function get_data_form() {
	if (isset($_REQUEST['idCurso'])) {
        $idCurso = $_REQUEST['idCurso'];
    } else {
        $idCurso = "";
    }
	
    if (isset($_REQUEST['nombreCurso'])) {
        $nombreCurso = $_REQUEST['nombreCurso'];
    } else {
        $nombreCurso = "";
    }

    if (isset($_REQUEST['descripcionCurso'])) {
        $descripcionCurso = $_REQUEST['descripcionCurso'];
    } else {
        $descripcionCurso = "";
    }

    if (isset($_REQUEST['idCalendario'])) {
        $idCalendario = $_REQUEST['idCalendario'];
    } else {
        $idCalendario = "";
    }

    $curso = new CURSO_Model($idCurso, $nombreCurso, $descripcionCurso, $idCalendario);
    return $curso;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

switch ($_REQUEST['accion']) { //Actúa según la acción elegida
    case 'vistainsertar':
      
        if (!tienePermisos('CURSO_ADD')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			$idCalendario = ObtenerCalendario($_SESSION['login']);
            require_once '../Views/CURSO_ADD_Vista.php';
            $datos = "";
            new CURSO_ADD($datos, '../Controllers/CURSO_Controller.php', $idCalendario );
        }
        break;
		
	case 'vistafiltrar':
      
        if (!tienePermisos('CURSO_FILTER')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
				require_once '../Views/CURSO_FILTER_Vista.php';
				new CURSO_FILTER('../Controllers/CURSO_Controller.php');
        }
        break;
		
	case 'filtrar':
      
        if (!tienePermisos('CURSO_FILTER')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			//Carga una vista con todos los cursos al ser administrador
			$curso = new CURSO_Model("", "", "", "");
			$datos = $curso->filtrar($_REQUEST['username']);

			require_once '../Views/CURSO_SHOWALL_Vista.php';
			new CURSO_SHOWALL($datos, '../Controllers/CURSO_Controller.php');
        }
        break;
		
	case 'vistaimportar':
      
        if (!tienePermisos('CURSO_IMPORT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {

			$idCalendario = ObtenerCalendario($_SESSION['login']);
            require_once '../Views/CURSO_IMPORT_Vista.php';
			$asignaturas['selectasignaturas'] = "";
			$seleccionadas[] = ""; 
			$datos['asignaturas'] = extraerAsignaturas();
			foreach ($datos['asignaturas'] as &$valor) {
				$asignaturas['selectasignaturas'] .= "<option>" . $valor . "</option>";//Se crea un <option> para cada asignatura extraida
			}
            new CURSO_IMPORT($asignaturas, $seleccionadas, '../Controllers/CURSO_Controller.php', $idCalendario );
        }
        break;	
		
	case 'importar':

        if (!tienePermisos('CURSO_IMPORT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
			if($_REQUEST['curso'] === "0") {	
				new Mensaje('No se importó correctamente porque no se seleccionó ningún curso', '../Views/DEFAULT_Vista.php');
			}else{
				if($_REQUEST['curso'] === "1") {
					$curso = get_data_form();
					$respuesta = $curso->insertarCurso();
					$idCurso = obtenerUltimoCurso();
					$primero = extraerCursos(1);
					$entregas1 = extraerEntregasPrimero();
					foreach ($primero as $key => $value) {
							if (strpos($value, 'Dereito constitucional II') !== false) {
								$asig = "Dereito constitucional II";
							}else{
								if (strpos($value, 'Novas tecno') !== false) {
									$asig = "Novas tecnoloxías aplicadas ao dereito";
								}else{
									if (strpos($value, 'Principios de eco') !== false) {
										$asig = "Principios de economía";
									}else{
										if (strpos($value, 'Fundamentos de contabilidade e finanzas') !== false) {
											$asig = "Fundamentos de contabilidade e finanzas";
										}else{
											if (strpos($value, 'Dereito constitucional I') !== false) {
												$asig = "Dereito constitucional I";
											}else{
												if (strpos($value, 'Historia do dereito') !== false) {
													$asig = "Historia do dereito";
												}else{
													if (strpos($value, 'Teor') !== false) {
														$asig = "Teoría do dereito";
													}else{
														if (strpos($value, 'romano') !== false) {
															$asig = "Dereito romano";
														}else{
															if (strpos($value, 'civil') !== false) {
																$asig = "Introdución ao dereito civil e dereito da persoa";
															}else{
																$asig = $value;
															}
														}
													}
												}
											}
										}
									}
								}
							}
						if(!(obtenerIdAsignatura($asig))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
							$asignatura = new ASIGNATURA_Model("", $asig, "");
							$asignatura->Insertar();
						}
						$idAsignatura = obtenerIdAsignatura($asig);
						$curso->asignarAsignatura($idCurso, $idAsignatura);
						foreach($entregas1 as $entrega){					
							if (strpos($entrega[0], 'Dereito Constitucional I.') !== false) {
								$datos[0] = "Dereito constitucional I";
							}else{
								if (strpos($entrega[0], 'Nuevas Tecno') !== false) {
									$datos[0] = "Novas tecnoloxías aplicadas ao dereito";
								}else{
									if (strpos($entrega[0], 'PRINCIPIOS DE') !== false) {
										$datos[0] = "Principios de economía";
									}else{
										if (strpos($entrega[0], 'FUNDAMENTOS DE CONTABILIDADE E FINANZAS') !== false) {
											$datos[0] = "Fundamentos de contabilidade e finanzas";
										}else{
											if (strpos($entrega[0], 'DEREITO CONSTITUCIONAL II') !== false) {
												$datos[0] = "Dereito constitucional II";
											}else{
												if (strpos($entrega[0], 'HISTORIA DO DEREITO.') !== false) {
													$datos[0] = "Historia do dereito";
												}else{
													if (strpos($entrega[0], 'Teor') !== false) {
														$datos[0] = "Teoría do dereito";
													}else{
														if (strpos($entrega[0], 'romano') !== false) {
															$datos[0] = "Dereito romano";
														}else{
															if (strpos($entrega[0], 'civil') !== false) {
																$datos[0] = "Introdución ao dereito civil e dereito da persoa";
															}else{
																$datos[0] = $entrega[0];
															}
														}
													}
												}
											}
										}
									}
								}
							}
							$idAsig = obtenerIdAsignatura($datos[0]);
							if($idAsignatura===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
								//$datos1 = preg_split('/T/', $entrega[1]);
								$fecha = $entrega[1]->format('Y-m-d H:i:s');
								$curso->crearEntregas($idCurso, $idAsignatura, $entrega[0], $fecha);
							}								
						}
					}
				}else{			
					if($_REQUEST['curso'] === "2") {
						$curso = get_data_form();
						$respuesta = $curso->insertarCurso();
						$idCurso = obtenerUltimoCurso();
						$segundo = extraerCursos(2);
						$entregas2 = extraerEntregasSegundo();
						foreach ($segundo as $key => $value) {
							if (strpos($value, 'Dereito civil I. Obrigas e contratos') !== false) {
								$asig = "Dereito civil I. Obrigas e contratos";
							}else{
								if (strpos($value, 'Dereito penal I') !== false) {
									$asig = "Dereito penal I";
								}else{
									if (strpos($value, 'Dereito internacional p') !== false) {
										$asig = "Dereito internacional público";
									}else{
										if (strpos($value, 'Dereito da Uni') !== false) {
											$asig = "Dereito da Unión Europea";
										}else{
											if (strpos($value, 'Dereito administrativo I') !== false) {
												$asig = "Dereito administrativo I";
											}else{
												if (strpos($value, 'Dereito penal II') !== false) {
													$asig = "Dereito penal II";
												}else{
													if (strpos($value, 'Sistema xudicial es') !== false) {
														$asig = "Sistema xudicial español e proceso civil";
													}else{
														if (strpos($value, 'Dereito civil II. Dereitos reais') !== false) {
															$asig = "Dereito civil II. Dereitos reais";
														}else{
															$asig = $value;
														}
													}
												}
											}
										}
									}
								}
							}
							if(!(obtenerIdAsignatura($asig))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
								$asignatura = new ASIGNATURA_Model("", $asig, "");
								$asignatura->Insertar();
							}
							$idAsignatura = obtenerIdAsignatura($asig);
							$curso->asignarAsignatura($idCurso, $idAsignatura);
							foreach($entregas2 as $entrega){					
								if (strpos($entrega[0], 'Dereito civil I.') !== false) {
									$datos[0] = "Dereito civil I. Obrigas e contratos";
								}else{
									if (strpos($entrega[0], 'Dereito penal I') !== false) {
										$datos[0] = "Dereito penal I";
									}else{
										if (strpos($entrega[0], 'Dereito internacional p') !== false) {
											$datos[0] = "Dereito internacional público";
										}else{
											if (strpos($entrega[0], 'Dereito da Uni') !== false) {
												$datos[0] = "Dereito da Unión Europea";
											}else{
												if (strpos($entrega[0], 'Dereito administrativo I') !== false) {
													$datos[0] = "Dereito administrativo I";
												}else{
													if (strpos($entrega[0], 'Dereito penal II') !== false) {
														$datos[0] = "Dereito penal II";
													}else{
														if (strpos($entrega[0], 'Sistema xudicial') !== false) {
															$datos[0] = "Sistema xudicial español e proceso civil";
														}else{
															if (strpos($entrega[0], 'Dereito civil II') !== false) {
																$datos[0] = "Dereito civil II. Dereitos reais";
															}else{
																$datos[0] = $entrega[0];
															}
														}
													}
												}
											}
										}
									}
								}
								$idAsig = obtenerIdAsignatura($datos[0]);
								if($idAsignatura===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
									$fecha = $entrega[1]->format('Y-m-d H:i:s');
									$curso->crearEntregas($idCurso, $idAsignatura, $entrega[0], $fecha);
								}								
							}						
						}
					}else{
						if($_REQUEST['curso'] === "3") {
							$curso = get_data_form();
							$respuesta = $curso->insertarCurso();
							$idCurso = obtenerUltimoCurso();
							$tercero = extraerCursos(3);
							$entregas3 = extraerEntregasTercero();
							foreach ($tercero as $key => $value) {
								if (strpos($value, 'Dereito civil III. Familia e') !== false) {
									$asig = "Dereito civil III. Familia e sucesións";
								}else{
									if (strpos($value, 'Dereito mercantil I') !== false) {
										$asig = "Dereito mercantil I";
									}else{
										if (strpos($value, 'Dereito administrativo II') !== false) {
											$asig = "Dereito administrativo II";
										}else{
											if (strpos($value, 'Dereito do traballo e da seguridade social') !== false) {
												$asig = "Dereito do traballo e da seguridade social";
											}else{
												if (strpos($value, 'Dereito procesual penal') !== false) {
													$asig = "Dereito procesual penal";
												}else{
													if (strpos($value, 'Dereito internacional privado') !== false) {
														$asig = "Dereito internacional privado";
													}else{
														if (strpos($value, 'Dereito financeiro e tributario I') !== false) {
															$asig = "Dereito financeiro e tributario I";
														}else{
															if (strpos($value, 'contenciosa-administrativa e social') !== false) {
																$asig = "Xurisdicións contenciosa-administrativa e social";
															}else{
																$asig = $value;
															}
														}
													}
												}
											}
										}
									}
								}
								if(!(obtenerIdAsignatura($asig))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
									$asignatura = new ASIGNATURA_Model("", $asig, "");
									$asignatura->Insertar();
								}
								$idAsignatura = obtenerIdAsignatura($asig);
								$curso->asignarAsignatura($idCurso, $idAsignatura);
								foreach($entregas3 as $entrega){					
									if (strpos($entrega[0], 'Dereito Civil III.') !== false) {
										$datos[0] = "Dereito civil III. Familia e sucesións";
									}else{
										if (strpos($entrega[0], 'Dereito Mercantil I.') !== false) {
											$datos[0] = "Dereito mercantil I";
										}else{
											if (strpos($entrega[0], 'Dereito Administrativo II') !== false) {
												$datos[0] = "Dereito administrativo II";
											}else{
												if (strpos($entrega[0], ' SS') !== false) {
													$datos[0] = "Dereito do traballo e da seguridade social";
												}else{
													if (strpos($entrega[0], 'Dereito Procesual Penal') !== false or strpos($entrega[0], 'Dereito procesual penal') !== false) {
														$datos[0] = "Dereito procesual penal";
													}else{
														if (strpos($entrega[0], 'Dereito Internacional Privado') !== false) {
															$datos[0] = "Dereito internacional privado";
														}else{
															if (strpos($entrega[0], 'Dereito Financeiro e Tributario') !== false) {
																$datos[0] = "Dereito financeiro e tributario I";
															}else{
																if (strpos($entrega[0], 'contenciosa-administrativa e social') !== false) {
																	$datos[0] = "Xurisdicións contenciosa-administrativa e social";
																}else{
																	$datos[0] = $entrega[0];
																}
															}
														}
													}
												}
											}
										}
									}
									$idAsig = obtenerIdAsignatura($datos[0]);
									if($idAsignatura===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
										$fecha = $entrega[1]->format('Y-m-d H:i:s');
										$curso->crearEntregas($idCurso, $idAsignatura, $entrega[0], $fecha);
									}								
								}
							}
						}else{
							if($_REQUEST['curso'] === "4") {
								$curso = get_data_form();
								$respuesta = $curso->insertarCurso();
								$idCurso = obtenerUltimoCurso();
								$cuarto = extraerCursos(4);
								$entregas4 = extraerEntregasCuarto();
								foreach ($cuarto as $key => $value) {
									if (strpos($value, 'Dereito financeiro e tributario II') !== false) {
										$asig = "Dereito financeiro e tributario II";
									}else{
										if (strpos($value, 'Dereito mercantil II') !== false) {
											$asig = "Dereito mercantil II";
										}else{
											if (strpos($value, 'Dereito mercantil europeo') !== false) {
												$asig = "Dereito mercantil europeo";
											}else{
												if (strpos($value, 'Libre circulaci') !== false) {
													$asig = "Libre circulación de traballadores e políticas sociais europeas";
												}else{
													if (strpos($value, ' e medio ambiente') !== false) {
														$asig = "Unión Europea, constitución e medio ambiente";
													}else{
														if (strpos($value, 'Argumentaci') !== false) {
															$asig = "Argumentación e interpretación xurídica";
														}else{
															if (strpos($value, 'Sistemas xur') !== false) {
																$asig = "Sistemas xurídicos contemporáneos: Dereito continental e dereito anglosaxón";
															}else{
																if (strpos($value, 'Dereito de defensa da competencia') !== false) {
																	$asig = "Dereito de defensa da competencia";
																}else{
																	if (strpos($value, 'Procesos especiais e ') !== false) {
																		$asig = "Procesos especiais e métodos alternativos de solución de conflitos";
																	}else{
																		if (strpos($value, 'Dereito tributario da Uni') !== false) {
																			$asig = "Dereito tributario da Unión Europea e internacional";
																		}else{
																			if (strpos($value, 'Litigaci') !== false) {
																				$asig = "Litigación internacional e sostibilidade";
																			}else{
																				if (strpos($value, 'Dereito penal e procesual de menores') !== false) {
																					$asig = "Dereito penal e procesual de menores";
																				}else{
																					if (strpos($value, 'Criminolox') !== false) {
																						$asig = "Criminoloxía e dereito penitenciario";
																					}else{
																						if (strpos($value, 'Dereito de danos e responsabilidade civil') !== false) {
																							$asig = "Dereito de danos e responsabilidade civil";
																						}else{
																							if (strpos($value, 'ticas externas') !== false) {
																								$asig = "Prácticas externas";
																							}else{
																								if (strpos($value, 'Traballo de Fin de Grao') !== false) {
																									$asig = "Traballo de Fin de Grao";
																								}else{
																									$asig = $value;
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
									if(!(obtenerIdAsignatura($asig))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
										$asignatura = new ASIGNATURA_Model("", $asig, "");
										$asignatura->Insertar();
									}
									$idAsignatura = obtenerIdAsignatura($asig);
									$curso->asignarAsignatura($idCurso, $idAsignatura);
									foreach($entregas4 as $entrega){
										if (strpos($entrega[0], 'DEREITO FINANCEIRO') !== false) {
											$datos[0] = "Dereito financeiro e tributario II";
										}else{
											if (strpos($entrega[0], 'DEREITO MERCANTIL II') !== false) {
												$datos[0] = "Dereito mercantil II";
											}else{
												if (strpos($entrega[0], 'Dereito mercantil europeo') !== false) {
													$datos[0] = "Dereito mercantil europeo";
												}else{
													if (strpos($entrega[0], 'LIBRE ') !== false) {
														$datos[0] = "Libre circulación de traballadores e políticas sociais europeas";
													}else{
														if (strpos($entrega[0], 'n e medio ambiente') !== false) {
															$datos[0] = "Unión Europea, constitución e medio ambiente";
														}else{
															if (strpos($entrega[0], 'Argumentaci') !== false) {
																$datos[0] = "Argumentación e interpretación xurídica";
															}else{
																if (strpos($entrega[0], 'Sistemas xur') !== false) {
																	$datos[0] = "Sistemas xurídicos contemporáneos: Dereito continental e dereito anglosaxón";
																}else{
																	if (strpos($entrega[0], 'Dereito de defensa da competencia') !== false) {
																		$datos[0] = "Dereito de defensa da competencia";
																	}else{
																		if (strpos($entrega[0], 'PRO. ESP. E') !== false) {
																			$datos[0] = "Procesos especiais e métodos alternativos de solución de conflitos";
																		}else{
																			if (strpos($entrega[0], 'DEREITO TRIBUTARIO DA') !== false) {
																				$datos[0] = "Dereito tributario da Unión Europea e internacional";
																			}else{
																				if (strpos($entrega[0], 'INTERNACIONAL E SOSTIBILIDADE') !== false) {
																					$datos[0] = "Litigación internacional e sostibilidade";
																				}else{
																					if (strpos($entrega[0], 'D. penal e procesual de menores') !== false) {
																						$datos[0] = "Dereito penal e procesual de menores";
																					}else{
																						if (strpos($entrega[0], 'DEREITO PENITENCIARIO') !== false) {
																							$datos[0] = "Criminoloxía e dereito penitenciario";
																						}else{
																							if (strpos($entrega[0], 'Dereito de danos e responsabilidade civil') !== false) {
																								$datos[0] = "Dereito de danos e responsabilidade civil";
																							}else{
																								if (strpos($entrega[0], 'ticas externas') !== false) {
																									$datos[0] = "Prácticas externas";
																								}else{
																									if (strpos($entrega[0], 'Traballo de Fin de Grao') !== false) {
																										$datos[0] = "Traballo de Fin de Grao";
																									}else{
																										$datos[0] = $entrega[0];
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
										$idAsig = obtenerIdAsignatura($datos[0]);
										if($idAsig===$idAsignatura){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
											$fecha = $entrega[1]->format('Y-m-d H:i:s');
											$curso->crearEntregas($idCurso, $idAsignatura, $entrega[0], $fecha);
										}								
									}
								}
							}
						}
					}
				}
			}
            new Mensaje($respuesta, '../Controllers/CURSO_Controller.php');
        }
        break;	

    case 'ver':
        
        if (!tienePermisos('CURSO_SHOW')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $datos['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);

            require_once '../Views/CURSO_SHOW_Vista.php';
            new CURSO_SHOW($datos, '../Controllers/CURSO_Controller.php');
        }
        break;
		
	case 'vistadesasignar':
        
        if (!tienePermisos('CURSO_ASSIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $datos['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);

            require_once '../Views/CURSO_UNASSIGN_Vista.php';
            new CURSO_UNASSIGN($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'vistaasignar':

        if (!tienePermisos('CURSO_ASSIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
		} else {
			require_once '../Views/CURSO_ASSIGN_Vista.php';
			$curso = get_data_form();
			$listaAsignaturas = extraerAsignaturas();
			foreach ($listaAsignaturas as $key => $value) {	
				if (strpos($value, 'Dereito constitucional II') !== false) {
					$asig = "Dereito constitucional II";
				}else{
					if (strpos($value, 'Dereito continental e dereito') !== false) {
						$asig = "Sistemas xurídicos contemporáneos: Dereito continental e dereito anglosaxón";
					}else{
						if (strpos($value, 'Principios de eco') !== false) {
							$asig = "Principios de economía";
						}else{
							if (strpos($value, 'Fundamentos de contabilidade e finanzas') !== false) {
								$asig = "Fundamentos de contabilidade e finanzas";
							}else{
								if (strpos($value, 'Dereito constitucional I') !== false) {
									$asig = "Dereito constitucional I";
								}else{
									if (strpos($value, 'Historia do dereito') !== false) {
										$asig = "Historia do dereito";
									}else{
										if (strpos($value, 'Teor') !== false) {
											$asig = "Teoría do dereito";
										}else{
											if (strpos($value, 'romano') !== false) {
												$asig = "Dereito romano";
											}else{
												if (strpos($value, ' e dereito da persoa') !== false) {
													$asig = "Introdución ao dereito civil e dereito da persoa";
												}else{
													if (strpos($value, 'Dereito civil I. Obrigas e contratos') !== false) {
														$asig = "Dereito civil I. Obrigas e contratos";
													}else{
														if (strpos($value, 'Dereito penal II') !== false) {
															$asig = "Dereito penal II";
														}else{
															if (strpos($value, 'Dereito internacional privado') !== false) {
																$asig = "Dereito internacional privado";
															}else{
																if (strpos($value, 'Dereito da Uni') !== false) {
																	$asig = "Dereito da Unión Europea";
																}else{
																	if (strpos($value, 'Dereito administrativo II') !== false) {
																		$asig = "Dereito administrativo II";
																	}else{
																		if (strpos($value, 'Dereito penal I') !== false) {
																			$asig = "Dereito penal I";
																		}else{
																			if (strpos($value, 'Sistema xudicial es') !== false) {
																				$asig = "Sistema xudicial español e proceso civil";
																			}else{
																				if (strpos($value, 'Dereito civil II. Dereitos reais') !== false) {
																					$asig = "Dereito civil II. Dereitos reais";
																				}else{
																					if (strpos($value, 'Dereito civil III. Familia e') !== false) {
																						$asig = "Dereito civil III. Familia e sucesións";
																					}else{
																						if (strpos($value, 'Dereito mercantil II') !== false) {
																							$asig = "Dereito mercantil II";
																						}else{
																							if (strpos($value, 'Dereito administrativo I') !== false) {
																								$asig = "Dereito administrativo I";
																							}else{
																								if (strpos($value, 'Dereito do traballo e da seguridade social') !== false) {
																									$asig = "Dereito do traballo e da seguridade social";
																								}else{
																									if (strpos($value, 'Dereito procesual penal') !== false) {
																										$asig = "Dereito procesual penal";
																									}else{
																										if (strpos($value, 'Dereito internacional p') !== false) {
																											$asig = "Dereito internacional público";
																										}else{
																											if (strpos($value, 'Dereito financeiro e tributario II') !== false) {
																												$asig = "Dereito financeiro e tributario II";
																											}else{
																												if (strpos($value, 'contenciosa-administrativa e social') !== false) {
																													$asig = "Xurisdicións contenciosa-administrativa e social";
																												}else{
																													if (strpos($value, 'Dereito financeiro e tributario I') !== false) {
																														$asig = "Dereito financeiro e tributario I";
																													}else{
																														if (strpos($value, 'Dereito mercantil I') !== false) {
																															$asig = "Dereito mercantil I";
																														}else{
																															if (strpos($value, 'Dereito mercantil europeo') !== false) {
																																$asig = "Dereito mercantil europeo";
																															}else{
																																if (strpos($value, 'Libre circulaci') !== false) {
																																	$asig = "Libre circulación de traballadores e políticas sociais europeas";
																																}else{
																																	if (strpos($value, ' e medio ambiente') !== false) {
																																		$asig = "Unión Europea, constitución e medio ambiente";
																																	}else{
																																		if (strpos($value, 'Argumentaci') !== false) {
																																			$asig = "Argumentación e interpretación xurídica";
																																		}else{
																																			if (strpos($value, 'Novas tecno') !== false) {
																																				$asig = "Novas tecnoloxías aplicadas ao dereito";
																																			}else{
																																				if (strpos($value, 'Dereito de defensa da competencia') !== false) {
																																					$asig = "Dereito de defensa da competencia";
																																				}else{
																																					if (strpos($value, 'Procesos especiais e ') !== false) {
																																						$asig = "Procesos especiais e métodos alternativos de solución de conflitos";
																																					}else{
																																						if (strpos($value, 'Dereito tributario da Uni') !== false) {
																																							$asig = "Dereito tributario da Unión Europea e internacional";
																																						}else{
																																							if (strpos($value, 'Litigaci') !== false) {
																																								$asig = "Litigación internacional e sostibilidade";
																																							}else{
																																								if (strpos($value, 'Dereito penal e procesual de menores') !== false) {
																																									$asig = "Dereito penal e procesual de menores";
																																								}else{
																																									if (strpos($value, 'Criminolox') !== false) {
																																										$asig = "Criminoloxía e dereito penitenciario";
																																									}else{
																																										if (strpos($value, 'Dereito de danos e responsabilidade civil') !== false) {
																																											$asig = "Dereito de danos e responsabilidade civil";
																																										}else{
																																											if (strpos($value, 'ticas externas') !== false) {
																																												$asig = "Prácticas externas";
																																											}else{
																																												if (strpos($value, 'Traballo de Fin de Grao') !== false) {
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
				if(!(obtenerIdAsignatura($asig))){//Se comprueba si las asignaturas extraídas ya existen en el sistema y si no se crean
					$asignatura = new ASIGNATURA_Model("", $asig, "");
					$asignatura->Insertar();
				}
			}
			$asignatura = new ASIGNATURA_Model("", "", "");
			$asig = $asignatura->Listar();
			$datos['selectasignaturas'] = "";
			foreach ($asig as $valor) {
				$datos['selectasignaturas'] .= "<option value=" . $valor['idAsignatura'] . ">" . $valor['nombreAsignatura'] . "</option>";
			}
            $otros['curso'] = $curso->obtenerCursoDetalle($_REQUEST['id']);
            $otros['asignaturas'] = $curso->obtenerRelacion_CursoAsignaturas($_REQUEST['id']);
        
			new CURSO_ASSIGN( $otros, $datos, '../Controllers/CURSO_Controller.php');
		}
        break;

    case 'asignar':

		$entregas1 = extraerEntregasPrimero();	
		$entregas2 = extraerEntregasSegundo();
		$entregas3 = extraerEntregasTercero();
		$entregas4 = extraerEntregasCuarto();
        //Recorremos todas las filas de 1 en 1
        $asign_data = $_POST;
        $curso = get_data_form();
        $asign_data_formated = array_chunk($asign_data, 1, false);
        foreach ($asign_data_formated as $key => $value) {
            //Una vez tenemos cada seccion del array
            //Guardamos la asignacion en la bd con sus correspondientes datos de forma que
            // Orden del Array
            // 0 - Id de Asignatura
            $respuesta = $curso->asignarAsignatura($_REQUEST['idCurso'], $value[0]);
			foreach($entregas1 as $entrega){					
				if (strpos($entrega[0], 'Dereito Constitucional I.') !== false) {
					$datos[0] = "Dereito constitucional I";
				}else{
					if (strpos($entrega[0], 'Nuevas Tecno') !== false) {
						$datos[0] = "Novas tecnoloxías aplicadas ao dereito";
					}else{
						if (strpos($entrega[0], 'PRINCIPIOS DE') !== false) {
							$datos[0] = "Principios de economía";
						}else{
							if (strpos($entrega[0], 'FUNDAMENTOS DE CONTABILIDADE E FINANZAS') !== false) {
								$datos[0] = "Fundamentos de contabilidade e finanzas";
							}else{
								if (strpos($entrega[0], 'DEREITO CONSTITUCIONAL II') !== false) {
									$datos[0] = "Dereito constitucional II";
								}else{
									if (strpos($entrega[0], 'HISTORIA DO DEREITO.') !== false) {
										$datos[0] = "Historia do dereito";
									}else{
										if (strpos($entrega[0], 'Teor') !== false) {
											$datos[0] = "Teoría do dereito";
										}else{
											if (strpos($entrega[0], 'romano') !== false) {
												$datos[0] = "Dereito romano";
											}else{
												if (strpos($entrega[0], 'civil') !== false) {
													$datos[0] = "Introdución ao dereito civil e dereito da persoa";
												}else{
													$datos[0] = $entrega[0];
												}
											}
										}
									}
								}
							}
						}
					}
				}
				$idAsig = obtenerIdAsignatura($datos[0]);
				if($value[0]===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
					$fecha = $entrega[1]->format('Y-m-d H:i:s');
					$curso->crearEntregas($_REQUEST['idCurso'], $value[0], $entrega[0], $fecha);
				}								
			}

			foreach($entregas2 as $entrega){					
				if (strpos($entrega[0], 'Dereito civil I.') !== false) {
					$datos[0] = "Dereito civil I. Obrigas e contratos";
				}else{
					if (strpos($entrega[0], 'Dereito penal I') !== false) {
						$datos[0] = "Dereito penal I";
					}else{
						if (strpos($entrega[0], 'Dereito internacional p') !== false) {
							$datos[0] = "Dereito internacional público";
						}else{
							if (strpos($entrega[0], 'Dereito da Uni') !== false) {
								$datos[0] = "Dereito da Unión Europea";
							}else{
								if (strpos($entrega[0], 'Dereito administrativo I') !== false) {
									$datos[0] = "Dereito administrativo I";
								}else{
									if (strpos($entrega[0], 'Dereito penal II') !== false) {
										$datos[0] = "Dereito penal II";
									}else{
										if (strpos($entrega[0], 'Sistema xudicial') !== false) {
											$datos[0] = "Sistema xudicial español e proceso civil";
										}else{
											if (strpos($entrega[0], 'Dereito civil II') !== false) {
												$datos[0] = "Dereito civil II. Dereitos reais";
											}else{
												$datos[0] = $entrega[0];
											}
										}
									}
								}
							}
						}
					}
				}
				$idAsig = obtenerIdAsignatura($datos[0]);
				if($value[0]===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
					$fecha = $entrega[1]->format('Y-m-d H:i:s');
					$curso->crearEntregas($_REQUEST['idCurso'], $value[0], $entrega[0], $fecha);
				}								
			}
			
			foreach($entregas3 as $entrega){					
				if (strpos($entrega[0], 'Dereito Civil III.') !== false) {
					$datos[0] = "Dereito civil III. Familia e sucesións";
				}else{
					if (strpos($entrega[0], 'Dereito Mercantil I.') !== false) {
						$datos[0] = "Dereito mercantil I";
					}else{
						if (strpos($entrega[0], 'Dereito Administrativo II') !== false) {
							$datos[0] = "Dereito administrativo II";
						}else{
							if (strpos($entrega[0], ' SS') !== false) {
								$datos[0] = "Dereito do traballo e da seguridade social";
							}else{
								if (strpos($entrega[0], 'Dereito Procesual Penal') !== false or strpos($entrega[0], 'Dereito procesual penal') !== false) {
									$datos[0] = "Dereito procesual penal";
								}else{
									if (strpos($entrega[0], 'Dereito Internacional Privado') !== false) {
										$datos[0] = "Dereito internacional privado";
									}else{
										if (strpos($entrega[0], 'Dereito Financeiro e Tributario') !== false) {
											$datos[0] = "Dereito financeiro e tributario I";
										}else{
											if (strpos($entrega[0], 'contenciosa-administrativa e social') !== false) {
												$datos[0] = "Xurisdicións contenciosa-administrativa e social";
											}else{
												$datos[0] = $entrega[0];
											}
										}
									}
								}
							}
						}
					}
				}
				$idAsig = obtenerIdAsignatura($datos[0]);
				if($value[0]===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
					$fecha = $entrega[1]->format('Y-m-d H:i:s');
					$curso->crearEntregas($_REQUEST['idCurso'], $value[0], $entrega[0], $fecha);
				}								
			}
			
			foreach($entregas4 as $entrega){
				if (strpos($entrega[0], 'DEREITO FINANCEIRO') !== false) {
					$datos[0] = "Dereito financeiro e tributario II";
				}else{
					if (strpos($entrega[0], 'DEREITO MERCANTIL II') !== false) {
						$datos[0] = "Dereito mercantil II";
					}else{
						if (strpos($entrega[0], 'Dereito mercantil europeo') !== false) {
							$datos[0] = "Dereito mercantil europeo";
						}else{
							if (strpos($entrega[0], 'LIBRE ') !== false) {
								$datos[0] = "Libre circulación de traballadores e políticas sociais europeas";
							}else{
								if (strpos($entrega[0], 'n e medio ambiente') !== false) {
									$datos[0] = "Unión Europea, constitución e medio ambiente";
								}else{
									if (strpos($entrega[0], 'Argumentaci') !== false) {
										$datos[0] = "Argumentación e interpretación xurídica";
									}else{
										if (strpos($entrega[0], 'Sistemas xur') !== false) {
											$datos[0] = "Sistemas xurídicos contemporáneos: Dereito continental e dereito anglosaxón";
										}else{
											if (strpos($entrega[0], 'Dereito de defensa da competencia') !== false) {
												$datos[0] = "Dereito de defensa da competencia";
											}else{
												if (strpos($entrega[0], 'PRO. ESP. E') !== false) {
													$datos[0] = "Procesos especiais e métodos alternativos de solución de conflitos";
												}else{
													if (strpos($entrega[0], 'DEREITO TRIBUTARIO DA') !== false) {
														$datos[0] = "Dereito tributario da Unión Europea e internacional";
													}else{
														if (strpos($entrega[0], 'INTERNACIONAL E SOSTIBILIDADE') !== false) {
															$datos[0] = "Litigación internacional e sostibilidade";
														}else{
															if (strpos($entrega[0], 'D. penal e procesual de menores') !== false) {
																$datos[0] = "Dereito penal e procesual de menores";
															}else{
																if (strpos($entrega[0], 'DEREITO PENITENCIARIO') !== false) {
																	$datos[0] = "Criminoloxía e dereito penitenciario";
																}else{
																	if (strpos($entrega[0], 'Dereito de danos e responsabilidade civil') !== false) {
																		$datos[0] = "Dereito de danos e responsabilidade civil";
																	}else{
																		if (strpos($entrega[0], 'ticas externas') !== false) {
																			$datos[0] = "Prácticas externas";
																		}else{
																			if (strpos($entrega[0], 'Traballo de Fin de Grao') !== false) {
																				$datos[0] = "Traballo de Fin de Grao";
																			}else{
																				$datos[0] = $entrega[0];
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
				$idAsig = obtenerIdAsignatura($datos[0]);
				if($value[0]===$idAsig){//Se obtienen los datos de los exámenes para cada asignatura seleccionada
					$fecha = $entrega[1]->format('Y-m-d H:i:s');
					$curso->crearEntregas($_REQUEST['idCurso'], $value[0], $entrega[0], $fecha);
				}								
			}
        }
        new Mensaje($respuesta, '../Controllers/CURSO_Controller.php');
        break;
		
	case 'desasignar':

        if (!tienePermisos('CURSO_UNASSIGN')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
			$curso->desasignarAsignatura($_REQUEST['idCurso'], $_REQUEST['idAsignatura']);
            echo '<script> location.replace("../Controllers/CURSO_Controller.php"); </script>';
            exit(0);
        }
        break;

    case 'insertar':

        if (!tienePermisos('CURSO_ADD')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $respuesta = $curso->insertarCurso();
            new Mensaje($respuesta, '../Controllers/CURSO_Controller.php');
        }
        break;


    case 'vistamodificar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->obtenerCursoDetalle($_REQUEST['id']);
            require_once '../Views/CURSO_EDIT_Vista.php';
            new CURSO_EDIT($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'modificar':

        if (!tienePermisos('CURSO_EDIT')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $respuesta = $curso->modificarCurso($_REQUEST['id']);
            new Mensaje($respuesta, '../Controllers/CURSO_Controller.php');
        }
        break;

	case 'vistaeliminar':

        if (!tienePermisos('CURSO_DELETE')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $datos = $curso->obtenerCursoDetalle($_REQUEST['id']);
            require_once '../Views/CURSO_DELETE_Vista.php';
            new CURSO_DELETE($datos, '../Controllers/CURSO_Controller.php');
        }
        break;

    case 'eliminar':

        if (!tienePermisos('CURSO_DELETE')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            $curso = get_data_form();
            $respuesta = $curso->eliminarCurso($_REQUEST['id']);
            new Mensaje($respuesta, '../Controllers/CURSO_Controller.php');
        }
        break;

    default: 

         if (ConsultarTipoUsuario($_SESSION['login']) != 2) {
			//Carga una vista con todos los cursos al ser administrador
			$curso = new CURSO_Model("", "", "", "");
            $datos = $curso->obtenerCursos();

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_SHOWALL($datos, '../Controllers/CURSO_Controller.php');
        } else {
            //Si no, cargaría una vista exactamente igual pero solo vería sus cursos
            $curso = get_data_form();
			$curso = new CURSO_Model("", "", "", "");
			$id = ObtenerCalendario($_SESSION['login']);
            $datos = $curso->obtenerCursosUsuario($id);

            require_once '../Views/CURSO_SHOWALL_Vista.php';
            new CURSO_SHOWALL($datos, '../Controllers/CURSO_Controller.php');
        }
}
?>