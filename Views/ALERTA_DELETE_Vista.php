<?php

class ALERTA_Borrar {
     
    private $valores;
    private $volver;
    
    function __construct($datos,$volver) {
        $this->valores = $datos;
        $this->volver = $volver;
        $this->render();
    }

    function render() {

        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form  id="form" name="form" action='ALERTA_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Borrar Alerta']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['asuntoAlerta']; ?></label><br>
                     <input class="form" id="asuntoAlerta" name="asuntoAlerta"  size="50" readonly="true" value="<?php echo $this->valores['asuntoAlerta']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAlerta']; ?></label><br>
                    <textarea rows="8" cols="60" name="descripcionAlerta" readonly="true"><?php echo $this->valores['descripcionAlerta'];?></textarea>
                    
                </div>


                <div class="form-group">
                    <input type="hidden" class="form" id="username" name="username" size="25" type="text" readonly="true" value="<?php echo $this->valores['username']; ?>">
                </div>
                 <div class="form-group">
                    <input type="hidden" class="form" id="idAlerta" name="idAlerta" size="25" type="text" readonly="true" value="<?php echo $this->valores['idAlerta']; ?>">
                </div>
        <br>
        <input type='submit' onclick="" name='accion'  value="<?php echo $strings['Borrar']; ?>">
        <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
        </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
