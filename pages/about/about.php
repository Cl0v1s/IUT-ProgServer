<?php
    //PAGE D'ACCEUIL
    $about = function($parameters)
    {
        template("views/about/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("about", "", $about);
?>
