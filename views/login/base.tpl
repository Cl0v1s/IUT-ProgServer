<link rel="stylesheet" href="css/views/login/base.css">
<script type="text/javascript" src="js/views/login/base.js"></script>
<div>
  <div id="login">
    <h1>Connexion</h1>
    <span>Entrez vos informations de connexion</span>
    <form id="form" action="/log" method="post">
      <input id="name" name="name" type="text" placeholder="Identifiant...">
      <input id="password" name="password" type="password" placeholder="Mot de passe...">
      <input id="hash" name="hash" type="hidden">
      <br>
      <a class="login"></a>
    </form>
  </div>
</div>
