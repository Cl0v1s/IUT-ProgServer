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
			<a href="{{_url}}/record/{{Code_Morceau}}"><div class="entry {{pair}}"><h1>{{Titre}}</h1><span>{{Durée}} pour {{Prix}}</span><audio src="{{Extrait}}" controls></audio></div></a>
		[[/records]]
	</div>
</div>