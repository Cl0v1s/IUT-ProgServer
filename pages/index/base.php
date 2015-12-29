<?php
    //PAGE D'ACCEUIL
    $index = function($parameters)
    {
        //TODO: A supprimer une fois les tests terminés
        $parameters["_logged"] = true;
        template("views/index/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("index", "", $index);
?>
