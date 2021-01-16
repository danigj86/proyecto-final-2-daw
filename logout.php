<?php
//DESTRUYE LA SESION, SUS VARIABLES Y REDIRIGE A LA PAGINA
  session_start();

  session_unset();

  session_destroy();

  header('Location: /masterphp/proyecto');
?>
