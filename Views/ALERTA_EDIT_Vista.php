<?php

class ALERTA_Modificar {
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
		?>
        <script type="text/javascript" src="../js/validate.js"></script>
        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form  id="form" name="form" action='ALERTA_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Modificar Alerta']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['asuntoAlerta']; ?></label><br>
                    <input onchange="return valida_envia_asuntoAlerta()" class="form" id="asuntoAlerta" name="asuntoAlerta"  size="50" value="<?php echo $this->alerta['asuntoAlerta']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAlerta']; ?></label><br>
                    <textarea onchange="return valida_envia_descripcionAlerta()" rows="8" cols="70" name="descripcionAlerta" ><?php echo $this->alerta['descripcionAlerta'];?></textarea>             
                </div>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Fecha']; ?></label><br>
                     <input class="form" id="fecha" name="fecha"  type="date" value="<?php echo $this->evento['dia']; ?>">
                </div>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Hora']; ?></label><br>
                    <input onchange="return valida_envia_hora()" class="form" id="hora" name="hora" type="time" required="true" value="<?php echo $this->evento['horaInicio']; ?>"/>
                </div>
				
				<div class="form-group">
                    <input type="hidden" class="form" id="idCalendarioHoras" name="idCalendarioHoras" size="25" type="text" readonly="true" value="<?php echo $this->evento['idCalendarioHoras']; ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form" id="username" name="username" size="25" type="text" readonly="true" value="<?php echo $this->alerta['username']; ?>">
                </div>
				<div class="form-group">
                    <input type="hidden" class="form" id="idAlerta" name="idAlerta" size="25" type="text" readonly="true" value="<?php echo $this->alerta['idAlerta']; ?>">
                </div>
        <br>

				<input type='submit' onclick="return valida_envia_ALERTA()" name='accion'  value="<?php echo $strings['Modificar']; ?>">
                <a class="form-link" href="<?php echo $this->volver ?>"><?php echo $strings['Volver']; ?></a>
        </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

// fin del metodo render
}
?>
