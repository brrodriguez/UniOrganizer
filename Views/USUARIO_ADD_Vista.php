<?php

//VISTA PARA LA INSERCIÓN DE USUARIOS
class USUARIO_Insertar {

    private $volver;
    
    function __construct($volver, $numTipo) {
        $this->volver = $volver;
		$this->numTipo = $numTipo;
        $this->render();
    }

    function render() {
		?>
        <script type="text/javascript" src="../js/validate.js"></script>
        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php'; ?>

        <div class="container" >
            <form  id="form" name="form" action='USUARIO_Controller.php?user=admin'  method='post'   enctype="multipart/form-data">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Insertar Usuario']; ?></label><br>
                </div>
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['username']; ?>*</label><br>
                    <input onchange="return valida_envia_username()" class="form" id="username" name="username" size="20" type="text" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['password']; ?>*</label><br>
                    <input onchange="return valida_envia_password()" class="form" id="password" name="password" size="20" type="password" required="true"/>
                </div>   

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['nombre']; ?>*</label><br>
                    <input onchange="return valida_envia_nombre()" class="form" id="nombre" name="nombre" size="50" type="text" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['apellidos']; ?>*</label><br>
                    <input onchange="return valida_envia_apellidos()" class="form" id="apellidos" name="apellidos" size="50" type="text" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['dni']; ?>*</label><br>
                    <input onchange="return valida_envia_dni()" class="form" id="dni" name="dni" size="9" type="text" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['fechaNac']; ?>*</label><br>
                    <input onchange="return valida_envia_fechaNac()" class="form" id="fechaNac" name="fechaNac" type="date" required="true"/>
                </div>


                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['niu']; ?>*</label><br>
                    <input onchange="return valida_envia_niu()" class="form" id="niu" name="niu" size="12" type="text" required="true"/>
                </div>

                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['email']; ?>*</label><br>
                    <input onchange="return valida_envia_email()" class="form" id="email" name="email" size="50" type="email" required="true"/>
                </div>
				
				<div class="form-group">
                    <input type="hidden" id="tipoUsuario" name="tipoUsuario" size="10" type="text" required="true" value="<?php echo $this->numTipo ?>" readonly="true"/>
                </div>
			

                <input type='submit' onclick="return valida_envia_USUARIO()" name='accion'  value="<?php echo $strings['Insertar']; ?>">
                <a class="form-link" href="<?php echo $this->volver ?>"><?php echo $strings['Volver']; ?>
            </form>
        </div>
        <?php
        include '../Views/footer.php';
    }

//fin metodo render
}
