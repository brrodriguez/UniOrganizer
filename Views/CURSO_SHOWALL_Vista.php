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
		?>
		<div class="container">
            
			<?php
			if(ConsultarTipoUsuarioLogin()==2)
			{?>
			<a href="?accion=vistainsertar"><button type="button" class="btn btn-primary btn-lg btn-block"><?php echo $strings['newcurso'];?></button></a>
			<br>
			<a href="?accion=vistaimportar"><button type="button" class="btn btn-primary btn-lg btn-block"><?php echo $strings['obtenerCurso'];?></button></a>
			<br>
			<?php
			}
			if(ConsultarTipoUsuarioLogin()==1)
			{?>
			<a href="?accion=vistafiltrar"><button type="button" class="btn btn-primary btn-lg btn-block"><?php echo $strings['filtrar'];?></button></a>
			<br>
			<?php
			}?>
			
			<table class="table">
				<thead class="thead-dark">
					<tr>
					  <th scope="col"><?php echo $strings['nombreCurso2'];?></th>
					  <th scope="col"><?php echo $strings['descripcionCurso2'];?></th>
					  <th scope="col"><?php echo $strings['username'];?></th>
					  <th scope="col"></th>
					  <th scope="col"></th>
					  <th scope="col"></th>
					</tr>
				</thead>
				<tbody>
		<?php
		foreach($this->datos as $valor)
		{
			$usuario = ObtenerUsername($valor['3']);
			?>
					<tr>
						<th><a href="?accion=ver&id=<?php echo $valor['0'];?>"><?php echo $valor['1'];?></a></th>
						<td><?php echo $valor['2'];?></td>
						<td><?php echo $usuario;?></td>

						<td><a href="?accion=vistaasignar&id=<?php echo $valor['0'];?>"><button type="button" class="btn btn-success"><?php echo $strings['AsignarAsignaturas'];?></button></a></td>
						<td><a href="?accion=vistamodificar&id=<?php echo $valor['0'];?>"><button type="button" class="btn btn-primary"><?php echo $strings['cursomodificar'];?></button></a></td>
						<td><a href="?accion=vistaeliminar&id=<?php echo $valor['0'];?>"><button type="button" class="btn btn-danger"><?php echo $strings['cursoeliminar'];?></button></a></td>
					</tr><?php
		}			
				?>
				</tbody>
			</table>
		</div>
		<?php

        include '../Views/footer.php';
    }

}
?>