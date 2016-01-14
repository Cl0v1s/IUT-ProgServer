<?php

    $artwork = function($parameters)
    {
        global $_system_registry;

        if(!isset($parameters["code"]) || $parameters["code"]=="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les albums dans lesquels l'oeuvre est présente
        $sql = "SELECT DISTINCT Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.Pochette as Pochette FROM Album
INNER JOIN Disque ON Disque.Code_Album = Album.Code_Album
INNER JOIN Composition_Disque ON Disque.Code_Disque = Composition_Disque.Code_Disque
INNER JOIN Enregistrement ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau
INNER JOIN Composition ON Composition.Code_Composition = Enregistrement.Code_Composition
INNER JOIN Composition_Oeuvre ON Composition_Oeuvre.Code_Composition = Composition.Code_Composition
INNER JOIN Oeuvre ON Oeuvre.Code_Oeuvre = Composition_Oeuvre.Code_Oeuvre
WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
        }
        $parameters["albums"] = $results;
        // Récupère les informations sur l'oeuvre
        $results = $_system_registry->getModel()->query("SELECT Oeuvre.Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année_Oeuvre as Année WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'")->fetch();
        $parameters["Titre_Oeuvre"] = $results["Titre_Oeuvre"];
        $parameters["Sous_Titre"] = $results["Sous_Titre"];
        $parameters["Annee"] = $results[utf8_decode("Année")];
        template("views/artwork/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artwork", "/code", $artwork);

?>
