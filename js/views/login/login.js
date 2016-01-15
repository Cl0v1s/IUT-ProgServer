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
  
  
  
  
  
  $("input[type=button]").click(function(e)
  {
    $("#name").removeClass("error");
    $("#password").removeClass("error");
    var name=$("#name").val();
    var password=$("#password").val();
    e.preventDefault();
    if(name.length <= 0)
    {
      $("#name").addClass("error");
      return;
    }
    if(password.length <= 0)
    {
      $("#password").addClass("error");
      return;
    }
    var hash = CryptoJS.MD5(CryptoJS.MD5(name)+password);
    $("#hash").val(hash);
    $("#form").submit();
  });
});
