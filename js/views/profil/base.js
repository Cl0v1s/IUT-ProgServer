$(document).ready(function()
{
  $("a.delete").click(function()
  {
    var url = $(this).data("url");
    var id = $(this).data("id");
    var self = $(this);
    $.post(url+"/profil/delete", {"id": id}, function(data)
    {
      if(data.state == "OK")
      {
        self.parent().remove();
      }
    });
  });
});
