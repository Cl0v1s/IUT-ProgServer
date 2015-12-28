<?php
  $error_404 = function($parameters)
  {
    echo "Erreur 404";
  };
  $_system_registry->registerPage("404","",$error_404);

?>
