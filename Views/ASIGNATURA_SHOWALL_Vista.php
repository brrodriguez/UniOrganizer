<?php

class ASIGNATURA_SHOWALL{

    private $datos;
    private $volver;
	private $tipoUsuario;

    function __construct($array, $tipoUsuario, $volver) {
        $this->datos = $array;
		$this->tipoUsuario = $tipoUsuario;
        $this->volver = $volver;
        $this->render();
    }

    function render()
	{
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
      
               
		echo '<div class="container">';
                echo '<br>';
                
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
			if($this->tipoUsuario==1){
				echo '<td><a href="?accion=vistaeliminar&id='.$valor['0'].'"><button type="button" class="btn btn-danger">'.$strings['asignaturaeliminar'].'</button></a></td>';
			}
			echo '</tr>';
		}			
				
		
		echo '</tbody>
			</table>';
		echo '</div>';

        include '../Views/footer.php';
    }

}
?>