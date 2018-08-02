<?php

//VISTA PARA LA INSERCIÓN DE USUARIOS
class SESION_Editar {

    private $datos;
    private $volver;

    function __construct($datos, $volver) {
        $this->datos = $datos;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>
        <div class="container" >
            <form  id="form" name="form" action='SESION_Controller.php?'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Modificar sesion']; ?></label><br>
                </div>
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombreTabla']; ?></label><br>
                    <input class="form" id="nombreTabla" name="nombreTabla" size="25" type="text" required="true" readonly="true" value="<?php echo $this->datos['nombreTabla']; ?>">
                </div>

                <div class="form-group">
                    <input type='hidden' class="form" id="idSesion" name="idSesion" size="25" type="text" required="true" readonly="true" value="<?php echo $this->datos['idSesion']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombreActividadIndividual']; ?></label><br>
                    <input class="form" id="nombreActividadIndividual" name="nombreActividadIndividual" size="25" type="text" required="true" readonly='true' value="<?php echo $this->datos['nombreActividadIndividual']; ?>"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaSesion']; ?></label><br>
                    <input class="form" id="fechaSesion" name="fechaSesion" size="10" type="date" readonly="true" value="<?php echo $this->datos['fechaSesion']; ?>"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['horaInicio']; ?></label><br>
                    <input class="form" id="horaInicio" name="horaInicio" size="6" type="text" required="true" readonly="true" value="<?php echo $this->datos['horaInicio']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['horaFin']; ?></label><br>
                    <input class="form" id="horaFin" name="horaFin" size="6" type="text" required="true" readonly="true" value="<?php echo $this->datos['horaFin']; ?>">
                </div>


                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['comentarioSesion']; ?></label><br>
                    <textarea rows="10" cols="50" name="comentarioSesion" ><?php echo $this->datos['comentarioSesion']; ?></textarea>

                </div>

                <br>

                <input type = 'submit' name = 'accion' value = '<?php echo $strings['Modificar'] ?>' >
                <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
            </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
