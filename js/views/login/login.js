$(document).ready(function()
{
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
