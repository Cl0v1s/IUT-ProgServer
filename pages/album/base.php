<?php

    $album = function($parameters)
    {
        global $_system_registry;
        if(!isset($parameters["code"]) || $parameters["code"]=="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);
        // Récupère toutes les enregistrement de l'album concerné
        $sql = "SELECT DISTINCT Album.Code_Album as Code_Album, Enregistrement.Code_Morceau as Code_Morceau, Enregistrement.Titre as Titre, Enregistrement.Durée as Duree, Enregistrement.Prix as Prix FROM Album ";
        $sql = $sql."INNER JOIN Disque ON Disque.Code_Album = Album.Code_Album INNER JOIN Composition_Disque ON Composition_Disque.Code_Disque = Disque.Code_Disque INNER JOIN Enregistrement ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau WHERE Album.Code_Album = '".$parameters["code"]."'";
        $results = $_system_registry->getModel()->query($sql)->fetchall();
        for($i = 0; $i != count($results); $i++)
        {
          $results[$i]["pair"] = "";
          //Détermination de la parité pour le design
          if($i % 2 == 0)
            $results[$i]["pair"] = "pair";
          $results[$i]["Extrait"] = $parameters["_url"]."/converter/sound/record/".$results[$i]["Code_Morceau"];
        }
        $parameters["records"] = $results;
        $results = $_system_registry->getModel()->query("SELECT Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.ASIN as ASIN FROM ALBUM WHERE Album.Code_Album = '".$parameters["code"]."'")->fetch();
        // Récupère les informations relatives à l'album
        $parameters["Titre_Album"] = $results["Titre_Album"];
        $parameters["Annee_Album"] = $results["Annee_Album"];
        $parameters["Pochette"] = $parameters["_url"]."/converter/picture/album/".$results["Code_Album"];
        $parameters["ASIN"] = $results["ASIN"];
        template("views/album/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("album", "/code", $album);

?>
