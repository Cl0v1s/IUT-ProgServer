<?php
    //PAGE DE LOGIN
    $login = function($parameters)
    {
        template("views/login/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("login", "", $login);

    $log = function($parameters)
    {
        $_POST["hash"] = Template::makeTextSafe($_POST["hash"]);
        //TODO: A supprimer pour la version finale une fois testé
        /*if(Session::checkCredentials($_POST["hash"]))
        {
            $parameters["login"] = true;
            Session::saveCredentialsHash($_POST["hash"]);
        }*/
        //$parameters["login"] = false;
        $parameters["login"] = true;
        template("views/login/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("log", "", $log);
?>
