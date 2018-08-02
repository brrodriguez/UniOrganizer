<?php

//VISTA PARA LA INSERCIÓN DE USUARIOS
class SESION_Consulta {

    private $datos;
    private $volver;

    function __construct($datos, $volver) {
        $this->datos = $datos;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?> <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>

        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>
        <div class="container">
            <?php
            $lista = array('idTabla', 'idActividadIndividual', 'comentarioSesion', 'fechaSesion', 'horaInicio', 'horaFin');
            ?>
            <br><br>

            <div class="container">
                <div class="col-lg-12">
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
                                                echo "</td>";
                                            }
                                        }
                                    }

                                    /*
                                      for($i=0;$i<count($this->datos);$i++)
                                      {
                                      echo $this->datos[$i]['idTabla'];
                                      echo $this->datos[$i]['idActividadIndividual'];
                                      echo $this->datos[$i]['comentarioSesion'];
                                      echo $this->datos[$i]['fechaSesion'];
                                      echo $this->datos[$i]['horaInicio'];
                                      echo $this->datos[$i]['horaFin'];
                                      }
                                      ?>
                                     */


                                    
                                }
                                ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
                                <?php
                                include '../Views/footer.php';

//fin metodo render
                            }

                        }
                        ?>
