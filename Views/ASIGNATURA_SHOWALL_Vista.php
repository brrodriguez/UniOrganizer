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
      
        ?>    
		<div class="container">
            <br>
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col"><?php echo $strings['asignaturanombre']; ?></th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
			<?php
			if($this->datos==NULL){
				
			}else{
				foreach($this->datos as $valor)
				{?>
							<tr>
								<th><br><?php echo $valor['1']; ?></th>
								<td><a href="https://secretaria.uvigo.gal/docnet-nuevo/guia_docent/index.php<?php echo $valor['href'];?>" target="_blank"><button type="button" class="btn btn-success"><?php echo $strings['Guia'];?></button></a></td><?php
								if($this->tipoUsuario==1){
									?><td><a href="?accion=vistaeliminar&id=<?php echo $valor['0'];?>"><button type="button" class="btn btn-danger"><?php echo $strings['asignaturaeliminar'];?></button></a></td><?php
								}?>
							</tr>
					<?php
				}
			}?>					
				</tbody>
			</table>
		</div>
		<?php
        include '../Views/footer.php';
    }

}
?>