<?php

class USUARIO_Show {

//VISTA PARA LISTAR TODOS LOS USUARIOS
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
            <?php
            $lista = array('username', 'tipoUsuario', 'nombre', 'apellidos', 'dni', 'fechaNac', 'niu', 'email');
            ?>
            <div class="container">
                <div align='left'>
					<a href='USUARIO_Controller.php?accion=<?php echo $strings['Insertar']; ?>&user=admin'><img src="../img/admin.jpg" width="54px" height="54px"><?php echo $strings['addAdministrador']; ?></a>
					
         
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
                                                 
                                            if ($clave === 'username') {
                                                ?>
                                            <a href='USUARIO_Controller.php?username=<?php echo $this->datos[$j]['username'] . '&accion=' . $strings['Ver']; ?>'><font color="#088A4B"><?php echo $valor; ?></font></a> <?php
                                        } else {
                                            echo $valor;
                                        }
                                        echo "</td>";
                                    }
                                }
                            }
                            ?>

                            <!--<td><button type="button" class="btn btn-success"><a href='USUARIO_Controller.php?userName=<?php echo $this->datos[$j]['username'] . '&accion=' . $strings['Ver']; ?>'><?php echo $strings['Ver']; ?></a></button></td>   -->          
                            <td><button type="button" class="btn btn-info"><a href='USUARIO_Controller.php?username=<?php echo $this->datos[$j]['username'] . '&accion=' . $strings['Modificar']; ?>'><?php echo $strings['Modificar']; ?></a></button></td>
                            <td><button type="button" class="btn btn-danger"><a href='USUARIO_Controller.php?username=<?php echo $this->datos[$j]['username'] . '&accion=' . $strings['Borrar']; ?>'><?php echo $strings['Borrar']; ?></a></button></td>
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
