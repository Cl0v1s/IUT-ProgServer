<?php

    $artwork = function($parameters)
    {
        global $_system_registry;

        if(!isset($parameters["code"]) or $parameters["code"]="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les albums dans lesquels l'oeuvre est présente
        $sql = "SELECT DISTINCT Oeuvre.Code_Oeuvre, Composition_Oeuvre.Code_Composition, Enregistrement.Code_Morceau, Composition_Disque.Code_Disque, Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.Pochette as Pochette FROM Oeuvre ";
        $sql = $sql."INNER JOIN Composition_Oeuvre on Composition_Oeuvre.Code_Oeuvre = Oeuvre.Code_Oeuvre INNER JOIN Composition on Composition.Code_Composition = Composition_Oeuvre.Code_Composition INNER JOIN Enregistrement on Enregistrement.Code_Composition = Enregistrement.Code_Composition ";
        $sql = $sql."INNER JOIN Composition_Disque on Composition_Disque.Code_Morceau = Enregistrement.Code_Morceau INNER JOIN Disque on Disque.Code_Disque = Composition_Disque.Code_Disque INNER JOIN Album on Album.Code_Album = Disque.Code_Album WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'";
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
        $results = $_system_registry->getModel()->query("SELECT DISTINCT Oeuvre.Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année_Oeuvre as Année WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'")->fetchall();
        $parameters["Titre_Oeuvre"] = $results[utf8_decode("Titre_Oeuvre")];
        $parameters["Sous_Titre"] = $results[utf8_decode("Sous_Titre")];
        $parameters["Annee"] = $results["Annee"];
        template("views/artwork/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artwork", "/code", $artwork);

?>
