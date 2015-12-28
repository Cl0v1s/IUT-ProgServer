$(document).ready(function()
{
  $("a.login").onclick(function()
  {
    var name=$("#name").val();
    var password=$("#password").val();
    var hash = CryptoJS.MD5(CryptoJS.MD5(name)+password);

    var form = $("<form action='/log' method='post'></form>")
    form.append("<input name='hash' value='"+hash+"'>")
    form.submit();
  });
});
