<?php
    //PAGE DE LOGIN
    $login = function($parameters)
    {
        template("views/login/login.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("login", "", $login);

    $auth = function($parameters)
    {
      global $_system_registry;
        if(!isset($_POST["hash"]))
        {
          header("Location:/index");
          return;
        }
        $parameters["login"] = false;
        $_POST["hash"] = Template::makeTextSafe($_POST["hash"]);
        if(Session::checkCredentials($_POST["hash"]))
        {
            $parameters["login"] = true;
            Session::saveCredentialsHash($_POST["hash"]);
            //Création des variables des paniers
            $basket = array();
            Session::addEntry("basket", $basket);
        }
        template("views/login/auth.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("auth", "", $auth);
?>
