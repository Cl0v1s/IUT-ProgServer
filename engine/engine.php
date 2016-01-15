<?php
  include_once 'registryConfiguration.php';
  include_once 'Session.php';
  include_once 'registry.php';
  include_once 'template.php';
  include_once 'Model.php';

  $_system_registry = new Registry(new RegistryConfiguration("http://info-timide.iut.u-bordeaux.fr/perso/2016/cportron/Projet","index", new Model("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD"),"Europe/Paris", NULL));

?>
