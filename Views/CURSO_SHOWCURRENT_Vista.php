<?php

class CURSO_ShowCurrent {

    private $datos;
    private $volver;

    function __construct($array, $volver) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

        echo '<div class="container">
				<h4><b>' . $strings['nombreCurso'] . ': </b>' . $this->datos['curso']['nombreCurso'] . '</h4>
				<h5><b>' . $strings['descripcionCurso'] . ': </b>' . $this->datos['curso']['descripcionCurso'] . '</</h5>';
        echo '<br><br><br><br>';
        echo'<table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">' . $strings['asignaturanombreCurso'] . '</th>
				  <th scope="col">' . $strings['asignaturadescCurso'] . '</th>
				  <th scope="col"></th>
				</tr>
			  </thead><tbody>';
        foreach ($this->datos['asignaturas'] as $valor) {
            echo '<tr>';
            echo '<th>' . $valor['nombreAsignatura'] . '</th>';
            echo '<td>' . $valor['descripcionAsignatura'] . '</td>';
            echo '<td><a href="?accion=desasignar&idCurso=' . $_GET["id"] . '&idAsignatura=' . $valor['idAsignatura'] . '"><button type="button" class="btn btn-danger btn-sm">Desasignar</button></a></td>';
            echo '</tr>';
        }

        echo '</tbody>
			</table>
			<a class="form-link" href="' . $this->volver . '">' . $strings['Volver'] . '</a>
			 </div>';

        include '../Views/footer.php';
    }

}

?>