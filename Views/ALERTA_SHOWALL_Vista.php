<?php

class ALERTA_Listar {

    private $datos;
    private $volver;
    private $tipoUsuario;
    private $cont;
    private $vuelta;
    private $enviados;

    function __construct($datos, $tipoUsuario, $volver) {
        $this->datos = $datos;
        $this->tipoUsuario = $tipoUsuario;
        $this->volver = $volver;
        $this->render();
    }
	
	function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?> 
        <div class="container">
            <?php
            $lista = array('idAlerta', 'fechaHora', 'asuntoAlerta', 'descripcionAlerta', 'idCalendario');
            ?>
            <div class="container">
                <div align='left'>
					<button type="button" class="btn btn-success btn-lg"><a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><?php echo $strings['Crear'] ?></a></button>
					<button type="button" class="btn btn-primary btn-lg"><a href='ALERTA_Controller.php?accion=<?php echo $strings['Consultar']; ?>'><?php echo $strings['Consultar'] ?></a></button>  
         
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <?php
                                foreach ($lista as $titulo) {
                                    echo "<th>";
                                    echo $strings[$titulo];
                                    echo "</th>";
                                }
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                for ($j = 0; $j < count($this->datos); $j++) {
                                    echo "<tr>";
                                    foreach ($this->datos [$j] as $clave => $valor) {
                                        for ($i = 0; $i < count($lista); $i++) {
                                            if ($clave === $lista[$i]) {
                                                echo "<td>";
                                                                                     
												echo $valor;
											}
                                        echo "</td>";
										}
									}
								
                            ?>

 
                            <td><button type="button" class="btn btn-info"><a href='ALERTA_Controller.php?username=<?php echo $this->datos[$j]['idAlerta'] . '&accion=' . $strings['Modificar']; ?>'><?php echo $strings['Modificar']; ?></a></button></td>
                            <td><button type="button" class="btn btn-danger"><a href='ALERTA_Controller.php?username=<?php echo $this->datos[$j]['idAlerta'] . '&accion=' . $strings['Borrar']; ?>'><?php echo $strings['Borrar']; ?></a></button></td>
                                    <?php
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        include '../Views/footer.php';
    }

}
