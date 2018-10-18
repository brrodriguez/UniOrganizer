<script type="text/javascript">
function changeIdAction(id)
{
	document.getElementById("frmAsignar").action+=id;
}
</script>
<?php
class CURSO_SHOWALL
{

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

		echo '<div class="container">';
                echo '<br>';
		
		echo '<a href="?accion=vistaimportar"><button type="button" class="btn btn-primary btn-lg btn-block">'.$strings['obtenerCurso'].'</button></a>';
		echo '<br>';
		echo '<a href="?accion=vistainsertar"><button type="button" class="btn btn-primary btn-lg btn-block">'.$strings['newcurso'].'</button></a>';
		
		echo'<table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">'.$strings['nombreCurso2'].'</th>
				  <th scope="col">'.$strings['descripcionCurso2'].'</th>
				  <th scope="col">'.$strings['idCalendario'].'</th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				</tr>
			  </thead><tbody>';

		foreach($this->datos as $valor)
		{
			echo '<tr>';
			echo '<th><a href="?accion=ver&id='.$valor['0'].'">'.$valor['1'].'</a></th>';
			echo '<td>'.$valor['2'].'</td>';
            echo '<td>'.$valor['3'].'</td>';

				echo '<td><a href="?accion=vistaasignar&id='.$valor['0'].'"><button type="button" class="btn btn-success">'.$strings['AsignarAsignaturas']. '</button></a></td>';
				echo '<td><a href="?accion=vistamodificar&id='.$valor['0'].'"><button type="button" class="btn btn-primary">'.$strings['cursomodificar'].'</button></a></td>';
				echo '<td><a href="?accion=vistaeliminar&id='.$valor['0'].'"><button type="button" class="btn btn-danger">'.$strings['cursoeliminar'].'</button></a></td>';

			echo '</tr>';
		}			
				
	
		echo '</tbody>
			</table>';	
		echo '</div>';
		

        include '../Views/footer.php';
    }

}
?>