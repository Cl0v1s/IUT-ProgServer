$(document).ready(function()
{
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
