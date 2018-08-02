
<script type="text/javascript">
    function changeIdAction(id)
    {
        document.getElementById("frmAsignar");
    }
</script>
<?php

class ALERTA_Insertar {

    private $desti;
    private $users;
    private $act;
    private $volver;

    function __construct($desti, $users, $act, $volver) {
        $this->desti = $desti;
        $this->users = $users;
        $this->act = $act;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?><script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>
        <?php include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php'; ?>

        <!--Modal 1 -  Correo de usuarios individuales-->
        <div class = "modal fade" id = "myModal1" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel" aria-hidden = "true">
            <form id = "frmAsignar" method = "POST" action = "?accion=<?php echo $strings['Crear']; ?>">
                <div class = "modal-dialog" role = "document">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h5 class = "modal-title" id = "exampleModalLabel"><?php echo $strings['seleccionarDestinatario']; ?></h5>
                            <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                <span aria-hidden = "true">&times;
                                </span>
                            </button>
                        </div>
                        <div class = "modal-body">
                            <div class = "form-group">
                                <label for = "sel1"><?php echo $strings['destinatarioNotificacion']; ?></label>
                                <select multiple class = "form-control" id = "sel2" name = "destinatarios[]">
                                    <?php
                                    foreach ($this->users as $clave => $valor) {
                                        echo '<option>' . $valor['0'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-secondary" data-dismiss = "modal"><?php echo $strings['closetabla']; ?></button>
                            <button type = "submit" class = "btn btn-primary"><?php echo $strings['savetabla']; ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        
        
         <!--Modal 1 -  Correo de usuarios que pertenecen a una actividad (AVISOS)-->
        <div class = "modal fade" id = "myModal2" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel" aria-hidden = "true">
            <form id = "frmAsignar" method = "POST" action = "?accion=<?php echo $strings['Crear']; ?>">
                <div class = "modal-dialog" role = "document">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h5 class = "modal-title" id = "exampleModalLabel"><?php echo $strings['seleccionarDestinatario']; ?></h5>
                            <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                <span aria-hidden = "true">&times;
                                </span>
                            </button>
                        </div>
                        <div class = "modal-body">
                            <div class = "form-group">
                                <label for = "sel1"><?php echo $strings['destinatarioNotificacion']; ?></label>
                                <select multiple class = "form-control" id = "sel2" name = "destinatarios[]">
                                    <?php
                                    foreach ($this->act as $clave => $valor) {
                                        echo '<option>' . $valor['0'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-secondary" data-dismiss = "modal"><?php echo $strings['closetabla']; ?></button>
                            <button type = "submit" class = "btn btn-primary"><?php echo $strings['savetabla']; ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        
        

        <div class="container" >
            <form  id="form" name="form" action='NOTIFICACION_Controller.php'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Insertar Notificacion']; ?></label><br>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['destinatarioNotificacion']; ?></label><br>
                    <input class="form" id="destinatarioNotificacion" name="destinatarioNotificacion" size="50" type="text" required="true" value="<?php echo $this->desti ?>">
                </div>
                <td><a data-toggle="modal" href="#myModal1" onclick="changeIdAction()"><button type="button" class="btn btn-success"><?php echo $strings['Gestión de Usuarios']; ?></button></a></td>
                <td><a data-toggle="modal" href="#myModal2" onclick="changeIdAction()"><button type="button" class="btn btn-success"><?php echo $strings['Gestión de Actividades']; ?></button></a></td>

                <br> <br> 

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['asuntoNotificacion']; ?></label><br>
                    <input class="form" id="asuntoNotificacion" name="asuntoNotificacion" size="50" type="text" required="true"/>
                </div>

               <div class="form-group">
                    <label class="control-label" ><?php echo $strings['mensajeNotificacion']; ?></label><br>
                    <textarea class="form" id="mensajeNotificacion" name="mensajeNotificacion" rows="20" cols="70" required="true"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" id="username" name="username" size="25" type="text" required="true" value='usuario'/>
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
