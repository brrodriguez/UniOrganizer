
<!DOCTYPE html>
<!--VISTA PRINCIPAL-->
<?php
include '../Functions/LibraryFunctions.php';
if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
include './header.php';
?>
<html>
    <head>
        <script type="text/javascript" src="../css/lib/alertify.js"></script>
        <link rel="stylesheet" href="../css/themes/alertify.core.css" />
        <link rel="stylesheet" href="../css/themes/alertify.default.css" />
    </head>
	<div class="row top-buffer">

<table class="table">
  <thead>
    <tr>
      <th><?= $strings['Monday'] ?></th>
      <th><?= $strings['Tuesday'] ?></th>
      <th><?= $strings['Wednesday'] ?></th>
      <th><?= $strings['Thursday'] ?></th>
      <th><?= $strings['Friday'] ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
      <?php foreach ($days1 as $day => $value) {?>
            <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
            <?php if($value["actividad"]){?>
              <p><a href="index.php?controller=activity&amp;action=showone&amp;id=<?php echo $value["actividad_id"] ?>"><?php echo $value["actividad"] ?></a><p>
            <?php } else { ?>
              <p><a href="index.php?controller=event&amp;action=showone&amp;id=<?php echo $value["evento_id"] ?>"><?php echo $value["evento"] ?></a><p>
            <?php } ?>
            <p><a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $value["user_id"] ?>"><?php echo $value["user"] ?></a><p>
            <p><a href="index.php?controller=space&amp;action=showone&amp;id=<?php echo $value["space_id"] ?>"><?php echo $value["space"] ?></a><p>
            <p><a href="index.php?controller=assistance&amp;action=show&amp;sesion=<?php echo $value["id"] ?>&amp;user=<?php echo $value["user_id"] ?>" class="btn btn-default"><?= i18n("Check Assistance") ?></a></p>

            <hr>
        <?php }?>
        </td>
        <td class="active">
          <?php foreach ($days2 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"] ?></p>
              <?php if($value["actividad"]){?>
                <p><a href="index.php?controller=activity&amp;action=showone&amp;id=<?php echo $value["actividad_id"] ?>"><?php echo $value["actividad"] ?></a><p>
              <?php } else { ?>
                <p><a href="index.php?controller=event&amp;action=showone&amp;id=<?php echo $value["evento_id"] ?>"><?php echo $value["evento"] ?></a><p>
              <?php } ?>
              <p><a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $value["user_id"] ?>"><?php echo $value["user"] ?></a><p>
              <p><a href="index.php?controller=space&amp;action=showone&amp;id=<?php echo $value["space_id"] ?>"><?php echo $value["space"]."\n" ?></a><p>
              <p><a href="index.php?controller=assistance&amp;action=show&amp;sesion=<?php echo $value["id"] ?>&amp;user=<?php echo $value["user_id"] ?>" class="btn btn-default"><?= i18n("Check Assistance") ?></a></p>

              <hr>
          <?php }?>
        </td>
        <td>
          <?php foreach ($days3 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"] ?></p>
              <?php if($value["actividad"]){?>
                <p><a href="index.php?controller=activity&amp;action=showone&amp;id=<?php echo $value["actividad_id"] ?>"><?php echo $value["actividad"] ?></a><p>
              <?php } else { ?>
                <p><a href="index.php?controller=event&amp;action=showone&amp;id=<?php echo $value["evento_id"] ?>"><?php echo $value["evento"] ?></a><p>
              <?php } ?>
              <p><a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $value["user_id"] ?>"><?php echo $value["user"] ?></a><p>
              <p><a href="index.php?controller=space&amp;action=showone&amp;id=<?php echo $value["space_id"] ?>"><?php echo $value["space"]."\n" ?></a><p>
              <p><a href="index.php?controller=assistance&amp;action=show&amp;sesion=<?php echo $value["id"] ?>&amp;user=<?php echo $value["user_id"] ?>" class="btn btn-default"><?= i18n("Check Assistance") ?></a></p>

              <hr>
          <?php }?>
        </td>
        <td class="active">
          <?php foreach ($days4 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <?php if($value["actividad"]){?>
                <p><a href="index.php?controller=activity&amp;action=showone&amp;id=<?php echo $value["actividad_id"] ?>"><?php echo $value["actividad"] ?></a><p>
              <?php } else { ?>
                <p><a href="index.php?controller=event&amp;action=showone&amp;id=<?php echo $value["evento_id"] ?>"><?php echo $value["evento"] ?></a><p>
              <?php } ?>
              <p><a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $value["user_id"] ?>"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="index.php?controller=space&amp;action=showone&amp;id=<?php echo $value["space_id"] ?>"><?php echo $value["space"]."\n" ?></a><p>
              <p><a href="index.php?controller=assistance&amp;action=show&amp;sesion=<?php echo $value["id"] ?>&amp;user=<?php echo $value["user_id"] ?>" class="btn btn-default"><?= i18n("Check Assistance") ?></a></p>

              <hr>
          <?php }?>
        </td>
        <td>
          <?php foreach ($days5 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <?php if($value["actividad"]){?>
                <p><a href="index.php?controller=activity&amp;action=showone&amp;id=<?php echo $value["actividad_id"] ?>"><?php echo $value["actividad"] ?></a><p>
              <?php } else { ?>
                <p><a href="index.php?controller=event&amp;action=showone&amp;id=<?php echo $value["evento_id"] ?>"><?php echo $value["evento"] ?></a><p>
              <?php } ?>
              <p><a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $value["user_id"] ?>"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="index.php?controller=space&amp;action=showone&amp;id=<?php echo $value["space_id"] ?>"><?php echo $value["space"]."\n" ?></a><p>
              <p><a href="index.php?controller=assistance&amp;action=show&amp;sesion=<?php echo $value["id"] ?>&amp;user=<?php echo $value["user_id"] ?>" class="btn btn-default"><?= i18n("Check Assistance") ?></a></p>

              <hr>
          <?php }?>
        </td>
      </tr>
  </tbody>
</table>
</div>

<?php
include './footer.php';
?>