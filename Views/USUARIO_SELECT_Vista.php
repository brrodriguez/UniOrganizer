<?php

class USUARIO_Select {

    private $volver;

    function __construct($volver) {
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        ?> 
        <div class="container">
            <div align='center'>
                <a href='USUARIO_Controller.php?accion=<?php echo $strings['Seleccionar']; ?>&user=admin'><img src="../img/admin.jpg" width="54px" height="54px"><?php echo $strings['Administrador']; ?></a>
            </div>
            <div align='right'>
                <a class="form-link" href='<?php echo $this->volver ?> '><?php echo $strings['Volver']; ?> </a>
            </div>
        </div>
        <?php
        include '../Views/footer.php';
    }

}
