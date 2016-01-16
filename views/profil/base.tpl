<link rel="stylesheet" href="{{_url}}/css/views/profil/base.css">
<script type="text/javascript" src="{{_url}}/js/views/profil/base.js"></script>
<div>
  <div id="list">
    <h1>Bonjour {{username}} !</h1>
    <span>
      <p>Voici les articles que vous avez sélectionné.</p>
    </span>
    <div class="list">
              <!--TODO: AJouter un lien vers la page de l'enregistrement-->
      <a class="button" href="{{_url}}/profil/buy" style="height: 50px;line-height: 50px; vertical-align: middle;">Acheter le panier</a>
      [[achat]]
        <div class="entry {{pair}}"><span><h2>{{Titre}} {{Prenom_Musicien}} {{Nom_Musicien}}</h2>à {{Prix}}€</span><audio src="{{Extrait}}" controls></audio><form action="{{_url}}/profil/delete" method="post"><input type="hidden" name="id" value="{{Code_Morceau}}"><center><input type="submit" value="Supprimer du panier"></center></form></a></div>
      [[/achat]]
      <h2>Total: {{total}}€</h2>
    </div>
  </div>
</div>
