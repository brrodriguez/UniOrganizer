<?php
class Mensaje2 {

//VISTA PARA MOSTRAR AVISOS Y MENSAJES ESPECÍFICOS
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
            <br><a color="#088A4B" style='font-weight:bold' href="<?php echo$this->volver; ?>"><?php echo $strings['Volver']; ?></a>
        </div>

        <?php
        include '../Views/footer.php';
    }
}
