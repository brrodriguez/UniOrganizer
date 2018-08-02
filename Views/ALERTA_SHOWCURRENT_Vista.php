<?php
class ALERTA_Consulta
{
	private $datos;
	private $volver;
	
	function __construct($datos, $volver)
	{
		$this->datos = $datos;
		$this->volver = $volver;
	}
}
?>