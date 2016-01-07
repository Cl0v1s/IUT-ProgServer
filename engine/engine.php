<?php
  include_once 'registryConfiguration.php';
  include_once 'Session.php';
  include_once 'registry.php';
  include_once 'template.php';

  $_system_registry = new Registry(new RegistryConfiguration("http://info-timide.iut.u-bordeaux.fr/perso/2016/cportron/Projet26","index", false,"Europe/Paris", NULL));

?>
