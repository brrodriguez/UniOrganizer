<?php

class CURSO_ASIGN {

    private $otros;
    private $datos;
    private $volver;

    function __construct($otros, $array, $volver) {
        $this->otros = $otros;
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        echo '<form method="POST" action="?accion=asignar&idCurso=' . $_GET["id"] . '" id="frmCursoAsignaturas">';
			echo '<div class="container">
				<h4> <b>' . $strings['nombreCurso'] . ': </b>' . $this->otros['curso']['nombreCurso'] . '</h4>                            
				<h5> <b>' . $strings['descripcionCurso'] . ': </b>' . $this->otros['curso']['descripcionCurso'] . '</</h5>';
				echo '<br><br>';
				echo '<button type = "button" class = "btn btn-success" id = "addrow">'.$strings['AñadirAsignatura']. '</button>
				<div class="container">
					<h5><table class = "table" id = "tblAsignaturas">
						<thead class = "thead-dark">
							<tr>
								<th scope = "col" bgcolor="#C0C0C0">'.$strings['nombreAsignatura']. '</th>
								<th scope = "col"></th>
							</tr>
						</thead>
						<tbody>';
						foreach ($this->otros['asignaturas'] as $valor) {
							echo '<tr>';
								echo '<th>' . $valor['nombreAsignatura'] . '</th>';
								
							echo '</tr>';
						}

						echo ' </tbody>
					</table>';
				echo '</div>';
				echo '<br><br><br><br>
				<button id = "savefrm" type = "button" class = "btn btn-primary btn-lg btn-block">'.$strings['Guardar']. '</button>';
				echo '<br>';
			echo '</div>';
		echo '</form>';
        
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
                    cols += '<td><select class = "form-control" id = "sel1" name = "select' + counter + '"><?php echo $this->datos['selectasignaturas'];
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
                    document.getElementById('frmCursoAsignaturas').submit();

                });


            });
        </script>
        <?php
    }

}
?>
