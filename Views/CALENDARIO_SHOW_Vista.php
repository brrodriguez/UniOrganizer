<?php

//VISTA PARA LA INSERCIÓN DE USUARIOS
class SESION_Consultar {

    function __construct() {
        $this->render();
    }

    function render() {
        ?> <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>

        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?>
         <div class="container" >
            <form  id="form" name="form" action='SESION_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Consultar sesiones por fecha']; ?></label><br>
                </div>
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaSesion']; ?></label><br>
                    <input class="form" id="fechaSesion" name="fechaSesion" size="25" type="date"/>
                </div>
                <br>
                    <input type='submit' onclick="return valida_envia_USUARIO()" name='accion'  value="<?php echo $strings['Consultar']; ?>">
                <a class="form-link" href="SESION_Controller.php"><?php echo $strings['Volver']; ?>
            </form>
        </div>
                <?php

        include '../Views/footer.php';
                                }

//fin metodo render
                            }
                        ?>
