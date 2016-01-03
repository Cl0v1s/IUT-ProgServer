<link rel="stylesheet" href="{{_url}}/css/views/artist/base.css">
<div>
  <div id="bio">
    <img src="{{Photo}}">
    <div>
      <h1>{{Prénom_Musicien}} {{Nom_Musicien}}</h1>
      <span>{{Année_Naissance}} - {{Année_Mort}}</span>
    </div>
  </div>

  <div class="list">
    [[oeuvres]]
      <a href="{{_url}}/artwork/{{Code_Oeuvre}}"><div class="entry {{pair}}"><div><h1>{{Titre_Oeuvre}} - {{Sous_Titre}}</h1><span>{{Année}} - {{Opus}}<br><a>Cliquez pour consulter la liste des albums</a></span></div></div></a>
    [[/oeuvres]]
  </div>
</div>
