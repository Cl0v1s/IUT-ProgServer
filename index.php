<?php
  ////////////////////////////////////////////////////////////////////////////////
  //APPEL SYSTEME, NE PAS MODIFIER
  include_once 'engine/engine.php';
  ////////////////////////////////////////////////////////////////////////////////


  ////////////////////////////////////////////////////////////////////////////////
  //Inclusion des pages
  //Ajoutez ici le chemin des scripts php chargé de gérer chacune de vos pages
  //Préferez le chemin suivant: pages/nom_vue/nom_page.php
  //Ainsi pour la gestion de la page normale de l'index on aura le chemin suivant
  //include_once 'pages/index/base.php'
  //Dans le cas d'une "sous-page" relative à l'index, par exemple si vous souhaitez ajouter
  //une page spéciale pour la gestion des abonnés alors ajoutez également la page:
  //include_once 'pages/index/suscribers.php'

  //Ecrire votre code ici
  include_once "pages/index/base.php";
  include_once "pages/login/base.php";
  include_once "pages/error/base.php";
  ////////////////////////////////////////////////////////////////////////////////


  ////////////////////////////////////////////////////////////////////////////////
  //APPEL SYSTEME, NE PAS MODIFIER
  $_system_registry->examine();
  ////////////////////////////////////////////////////////////////////////////////



?>
