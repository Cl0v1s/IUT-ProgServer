<link rel="stylesheet" href="{{_url}}/css/views/album/base.css">
<div>
	<div id="album">
		<img src="{{Pochette}}">
		<div>
			<h1>{{Titre_Album}}</h1>
			<span>{{Année_Album}}</span>
			<a class="amazon" data-asin="{{ASIN}}">Cliquez ici pour voir l'album sur amazon</a>
		</div>
	</div>
	<div class="list">
		[[records]]
			<div class="entry {{pair}}"><h1>{{Titre}}</h1><span>{{Durée}} pour {{Prix}}</span><audio src="{{Extrait}}" controls></audio><a class="button" data-code="{{Code_Morceau}}">Ajouter au panier</a></div>
		[[/records]]
	</div>
</div>