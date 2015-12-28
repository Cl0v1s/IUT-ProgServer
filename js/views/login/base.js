$(document).ready(function()
{
  $("a.login").click(function()
  {
    var name=$("#name").val();
    var password=$("#password").val();
    var hash = CryptoJS.MD5(CryptoJS.MD5(name)+password);
    $("#hash").val(hash);
    $("#form").submit();
  });
});
