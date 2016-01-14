<?php

    $artist = function($parameters)
    {
        global $_system_registry;

        if(!isset($parameters["code"]) || $parameters["code"]=="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les oeuvres et les enregistrements de l'artiste concerné
        $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Composer.Code_Oeuvre as Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année as Année, Oeuvre.Opus as Opus FROM Musicien ";
        $sql = $sql."LEFT JOIN Composer ON Composer.Code_Musicien = Musicien.Code_Musicien LEFT JOIN Oeuvre ON Oeuvre.Code_Oeuvre = Composer.Code_Oeuvre ";
        $sql = $sql."WHERE Musicien.Code_Musicien = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
          $results[$i]["Annee"] = $results[$i][utf8_decode("Année")];
        }
        $parameters["oeuvres"] = $results;
        // Récupère les informations sur l'ariste
        $results = $_system_registry->getModel()->query("SELECT Musicien.Code_Musicien as Code_Musicien, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Musicien.Année_Naissance as Année_Naissance, Musicien.Année_Mort as Année_Mort, Musicien.Photo as Photo FROM Musicien WHERE Musicien.Code_Musicien = '".$parameters["code"]."'")->fetch();
        $parameters["Nom_Musicien"] = $results["Nom_Musicien"];
        $parameters["Prénom_Musicien"] = $results["Prénom_Musicien"];
        $parameters["Année_Naissance"] = $results["Année_Naissance"];
        $parameters["Année_Mort"] = $results["Année_Mort"];
        $parameters["Photo"] = $parameters["_url"]."/converter/picture/artist/".$results["Code_Musicien"];
        template("views/artist/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artist", "/code", $artist);

?>
