<?php

class USUARIO_Modificar {

    private $valores;
    private $volver;

//VISTA PARA LA MODIFICACIÓN DE USUARIOS
    function __construct($valores, $volver) {
        $this->valores = $valores;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?><script type="text/javascript" src="../js/validate.js"></script>
        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>

        <div class="container" >
            <form  id="form" name="form" action='USUARIO_Controller.php?user=user'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Modificar Usuario']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['username']; ?></label><br>
                    <input class="form" id="username" name="username" size="25" type="text" required="true" readonly="true" value="<?php echo $this->valores['username']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['password']; ?></label><br>
                    <input class="form" id="password" name="password" size="25" type="password" required="true" readonly='true' value="<?php echo $this->valores['password']; ?>"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['newPassword']; ?></label><br>
                    <input class="form" id="newPassword" name="newPassword" size="25" type="password"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombre']; ?></label><br>
                    <input class="form" id="nombre" name="nombre" size="50" type="text" required="true" value="<?php echo $this->valores['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['apellidos']; ?></label><br>
                    <input class="form" id="apellidos" name="apellidos" size="50" type="text" required="true" value="<?php echo $this->valores['apellidos']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['dni']; ?></label><br>
                    <input class="form" id="dni" name="dni" size="9" type="text" required="true" value="<?php echo $this->valores['dni']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaNac']; ?></label><br>
                    <input class="form" id="fechaNac" name="fechaNac" type="date" required="true" value="<?php echo $this->valores['fechaNac']; ?>">
                </div>


                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['niu']; ?></label><br>
                    <input class="form" id="niu" name="niu" size="20" type="text" required="true" value="<?php echo $this->valores['niu']; ?>">
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['email']; ?></label><br>
                    <input class="form" id="email" name="email" size="50" type="email" required="true" value="<?php echo $this->valores['email']; ?>">
                </div>
				

                <br>

                <input type = 'submit'  onclick="return valida_envia_USUARIO()" name = 'accion' value = '<?php echo $strings['Modificar'] ?>'  onclick="return valida_envia_USUARIO()" >
                <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
            </form>

        </div>
        <?php
        include '../Views/footer.php';
    }

// fin del metodo render
}
?>
