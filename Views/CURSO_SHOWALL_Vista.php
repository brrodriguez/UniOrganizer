<script type="text/javascript">
function changeIdAction(id)
{
	document.getElementById("frmAsignar").action+=id;
}
</script>
<?php
class CURSO_Show
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
                echo '<br><br>';
				
		echo '<a href="?accion=vistainsertar"><button type="button" class="btn btn-primary btn-lg btn-block">'.$strings['newcurso'].'</button></a>';
		
		echo '<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <form id="frmAsignar" method="POST" action="?accion=asignar&id=">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">'.$strings['asignarcurso'].'</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
							 <div class="form-group">
							  <label for="sel1">'.$strings['seleccionaasignaturas'].'</label>
							  <select multiple class="form-control" id="sel2" name="asignacionAsignaturas[]">
								';
							foreach($this->datos['asignaturas'] as $valor)
							{
								echo '<option>'.$valor['1'].'</option>';
							}								
		echo '						
							  </select>
							</div> 
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">'.$strings['closecurso'].'</button>
						<button type="submit" class="btn btn-primary">'.$strings['savecurso'].'</button>
					  </div>
					</div>
				  </div>
				  </form>
				</div>';
		
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

		foreach($this->datos['cursos'] as $valor)
		{
			echo '<tr>';
			echo '<th><a href="?accion=ver&id='.$valor['0'].'">'.$valor['1'].'</a></th>';
			echo '<td>'.$valor['2'].'</td>';
            echo '<td>'.$valor['3'].'</td>';

				echo '<td><a href="?accion=frmasignar&id='.$valor['0'].'"><button type="button" class="btn btn-success">'.$strings['AsignarAsignaturas']. '</button></a></td>';
				echo '<td><a href="?accion=modificar&id='.$valor['0'].'"><button type="button" class="btn btn-primary">'.$strings['cursomodificar'].'</button></a></td>';
				echo '<td><a href="?accion=eliminar&id='.$valor['0'].'"><button type="button" class="btn btn-danger">'.$strings['cursoeliminar'].'</button></a></td>';

			echo '</tr>';
		}			
				
	
		echo '</tbody>
			</table>';	
		echo '</div>';
		

        include '../Views/footer.php';
    }

}
?>