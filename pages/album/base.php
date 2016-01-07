<?php

    $album = function($parameters)
    {
        if(!isset($parameters["code"]) or $parameters["code"]="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les enregistrement de l'album concerné
        $sql = "SELECT DISTINCT Album.Code_Album as Code_Album, Disque.Code_Disque as Code_Disque, Morceau.Code_Morceau as Code_Morceau, Enregistrement.Titre as Titre, Enregistrement.Durée as Durée, Enregistrement.Prix as Prix, Enregistrement.Extrait as Extrait FROM Album ";
        $sql = $sql."INNER JOIN Disque ON Disque.Code_Album = Album.Code_Album INNER JOIN Composition_Disque ON Composition_Disque.Code_Disque = Disque.Code_Disque INNER JOIN Enregistrement ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau WHERE Album.Code_Album = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Récupération de la photo
          $results[$i]["Pochette"] = $parameters["_url"]."/converter/picture/".$results[$i]["Pochette"];
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
        }
        $parameters["records"] = $results;
        $results = $_system_registry->getModel()->query("SELECT DISTINCT Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Année_Album, Album.Pochette as Pochette, Album.ASIN as ASIN WHERE Album.Code_Album = '".$parameters["code"]."'")->fetchall();
        // Récupère les informations relatives à l'album
        $parameters["Titre_Album"] = $results["Titre_Album"];
        $parameters["Année_Album"] = $results["Année_Album"];
        $parameters["Pochette"] = $results["Pochette"];
        $parameters["ASIN"] = $results["ASIN"];
        template("views/album/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("album", "/code", $album);

?>
