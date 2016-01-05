$(document).ready(function()
{
  //Ajout de la fonction d'envoi de la requete d'ajout au panier
  $("a.button").click(function()
  {
    var self = $(this);
    var id = self.data("code");
    var url = self.data("url");
    $.post(url+"/profil/add", {"id":id}, function(data)
    {
      //SI le résultat de la requete est ok
      if(data.state == "OK")
      {
        self.addClass("valid");
        self.off("click");
      }
    });
  });
});
