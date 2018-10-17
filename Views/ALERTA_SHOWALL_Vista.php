<?php

class ALERTA_Listar {

    private $datos;
    private $volver;

    function __construct($datos, $volver) {
        $this->datos = $datos;
        $this->volver = $volver;
        $this->render();
    }
	
	function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?> 
        <div class="container">
            <?php
            $lista = array( 'asuntoAlerta', 'descripcionAlerta');
            ?>
            <div class="container">
				<br>
                <div align='left'>
					<a href='ALERTA_Controller.php?accion=<?php echo $strings['Crear']; ?>'><button type="button" class="btn btn-primary btn-lg btn-block"><?php echo $strings['Crear'] ?></button></a>				
         
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
									
										foreach ($this->datos[$j] as $clave => $valor ){
											for ($i = 0; $i < count($lista); $i++) {
												if ($clave === $lista[$i]) {
													echo "<td>"; 
													
													if ($clave === 'asuntoAlerta') {
														?>
														<a href='ALERTA_Controller.php?idAlerta=<?php echo $this->datos[$j]['idAlerta'] . '&accion=' . $strings['Ver']; ?>'><?php echo $this->datos[$j]['asuntoAlerta'];?></a> <?php
													} else {
														echo $valor;
													}
																							
													echo "</td>";
												}										
											}
										}
										?>
										<td><button type="button" class="btn btn-danger"><a href='ALERTA_Controller.php?idAlerta=<?php echo $this->datos[$j]['idAlerta'] . '&accion=' . $strings['Borrar']; ?>'><?php echo $strings['Borrar']; ?></a></button></td>
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
