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

        // Récupère toutes les interprétations de l'artiste concerné
        $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année as Annee, Oeuvre.Opus as Opus FROM Musicien ";
        $sql = $sql."INNER JOIN Interpréter on Interpréter.Code_Musicien = Musicien.Code_Musicien ";
        $sql = $sql."INNER JOIN Enregistrement on Enregistrement.Code_Morceau = Interpréter.Code_Morceau ";
        $sql = $sql."INNER JOIN Composer on Composer.Code_Musicien = Musicien.Code_Musicien ";
        $sql = $sql."INNER JOIN Oeuvre on Oeuvre.Code_Oeuvre = Composer.Code_Oeuvre ";
        $sql = $sql."WHERE Musicien.Code_Musicien = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
          $results[$i]["Titre_Oeuvre"] = $results[$i][utf8_decode("Titre_Oeuvre")];
          $results[$i]["Sous_Titre"] = $results[$i][utf8_decode("Sous_Titre")];
          $results[$i]["Annee"] = $results[$i][utf8_decode("Annee")];
        }
        $parameters["interpretations"] = $results;

        // Récupère toutes les directions de l'artiste concerné
        $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année as Annee, Oeuvre.Opus as Opus FROM Musicien ";
        $sql = $sql."INNER JOIN Direction on Direction.Code_Musicien = Musicien.Code_Musicien ";
        $sql = $sql."INNER JOIN Composer on Composer.Code_Musicien = Musicien.Code_Musicien ";
        $sql = $sql."INNER JOIN Oeuvre on Oeuvre.Code_Oeuvre = Composer.Code_Oeuvre ";
        $sql = $sql."WHERE Musicien.Code_Musicien = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
          $results[$i]["Titre_Oeuvre"] = $results[$i][utf8_decode("Titre_Oeuvre")];
          $results[$i]["Sous_Titre"] = $results[$i][utf8_decode("Sous_Titre")];
          $results[$i]["Annee"] = $results[$i][utf8_decode("Annee")];
        }
        $parameters["directions"] = $results;

        // Récupère toutes les oeuvres de l'artiste concerné
        $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année as Annee, Oeuvre.Opus as Opus FROM Musicien ";
        $sql = $sql."INNER JOIN Composer on Composer.Code_Musicien = Musicien.Code_Musicien ";
        $sql = $sql."INNER JOIN Oeuvre on Oeuvre.Code_Oeuvre = Composer.Code_Oeuvre ";
        $sql = $sql."WHERE Musicien.Code_Musicien = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
          $results[$i]["Titre_Oeuvre"] = $results[$i][utf8_decode("Titre_Oeuvre")];
          $results[$i]["Sous_Titre"] = $results[$i][utf8_decode("Sous_Titre")];
          $results[$i]["Annee"] = $results[$i][utf8_decode("Annee")];
        }
        $parameters["oeuvres"] = $results;

        // Récupère les informations sur l'ariste
        $results = $_system_registry->getModel()->query("SELECT Musicien.Code_Musicien as Code_Musicien, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prenom_Musicien, Musicien.Année_Naissance as Annee_Naissance, Musicien.Année_Mort as Annee_Mort FROM Musicien WHERE Musicien.Code_Musicien = '".$parameters["code"]."'")->fetch();
        // Remplacement des chaines vides par "Inconnu"
        if($results["Nom_Musicien"] == "" || !isset($results["Nom_Musicien"]))
          $results["Nom_Musicien"] = "Inconnu";
        if($results["Prenom_Musicien"] == "" || !isset($results["Prenom_Musicien"]))
          $results["Prenom_Musicien"] = "Inconnu";
        if($results["Annee_Naissance"] == "" || !isset($results["Annee_Naissance"]))
          $results["Annee_Naissance"] = "Inconnu";
        if($results["Annee_Mort"] == "" || !isset($results["Annee_Mort"]))
          $results["Annee_Mort"] = "Inconnu";

        $parameters["Nom_Musicien"] = $results[utf8_decode("Nom_Musicien")];
        $parameters["Prenom_Musicien"] = $results[utf8_decode("Prenom_Musicien")];
        $parameters["Annee_Naissance"] = $results["Annee_Naissance"];
        $parameters["Annee_Mort"] = $results["Annee_Mort"];
        $parameters["Photo"] = $parameters["_url"]."/converter/picture/artist/".$results["Code_Musicien"];

        template("views/artist/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artist", "/code", $artist);

?>
