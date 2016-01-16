<link rel="stylesheet" href="{{_url}}/css/views/artwork/base.css">
<div>
  <br><br>
  <center><h1>Description d'une Oeuvre et liste des albums la contenant</h1></center><br>
  <div id="artwork">
    <h1>{{Titre_Oeuvre}}</h1>
    <h2>{{Sous_Titre}}</h2>
    <span>Paru en {{Annee}}</span>
  </div>
  <div class="list">
    <!--TODO: ajouter le code relatif à Amazon-->
    [[albums]]
      <a href="{{_url}}/album/{{Code_Album}}"><div class="entry {{pair}}"><img src="{{Pochette}}"><span><h1>{{Titre_Album}}</h1><span>Paru en {{Annee_Album}}<br>ASIN: {{ASIN}}</span></span></div></a>
    [[/albums]]
  </div>
</div>
