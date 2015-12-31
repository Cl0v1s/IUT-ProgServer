<link rel="stylesheet" href="css/views/artist/base.css">
<div>
  <div id="bio">
    <img src="{{Photo}}">
    <div>
      <h1>{{Prénom_Musicien}} {{Nom_Musicien}}</h1>
      <span>{{Année_Naissance}} - {{Année_Mort}}</span>
    </div>
  </div>

  <div class="list">
    [[oeuvres]]<!--Libellé Abrégé est dans la table Genre-->
      <a href="/list-albums/{{Code_Oeuvre}}"><div class="entry {{pair}}"><img src="{{Pochette}}"><div><h1>{{Titre_Album}} - {{Année_Album}}</h1><span>{{Nom_Editeur}}<br>{{Libellé_Abrégé}}<br><a>Cliquez pour consulter la page de l'album</a></span></div></div></a>
    [[/oeuvres]]
  </div>
</div>
