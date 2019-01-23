
<script type="text/javascript">
    function changeIdAction(id)
    {
        document.getElementById("frmAsignar");
    }
</script>
<?php

class ALERTA_Añadir {

	private $cursos;
    private $volver;

    function __construct( $datos, $volver) {
		$this->datos = $datos;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?><script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>
        <?php include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
			echo $this->datos['horaInicio'];
			echo $this->datos['dia'];
			echo $this->datos['idCurso'];?>
                  

        <div class="container" >
            <form  id="form" name="form" action='ALERTA_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Añadir Alerta']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAlerta']; ?></label><br>
                    <textarea rows="8" cols="70" name="descripcionAlerta" readonly="true"><?php echo $this->datos['asuntoEntrega'];?></textarea>             
                </div>
				
				<div class="form-group">
                    <input type="hidden" id="curso" name="curso" type="int" readonly="true" value="<?php echo $this->datos['idCurso']; ?>">
                </div>
				
				<div class="form-group">
                    <input type="hidden" id="fecha" name="fecha" type="date" readonly="true" value="<?php echo $this->datos['dia']; ?>">
                </div>

                <div class="form-group">
                    <input type="hidden" id="hora" name="hora" type="time" readonly="true" value="<?php echo $this->datos['horaInicio']; ?>">
                </div>
				
				<div class="form-group">
                    <input type="hidden" id="username" name="username" size="25" type="text" required="true" value='usuario'/>
                </div>
				
				<h4><b><?php echo $strings['Aviso']; ?></b></h4>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Dias']; ?></label><br>
                    <input class="form" id="dias" name="dias" type="text" required="true"/>
                </div>
				
                <input type='submit' onclick="" name='accion'  value="<?php echo $strings['Añadir']; ?>">
                <a class="form-link" href="<?php echo $this->volver ?>"><?php echo $strings['Volver']; ?></a>
            </form>
        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
