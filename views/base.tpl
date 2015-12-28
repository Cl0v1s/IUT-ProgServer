<html>
  <head>
    <title>Musique</title>
    <meta charset="utf-8">
    <meta lang="fr">

    <!--Inclusion des pages css-->
    <link rel="stylesheet" type="text/css" href="css/libs/reset.css">
    <link rel="stylesheet" href="css/views/base.css">


  </head>
  <body>
    <!--Définition de la barre de menu-->
    <header>
      <div></div>
      <img src="assets/icons/disk.svg">
      <span>
        MUSIQUE
      </span>
      <nav>
        <a class="login" href="/login"></a>
      </nav>
    </header>
    <div id="content">
      {{__CHILD__}}
    </div>
    <footer>
      Site dévelopé par Rafael Lagoinha et Clovis Portron.
    </footer>

    <!--TODO:script de livereload à supprimer-->
    <script src="http://localhost:35729/livereload.js"></script>
  </body>
</html>
