<link rel="stylesheet" href="{{_url}}/css/views/album/base.css">
<script src="{{_url}}/js/views/album/base.js"></script>
<div>
	<div id="album">
		<img src="{{Pochette}}">
		<div>
			<h1>{{Titre_Album}}</h1>
			<span>{{Annee_Album}}</span>
		</div>

	</div>
	<br><br>
	<div style="clear:both;">
		<br><br>
		<h1>Informations Amazon</h1>
		<center><table border="1">
			<tr>
				<td>Titre</td><td>Groupe de Produit</td><td>Fabricant</td><td>Auteur(s)</td>
			</tr>
			<tr>
				<td>{{Amazon_Title}}</td><td>{{Amazon_Group}}</td><td>{{Amazon_Manu}}</td><td>[[Amazon_Creators]]<b>{{name}}</b>, {{role}} <br>[[/Amazon_Creators]]</td>
			</tr>
		</table><br>
		<span>Prix Amazon Usité: {{Amazon_Price}}</span></center>
	</div>
	<div class="list">
		[[records]]
			<div class="entry {{pair}}"><h1>{{Titre}}</h1><span>{{Duree}} pour {{Prix}}€</span><audio src="{{Extrait}}" controls></audio><form action="{{_url}}/profil/add" method="post"><input type="hidden" value="{{_url}}/{{_current_page}}/{{Code_Album}}" name="callback"><input type="hidden" name="id" value="{{Code_Morceau}}"><center><input type="submit" value="Ajouter au panier"></center></form></div>
		[[/records]]
	</div>
</div>
