$(document).ready(function()
{

  //Supression de l'action lors de l'appui sur la touche entrée
  $('#search form').on('keyup keypress', function(e) {
  var code = e.keyCode || e.which;
  if (code == 13) {
    e.preventDefault();
    return false;
  }
  });


  $("#search input[type=button]").click(function()
  {
      var url = $("input[type=button]").data("url");
    var name = $("#name").val();
    if(name.length <= 0)
      name="all";
    var type = $("#type").val();
    window.location=url+"/search-artist/"+type+"/"+name;
  });
});
