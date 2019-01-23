<?php

//VISTA PARA LA CONSULTA DE CURSOS
class CURSO_FILTER {

    private $volver;
    private $cont;
    
    function __construct($volver) {
        $this->volver = $volver;
        $this->render();
    }

    function render() {
		include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
		?>
		<div class="container" >
           <form method="POST" action="../Controllers/CURSO_Controller.php?accion=filtrar">
                <div class="form-group" >
                    <label class="control-label" ><?php echo $strings['Filtrar Cursos']; ?></label><br>
                </div>
				
                <div class="form-group">
                    <label class="control-label" ><?php echo $strings['username']; ?></label><br>
                    <input class="form-control" id="username" name="username" size="80" type="text">
                </div>     
				
                <button type="submit" class="btn btn-primary"><?php echo $strings['filtrar'];?></button>
				<a class="form-link" href="<?php echo $this->volver ;?>"><?php echo $strings['Volver'];?></a>
            </form>
        </div>
		<?php

        include '../Views/footer.php';
    }

//fin metodo render
}
