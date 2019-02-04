<?php

class CURSO_ADD {

    private $datos;
    private $volver;
	private $idCalendario;

    function __construct($array, $volver, $idCalendario) {
        $this->datos = $array;
        $this->volver = $volver;
		$this->idCalendario = $idCalendario;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
		?>
       <div class="container">
				<form method="POST" action="../Controllers/CURSO_Controller.php?accion=insertar">
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['nombreCurso'];?>*</label>
						<div class="col-10">
							<input class="form-control" type="text" name="nombreCurso" id="example-text-input" required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['descripcionCurso'];?>*</label>
						<div class="col-10">
							<input class="form-control" type="text" name="descripcionCurso" id="example-text-input" required>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-10">
							<input type="hidden" class="form-control" id="example-text-input" name="idCalendario" size="10" type="text" required="true" value="<?php echo $this->idCalendario ;?>" readonly="true"/>
						</div>
					</div>

					<button type="submit" class="btn btn-primary"><?php echo $strings['savecurso'];?></button>
					<a class="form-link" href="<?php echo $this->volver ;?>"><?php echo $strings['Volver'];?></a>
				</form>
			</div>
			<?php
        include 'footer.php';
    }

}

?>
