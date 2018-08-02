<?php

//VISTA PARA LA INSERCIÓN DE USUARIOS
class SESION_Insertar {

    private $nombreTabla;
    private $idTabla;
    private $volver;

    function __construct($nombreTabla,$idTabla,$volver) {
        $this->volver = $volver;
        $this->nombreTabla = $nombreTabla;
        $this->idTabla =$idTabla;
        $this->render();
    }

    function render() {
        $hoy = getDate();
        $hoy1 = localTime(time(),true);
        $mesCorrecto = $hoy1['tm_mon'] +1;
        ?> <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>

        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php'; ?>

        <div class="container" >
            <form  id="form" name="form" action='SESION_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Iniciar sesion']; ?></label><br>
                </div>
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['Realizando tabla']; echo ":".$this->nombreTabla ?></label><br>   
                    <label class="control-label" ><?php echo $strings['Actividad']; echo ": Fittness" ?></label><br>        
                </div>
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaSesion']; ?></label><br>
                    <input class="form" id="fechaSesion" name="fechaSesion" size="25" type="text" required="true" readonly="true" value=<?php echo $hoy['year']."/".$mesCorrecto."/".$hoy1['tm_mday']?> />
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['horaInicio']; ?></label><br>
                    <input class="form" id="horaInicio" name="horaInicio" size="25" type="text" required="true" readonly="true" value=<?php echo $hoy['hours'].":".$hoy['minutes'].""?> />
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['comentarioSesion']; ?></label><br>
<!--                    <input class="form" id="comentarioSesion" name="comentarioSesion" type="textarea" rows="10" cols="40" />-->
                    <textarea id="comentarioSesion" rows="25" cols="70" name="comentarioSesion"></textarea>
                </div>
                <button type='submit' class="btn btn-success"><?php echo $strings['InsertarSesion']; ?></button>
                <input class="hidden" id= "accion" name= "accion" size="25" type="text" required = "true" value=<?php echo $strings['InsertarSesion']?> />
                <input class="hidden" id= "idTabla" name= "idTabla" size="25" type="text" required = "true" value=<?php echo $this->idTabla?> />
                <a class="form-link" href="<?php echo $this->volver?>"><?php echo $strings['Volver']; ?>
            </form>
        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}

?>