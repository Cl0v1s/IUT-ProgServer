<?php
  include_once 'registryConfiguration.php';
  include_once 'Session.php';
  include_once 'registry.php';
  include_once 'template.php';

  $_system_registry = new Registry(new RegistryConfiguration("http://127.0.0.1","index", "sqlite:engine/database.db","Europe/Paris", NULL));

?>
