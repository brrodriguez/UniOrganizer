<?php

class ASIGNATURA_DELETE {

    private $valores;
    private $volver;

    function __construct($valores, $volver) {
        $this->valores = $valores;
        $this->volver = $volver;
        $this->render();
    }

    function render() {

        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form method="POST" action="../Controllers/ASIGNATURA_Controller.php?accion=eliminar&id="<?php echo $this->valores['idAsignatura']; ?>">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Eliminar Asignatura']; ?></label><br>
                </div>
               
                
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombreAsignatura']; ?></label><br>
                    <input class="form" id="nombreAsignatura" name="nombreAsignatura" size="25" type="text" readonly="true" value="<?php echo $this->valores['nombreAsignatura']; ?>">
                </div>             

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAsignatura']; ?></label><br>
                    <input class="form" id="descripcionAsignatura" name="descripcionAsignatura" size="50" type="text" readonly="true" value="<?php echo $this->valores['descripcionAsignatura']; ?>">
                </div>

                <br>
				
				<button type="submit" class="btn btn-primary"><?php echo $strings['Borrar'] ?></button>
                <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
            </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

// fin del metodo render
}
?>