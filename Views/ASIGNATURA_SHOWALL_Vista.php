<?php

class ASIGNATURA_SHOW{

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
                echo '<br>';
                
		echo '<a href="?accion=vistainsertar"><button type="button" class="btn btn-primary btn-lg">'.$strings['newAsignatura'].'</button></a>';
                
		echo'<table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">'.$strings['asignaturanombre'].'</th>
				  <th scope="col">'.$strings['asignaturadescripcion'].'</th>
				  <th scope="col"></th>
				  <th scope="col"></th>
				</tr>
			  </thead><tbody>';

		foreach($this->datos as $valor)
		{
			echo '<tr>';
			echo '<th><br>'.$valor['1'].'</th>';
			echo '<td><br>'. saltoLinea($valor['2']).'</td>';
			echo '<td><a href="?accion=modificar&id='.$valor['0'].'"><button type="button" class="btn btn-primary">'.$strings['asignaturamodificar'].'</button></a></td>';
			echo '<td><a href="?accion=eliminar&id='.$valor['0'].'"><button type="button" class="btn btn-danger">'.$strings['asignaturaeliminar'].'</button></a></td>';
			echo '</tr>';
		}			
				
	
		echo '</tbody>
			</table>';
		echo '</div>';

        include '../Views/footer.php';
    }

}
?>