<?php
  include_once 'registryConfiguration.php';
  include_once 'Session.php';
  include_once 'registry.php';
  include_once 'template.php';

  $_system_registry = new Registry(new RegistryConfiguration("http://localhost:8000","index", false,"Europe/Paris", NULL));

?>
