$(document).ready(function()
{
  console.log("link des boutons");
  //Ajout de la fonction d'envoi de la requete d'ajout au panier
  $("a.button").click(function()
  {
    var self = $(this);
    var id = self.data("code");
    var url = self.data("url");
    console.log("requete lancée à "+url+"/profil/add avec id= "+id);
    $.post(url+"/profil/add", {"id":id}, function(data)
    {
      //SI le résultat de la requete est ok
      if(data.state == "ok")
      {
        self.addClass("valid");
        self.off("click");
        self.html("Ajouté !");
        console.log("c'est fait !");
      }
    }).fail(function(data){console.log(data);});
  });
});
