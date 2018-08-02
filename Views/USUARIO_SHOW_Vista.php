<?php

class USUARIO_SELECT_SHOW {

    private $valores;
    private $volver;

//VISTA PARA LA MODIFICACIÓN DE USUARIOS
    function __construct($valores, $volver) {
        $this->valores = $valores;
        $this->volver = $volver;
        $this->render();
    }

    function render() {

        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form  id="form" name="form" action='USUARIO_Controller.php?user=user'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Ver Usuario']; ?></label><br>
                </div>
                
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['username']; ?></label><br>
                    <input class="form" id="username" name="username" size="25" type="text" readonly="true" value="<?php echo $this->valores['username']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombre']; ?></label><br>
                    <input class="form" id="nombre" name="nombre" size="50" type="text" readonly="true" value="<?php echo $this->valores['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['apellidos']; ?></label><br>
                    <input class="form" id="apellidos" name="apellidos" size="50" type="text" readonly="true" value="<?php echo $this->valores['apellidos']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['dni']; ?></label><br>
                    <input class="form" id="dni" name="dni" size="9" type="text" readonly="true" value="<?php echo $this->valores['dni']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaNac']; ?></label><br>
                    <input class="form" id="fechaNac" name="fechaNac" type="date" readonly="true" value="<?php echo $this->valores['fechaNac']; ?>">
                </div>


                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['niu']; ?></label><br>
                    <input class="form" id="niu" name="niu" size="12" type="text" readonly="true" value="<?php echo $this->valores['niu']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['email']; ?></label><br>
                    <input class="form" id="email" name="email" size="50" type="email" readonly="true" value="<?php echo $this->valores['email']; ?>">
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
