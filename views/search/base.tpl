<link rel="stylesheet" href="{{_url}}/css/views/search/base.css">
<div>
  <div>
    <!--A RAF': Ta page doit etre de la forme /list-artists/type/name-->
    <h1>Résultats de la recherche de {{name}} parmi {{type}}</h1>
    <div class="list">
      [[results]]
        <a href="{{_url}}/artist/{{Code_Musicien}}"><div class="entry {{pair}}"><img src="{{Photo}}"><h1>{{Prenom_Musicien}} {{Nom_Musicien}}</h1><span>{{Annee_Naissance}} - {{Annee_Mort}}</span><span> De {{Nom_Pays}}</span></div></a>
      [[/results]]
    </div>
  </div>
</div>
