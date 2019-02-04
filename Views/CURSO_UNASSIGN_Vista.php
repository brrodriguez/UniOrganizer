<?php

class CURSO_UNASSIGN {

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
				<h4><b><?php echo $strings['nombreCurso']; ?>: </b><?php echo $this->datos['curso']['nombreCurso'] ; ?></h4>
				<h5><b><?php echo $strings['descripcionCurso']; ?>: </b><?php echo $this->datos['curso']['descripcionCurso']; ?></h5>
        <br><br><br><br>
        <table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col"><?php echo $strings['nombreAsignatura']; ?></th>
				  <th scope="col"></th>
				</tr>
			  </thead><tbody>
			  <?php
        foreach ($this->datos['asignaturas'] as $valor) {
			?>
            <tr>
            <th><?php echo $valor['nombreAsignatura']; ?></th>
            <td><a href="?accion=desasignar&idCurso=<?php echo $_GET["id"]; ?>&idAsignatura=<?php echo  $valor['idAsignatura']; ?>"><button type="button" class="btn btn-danger btn-sm">Desasignar</button></a></td>
            </tr><?php
        }
		?>
        </tbody>
			</table>
			<a class="form-link" href="<?php echo $this->volver; ?>"><?php echo $strings['Volver']; ?></a>
			 </div>
		<?php
        include '../Views/footer.php';
    }

}

?>