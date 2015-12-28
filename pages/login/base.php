<?php
    //PAGE D'ACCEUIL
    $login = function($parameters)
    {
        template("view/login/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("index", "", $login);
?>
