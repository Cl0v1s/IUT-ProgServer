<link rel="stylesheet" href="{{_url}}/css/views/login/auth.css">
<div>
  [[login]]
    <div class="info">Vous êtes maintenant connecté.<br><a class="button" href="{{_url}}/index">Cliquez ici pour retourner à l'index</a></div>
  [[/login]]
  [[!login]]
    <div class="info">Les informations transmises n'ont pas permis de vous identifier.<br><a class="button" href="{{_url}}/login">Cliquez ici pour réessayer</a></div>
  [[/login]]
</div>
