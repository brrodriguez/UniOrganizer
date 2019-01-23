<?php

class CURSO_DELETE {

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
            <form method="POST" action="../Controllers/CURSO_Controller.php?accion=eliminar&id=<?php echo $this->valores['idCurso']; ?>">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Eliminar Curso']; ?></label><br>
                </div>
               
                
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombreCurso']; ?></label><br>
                    <input class="form" id="nombreCurso" name="nombreCurso" size="25" type="text" readonly="true" value="<?php echo $this->valores['nombreCurso']; ?>">
                </div>             

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionCurso']; ?></label><br>
                    <textarea rows="8" cols="70" id="descripcionCurso" name="descripcionCurso" readonly="true"><?php echo $this->valores['descripcionCurso'];?></textarea>
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