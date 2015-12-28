<?php
    //PAGE D'ACCEUIL
    $index = function($parameters)
    {
        template("view/index/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("index", "", $index);
?>
