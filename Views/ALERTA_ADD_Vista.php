
<script type="text/javascript">
    function changeIdAction(id)
    {
        document.getElementById("frmAsignar");
    }
</script>
<?php

class ALERTA_Insertar {


    private $volver;

    function __construct( $volver) {
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?><script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>
        <?php include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php'; ?>
                  

        <div class="container" >
            <form  id="form" name="form" action='ALERTA_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Insertar Alerta']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['asuntoAlerta']; ?></label><br>
                    <input class="form" id="asuntoAlerta" name="asuntoAlerta" size="50" type="text" required="true"/>
                </div>

               <div class="form-group">
                    <label class="control-label" ><?php echo $strings['descripcionAlerta']; ?></label><br>
                    <textarea class="form" id="descripcionAlerta" name="descripcionAlerta" rows="20" cols="70" required="true"></textarea>
                </div>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Fecha']; ?></label><br>
                    <input class="form" id="fecha" name="fecha" type="date" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['Hora']; ?></label><br>
                    <input class="form" id="hora" name="hora" type="time" required="true"/>
                </div>
				
				<div class="form-group">
                    <input type="hidden" id="username" name="username" size="25" type="text" required="true" value='usuario'/>
                </div>
				
				<h4><b><?php echo $strings['Aviso']; ?></b></h4>
				
				<div class="form-group">
                    <label class="control-label" ><?php echo $strings['Dias']; ?></label><br>
                    <input class="form" id="dias" name="dias" type="text" required="false"/>
                </div>
				
                <input type='submit' onclick="" name='accion'  value="<?php echo $strings['Crear']; ?>">
                <a class="form-link" href="<?php echo $this->volver ?>"><?php echo $strings['Volver']; ?></a>
            </form>
        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
