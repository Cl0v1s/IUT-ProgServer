$(document).ready(function()
{
  $("input[type=button]").click(function()
  {
    //TODO: ajouter un controle des champs
    var name=$("#name").val();
    var password=$("#password").val();
    var hash = CryptoJS.MD5(CryptoJS.MD5(name)+password);
    $("#hash").val(hash);
    $("#form").submit();
  });
});
