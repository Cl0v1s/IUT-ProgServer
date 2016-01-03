$(document).ready(function()
{
  $("#search input[type=button]").click(function()
  {
    var name = $("#name").val();
    if(name.length <= 0)
      name="all";
    var type = $("#type").val();
    window.location="/search-artist/"+type+"/"+name;
  });
});
