<?php

class ALERTA_Ver {
    private $alerta;
	private $evento;
    private $volver;

    function __construct($alerta, $evento, $volver) {
        $this->alerta = $alerta;
		$this->evento = $evento;
        $this->volver = $volver;
        $this->render();
    }

    function render() {

        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form  id="form" name="form" action='ALERTA_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Ver Alerta']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['asuntoAlerta']; ?></label><br>
                     <input class="form" id="asuntoAlerta" name="asuntoAlerta"  size="50" readonly="true" value="<?php echo $this->alerta['asuntoAlerta']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAlerta']; ?></label><br>
                    <textarea rows="8" cols="70" name="descripcionAlerta" readonly="true"><?php echo $this->alerta['descripcionAlerta'];?></textarea>             
                </div>

				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Fecha']; ?></label><br>
                     <input class="form" id="fecha" name="fecha"  type="date" readonly="true" value="<?php echo $this->evento['dia']; ?>">
                </div>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Hora']; ?></label><br>
                    <input class="form" id="hora" name="hora" type="time" required="true" readonly="true" value="<?php echo $this->evento['horaInicio']; ?>"/>
                </div>
				
                <div class="form-group">
                    <input type="hidden" class="form" id="username" name="username" size="25" type="text" readonly="true" value="<?php echo $this->alerta['username']; ?>">
                </div>
				<div class="form-group">
                    <input type="hidden" class="form" id="idAlerta" name="idAlerta" size="25" type="text" readonly="true" value="<?php echo $this->alerta['idAlerta']; ?>">
                </div>
        <br>

        <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
        </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

// fin del metodo render
}
?>
