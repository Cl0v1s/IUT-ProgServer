<link rel="stylesheet" href="{{_url}}/css/views/album/base.css">
<script src="{{_url}}/js/views/album/base.js"></script>
<div>
	<div id="album">
		<img src="{{Pochette}}">
		<div>
			<h1>{{Titre_Album}}</h1>
			<span>{{Annee_Album}}</span>
			<a class="amazon" data-asin="{{ASIN}}">Cliquez ici pour voir l'album sur amazon</a>
		</div>
	</div>
	<div class="list">
		[[records]]
			<div class="entry {{pair}}"><h1>{{Titre}}</h1><span>{{Duree}} pour {{Prix}}€</span><audio src="{{Extrait}}" controls></audio><a class="button" data-url="{{_url}}" data-code="{{Code_Morceau}}">Ajouter au panier</a></div>
		[[/records]]
	</div>
</div>
