<link rel="stylesheet" href="{{_url}}/css/views/profil/base.css">
<script type="text/javascript" src="{{_url}}/js/views/profil/base.js"></script>
<div>
  <div id="list">
    <h1>Bonjour {{username}} !</h1>
    <span>
      <p>Voici les articles que vous avez sélectionné.</p>
    </span>
    <div class="list">
      [[achat]]
        <!--TODO: AJouter un lien vers la page de l'enregistrement-->
        <div class="entry {{pair}}"><span><h2>{{Titre}} de {{Prénom_Musicien}} {{Nom_Musicien}}</h2>à {{Prix}}€</span><a class="delete" data-url="{{_url}}"  data-id="{{Code_Morceau}}"></a></div>
      [[/achat]]
      <h2>Total: {{total}}€</h2>
    </div>
  </div>
</div>
