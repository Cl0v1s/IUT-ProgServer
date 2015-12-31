<link rel="stylesheet" href="{{_url}}/css/views/list/list-artists.css">
<div>
  <div>
    <!--A RAF': Ta page doit etre de la forme /list-artists/type/name-->
    <h1>Résultats de la recherche de {{name}} parmis {{type}}</h1>
    <div class="list">
      [[results]]
        <a href="{{_url}}/artist/{{Code_Musicien}}"><div class="entry {{pair}}"><img src="{{Photo}}"><h1>{{Prénom_Musicien}} {{Nom_Musicien}}</h1><span>{{Année-Naissance}} - {{Année-Mort}}</span><span>De {{Nom_Pays}}</span></div></a>
      [[/results]]
    </div>
  </div>
</div>
