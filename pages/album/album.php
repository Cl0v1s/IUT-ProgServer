<?php

    $album = function($parameters)
    {
        if(!isset($parameters["name"]) or $parameters["name"]="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["name"] = Template::MakeTextSafe($parameters["name"]);
        // Récupère toutes les informations de l'album concerné
        $sql = "SELECT DISTINCT Album.Code_Album, Album.Titre_Album, Album.Année_Album, Album.Pochette, Album.ASIN, Disque.Code_Disque, Morceau.Code_Morceau, Enregistrement.Titre, Enregistrement.Durée, Enregistrement.Prix, Enregistrement.Extrait FROM Album ";
        $sql = $sql."INNER JOIN Disque ON Disque.Code_Album = Album.Code_Album INNER JOIN Composition_Disque ON Composition_Disque.Code_Disque = Disque.Code_Disque INNER JOIN Enregistrement ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau WHERE Titre_Album = "name"";
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
        $parameters["Titre_Album"] = $results[1]["Titre_Album"];
        $parameters["Année_Album"] = $results[1]["Année_Album"];
        $parameters["records"] = $results;
        template("views/album/album.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("album", "/name", $album);

?>
