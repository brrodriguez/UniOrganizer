<?php

class ASIGNATURA_EDIT {

    private $datos;
    private $volver;

    function __construct($array, $volver) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render()
	{
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
   
		echo '<div class="container">
				<form method="POST" action="../Controllers/ASIGNATURA_Controller.php?accion=guardarmod&id='.$this->datos['idAsignatura'].'">
				<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label">'.$strings['nombreAsignatura'].'</label>
				  <div class="col-10">
					<input class="form-control" type="text" name="nombreAsignatura" value="'.$this->datos['nombreAsignatura'].'" id="example-text-input" required>
				  </div>
				</div>
				<div class="form-group row">
				  <label for="example-text-input" class="col-2 col-form-label">'.$strings['descripcionAsignatura'].'</label>
				  <div class="col-10">
					<input class="form-control" type="text" name="descripcionAsignatura" value="'.$this->datos['descripcionAsignatura'].'" id="example-text-input" required>
				  </div>
				</div>
				<button type="submit" class="btn btn-primary">'.$strings['saveform'].'</button>
				</form>
			</div>';

        include '../Views/footer.php';
    }

}
?>