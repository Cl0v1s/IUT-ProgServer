<!DOCTYPE html>
<html>
  <head>
    <title>Musique</title>
    <meta charset="utf-8">
    <meta lang="fr">

    <script type="text/javascript" src="{{_url}}/js/libs/md5.js"></script>
    <script type="text/javascript" src="{{_url}}/js/libs/jquery-2.1.4.min.js"></script>
    <!--Inclusion des pages css-->
    <link rel="stylesheet" type="text/css" href="{{_url}}/css/libs/reset.css">
    <link rel="stylesheet" href="{{_url}}/css/views/base.css">


  </head>
  <body>
    <!--Définition de la barre de menu-->
    <header>
      <div></div>
      <img src="{{_url}}/assets/icons/disk.svg">
      <span>
        MUSIQUE
      </span>
      <nav>
        <a class="index" href="{{_url}}/index"></a>
        [[!_logged]]<a class="login" href="{{_url}}/login"></a>[[/_logged]]
        [[_logged]]<a class="profil" href="{{_url}}/profil"></a>[[/_logged]]
      </nav>
    </header>
    <div id="content">
      {{__CHILD__}}
    </div>
    <!--<footer>
      Site dévelopé par Rafael Lagoinha et Clovis Portron.
    </footer>-->
  </body>
</html>
