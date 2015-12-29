<?php
    //PAGE DE LOGIN
    $login = function($parameters)
    {
        template("views/login/login.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("login", "", $login);

    $log = function($parameters)
    {
        if(!isset($_POST["hash"]))
        {
          header("Location:/index");
          return;
        }
        $_POST["hash"] = Template::makeTextSafe($_POST["hash"]);
        //TODO: A supprimer pour la version finale une fois testé
        /*if(Session::checkCredentials($_POST["hash"]))
        {
            $parameters["login"] = true;
            Session::saveCredentialsHash($_POST["hash"]);
        }*/
        //$parameters["login"] = false;
        $parameters["login"] = true;
        template("views/login/log.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("log", "", $log);
?>
