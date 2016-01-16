<link rel="stylesheet" href="{{_url}}/css/views/index/base.css">
<script type="text/javascript" src="{{_url}}/js/views/index/base.js"></script>
<div>
  <div id="search">
    <h1>Notre catalogue</h1>
    <span>Recherchez la musique qui vous correspond</span>
    <form>
      <input id="name" name="name" type="text" placeholder="Nom...">
      <select id="type">
        <option value="all">Tout</option>
        <option value="director">Chef d'orchestre</option>
        <option value="composer">Compositeur</option>
        <option value="performer">Interprète</option>
      </select>
      <input type="button" data-url={{_url}} value="Rechercher">
    </form>
  </div>
  <div id="about">
    <h1>A propos</h1>
    <span>
      <p>
        Ce site permet d'effectuer des recherches sur différents musiciens répertoriés dans la base de données hébergée au sein du département informatique de l'IUT de Bordeaux.<br><br>
        Il a été réalisé dans le cadre du projet de programmation web coté serveur.<br><br>
        Il a été développé par <a href="https://twitter.com/raftilu">@Rafael Lagoinha</a> et <a href="https://twitter.com/cp0rtron">@Clovis Portron</a>.
        <center><a href="{{_url}}/about">En savoir plus.</a></center>
      </p>
    </span>
  </div>
</div>
