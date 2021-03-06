<?php

class CURSO_EDIT {

    private $datos;
    private $volver;

    function __construct($array, $volver) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
		?>
        <div class="container">
			<form method="POST" action="../Controllers/CURSO_Controller.php?accion=modificar&id=<?php echo $this->datos['idCurso']; ?>">
				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['nombreCurso']; ?></label>
					<div class="col-10">
						<input class="form-control" type="text" name="nombreCurso" value="<?php echo $this->datos['nombreCurso']; ?>" id="example-text-input" required>
					</div>
				</div>
                                

				<div class="form-group row">
					<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['descripcionCurso']; ?></label>
					<div class="col-10">
						<input class="form-control" type="text" name="descripcionCurso" value="<?php echo $this->datos['descripcionCurso']; ?>" id="example-text-input" required>
					</div>
				</div>

				<button type="submit" class="btn btn-primary"><?php echo $strings['savecurso']; ?></button>
			</form>
		</div>
		<?php
        include '../Views/footer.php';
    }

}
?>