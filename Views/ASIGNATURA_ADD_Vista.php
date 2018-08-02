
<?php

class ASIGNATURA_ADD
{
    private $datos;
    private $volver;
	
	function __construct($array, $volver)
	{
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }
	function render()
	{
		include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

		echo '<div class="container">
				<form method="POST" action="../Controllers/ASIGNATURA_Controller.php?accion=insertar">
				<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label">'.$strings['nombreAsignatura'].'</label>
				  <div class="col-10">
					<input class="form-control" type="text" name="nombreAsignatura" id="" required>
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label">'.$strings['descripcionAsignatura'].'</label>
				  <div class="col-10">
					<input class="form-control" type="text" name="descripcionAsignatura" id="" required>
				  </div>
				</div>
				<div class="form-group row">
				<button type="submit" class="btn btn-primary">'.$strings['saveform'].'</button>
				<a class="form-link" href="' . $this->volver . '">' . $strings['Volver'] . '</a>
				</form>
			</div>';
			
			include 'footer.php';
	}
}

?>
