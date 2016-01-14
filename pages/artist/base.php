<?php

    $artist = function($parameters)
    {
        if(!isset($parameters["code"]) or $parameters["code"]="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les oeuvres et les enregistrements de l'artiste concerné
        $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Composer.Code_Oeuvre as Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année as Année, Oeuvre.Opus as Opus, Interpréter.Code_Morceau as Code_Morceau FROM Musicien ";
        $sql = $sql."INNER JOIN Composer ON Composer.Code_Musicien = Musicien.Code_Musicien LEFT JOIN Oeuvre ON Oeuvre.Code_Oeuvre = Composer.Code_Oeuvre ";
        $sql = $sql."INNER JOIN Interpréter ON Interpréter.Code_Musicien = Musicien.Code_Musicien LEFT JOIN Enregistrement ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau WHERE Musicien.Code_Musicien = '".$parameters["code"]."'";
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
        $results = $_system_registry->getModel()->query("SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Musicien.Année_Naissance as Année_Naissance, Musicien.Année_Mort as Année_Mort, Musicien.Photo as Photo FROM Musicien WHERE Musicien.Code_Musicien = '".$parameters["code"]."'")->fetchall();
        $parameters["Nom_Musicien"] = $results["Nom_Musicien"];
        $parameters["Prénom_Musicien"] = $results["Prénom_Musicien"];
        $parameters["Année_Naissance"] = $results["Année_Naissance"];
        $parameters["Année_Mort"] = $results["Année_Mort"];
        $parameters["Photo"] = $results["Photo"];
        // Remplacement des chaines vides par "Inconnu"
        if($results[$i]["Nom_Musicien"] == "" || !isset($results[$i]["Nom_Musicien"]))
          $results[$i]["Nom_Musicien"] = "Inconnu";
        if($results[$i]["Prenom_Musicien"] == "" || !isset($results[$i]["Prenom_Musicien"]))
          $results[$i]["Prenom_Musicien"] = "Inconnu";
        if($results[$i]["Annee_Naissance"] == "" || !isset($results[$i]["Annee_Naissance"]))
          $results[$i]["Annee_Naissance"] = "Inconnu";
        $results[$i]["Annee_Mort"] = $results[$i][utf8_decode("Année_Mort")];
        if($results[$i]["Annee_Mort"] == "" || !isset($results[$i]["Annee_Mort"]))
          $results[$i]["Annee_Mort"] = "Inconnu";
        if($results[$i]["Nom_Pays"] == "" || !isset($results[$i]["Nom_Pays"]))
          $results[$i]["Nom_Pays"] = "Inconnu";

        template("views/artist/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artist", "/code", $artist);

?>
