<?php

class CURSO_IMPORT {

	private $datos;
    private $asignaturas;
	private $seleccionadas;
    private $volver;
    private $idCalendario;

    function __construct($asignaturas, $seleccionadas, $volver, $idCalendario) {
		$this->asignaturas = $asignaturas;
		$this->seleccionadas = $seleccionadas;
        $this->volver = $volver;
        $this->idCalendario = $idCalendario;
        $this->render();
    }

     function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
		?>
			<form method="POST" id="frmCursoImportar" action="../Controllers/CURSO_Controller.php?accion=importar">
				<div class="container">			
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['nombreCurso']; ?></label>
						<div class="col-10">
							<input class="form-control" type="text" name="nombreCurso" id="example-text-input" required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['descripcionCurso']; ?></label>
						<div class="col-10">
							<input class="form-control" type="text" name="descripcionCurso" id="example-text-input" required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label"><?php echo $strings['idCalendario']; ?></label>
						<div class="col-10">
							<input class="form-control" id="example-text-input" name="idCalendario" size="10" type="text" required="true" value="<?php echo $this->idCalendario ;?>" readonly="true"/>
						</div>
					</div>
					<br>
					<h4><b><?php echo $strings['seleccionaCurso']; ?></b></h4>
					<select name="curso">
						<option value="0"></option>
						<option value="1">1 Curso</option>
						<option value="2">2 Curso</option>
						<option value="3">3 Curso</option>
						<option value="4">4 Curso</option>
					</select>
					<br><br>
					<button type="submit" class="btn btn-primary"><?php echo $strings['Guardar']; ?></button>
					<a class="form-link" href="<?php echo $this->volver ;?>"><?php echo $strings['Volver']; ?></a>
				</div>
			</form>
        <?php
        include 'footer.php';
        ?>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var counter = 0;

                $("#addrow").on("click", function () {

                    var newRow = $("<tr>");
                    var cols = "";

                    //cols += '<td>' + counter + '</td>';
                    cols += '<td><select class = "form-control" id = "sel1" name = "select"><?php echo $this->asignaturas['selectasignaturas'];
        ?></select></td>';

                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Eliminar Asignatura"></td>';
                    newRow.append(cols);
                    $("#tblAsignaturas").append(newRow);
                    counter++;
                });



                $("#tblAsignaturas").on("click", ".ibtnDel", function (event) {
                    $(this).closest("tr").remove();
                    counter -= 1
                });

                $("#savefrm").on("click", function () {
                    document.getElementById('frmCursoImportar').submit();

                });


            });
        </script>
        <?php
    }

}
?>
