<?php
class Mensaje2 {

//VISTA PARA MOSTRAR AVISOS Y MENSAJES
    private $string;
    private $volver;

    function __construct($string, $volver) {
        $this->string = $string;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_Castellano.php';
        ?>
        <div class="container">
            <br>
            <h2><div align="center"><font color="#088A4B"><?php echo $strings[$this->string]?></font></div></h2>
            <br>
        </div>

        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
