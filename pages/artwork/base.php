<?php

    $artwork = function($parameters)
    {
        global $_system_registry;

<<<<<<< HEAD
        if(!isset($parameters["code"]) || $parameters["code"]=="")
=======
        if(!isset($parameters["code"]) or $parameters["code"]="")
>>>>>>> 2427375d40853ccacd0c7fb6953397802dd0b85f
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les albums dans lesquels l'oeuvre est présente
<<<<<<< HEAD
        $sql = "SELECT DISTINCT Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.Pochette as Pochette FROM Album
INNER JOIN Disque ON Disque.Code_Album = Album.Code_Album
INNER JOIN Composition_Disque ON Disque.Code_Disque = Composition_Disque.Code_Disque
INNER JOIN Enregistrement ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau
INNER JOIN Composition ON Composition.Code_Composition = Enregistrement.Code_Composition
INNER JOIN Composition_Oeuvre ON Composition_Oeuvre.Code_Composition = Composition.Code_Composition
INNER JOIN Oeuvre ON Oeuvre.Code_Oeuvre = Composition_Oeuvre.Code_Oeuvre";




WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'";
=======
        $sql = "SELECT DISTINCT Oeuvre.Code_Oeuvre, Composition_Oeuvre.Code_Composition, Enregistrement.Code_Morceau, Composition_Disque.Code_Disque, Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.Pochette as Pochette FROM Oeuvre ";
        $sql = $sql."INNER JOIN Composition_Oeuvre on Composition_Oeuvre.Code_Oeuvre = Oeuvre.Code_Oeuvre INNER JOIN Composition on Composition.Code_Composition = Composition_Oeuvre.Code_Composition INNER JOIN Enregistrement on Enregistrement.Code_Composition = Enregistrement.Code_Composition ";
        $sql = $sql."INNER JOIN Composition_Disque on Composition_Disque.Code_Morceau = Enregistrement.Code_Morceau INNER JOIN Disque on Disque.Code_Disque = Composition_Disque.Code_Disque INNER JOIN Album on Album.Code_Album = Disque.Code_Album WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'";
>>>>>>> 2427375d40853ccacd0c7fb6953397802dd0b85f
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
<<<<<<< HEAD
        $results = $_system_registry->getModel()->query("SELECT Oeuvre.Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année_Oeuvre as Année WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'")->fetch();
        $parameters["Titre_Oeuvre"] = $results["Titre_Oeuvre"];
        $parameters["Sous_Titre"] = $results["Sous_Titre"];
        $parameters["Annee"] = $results[utf8_decode("Année")];
=======
        $results = $_system_registry->getModel()->query("SELECT DISTINCT Oeuvre.Code_Oeuvre, Oeuvre.Titre_Oeuvre as Titre_Oeuvre, Oeuvre.Sous_Titre as Sous_Titre, Oeuvre.Année_Oeuvre as Année WHERE Oeuvre.Code_Oeuvre = '".$parameters["code"]."'")->fetchall();
        $parameters["Titre_Oeuvre"] = $results[utf8_decode("Titre_Oeuvre")];
        $parameters["Sous_Titre"] = $results[utf8_decode("Sous_Titre")];
        $parameters["Annee"] = $results["Annee"];
>>>>>>> 2427375d40853ccacd0c7fb6953397802dd0b85f
        template("views/artwork/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("artwork", "/code", $artwork);

?>
