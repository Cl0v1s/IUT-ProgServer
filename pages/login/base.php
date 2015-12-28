<?php
    //PAGE DE LOGIN
    $login = function($parameters)
    {
        template("views/login/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("login", "", $login);
?>
