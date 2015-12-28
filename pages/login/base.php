<?php
    //PAGE DE LOGIN
    $login = function($parameters)
    {
        template("views/login/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("login", "", $login);

    $log = function($parameters)
    {
        $parameters["hash"] = Template::makeTextSafe($parameters["hash"]);
        if(Session::checkCredentials($parameters["hash"]))
        {
            $parameters["login"] = true;
            Session::saveCredentialsHash($parameters["hash"]);
        }
        $parameters["login"] = false;
        template("views/login/base.tpl", $parameters, "views/base.tpl");
    }
    $_system_registry->registerPage("log", "", $log);
?>
