<?php

    include_once("aws_signed_request.php");
    $album = function($parameters)
    {
        global $_system_registry;
        include_once("api.php");
        if(!isset($parameters["code"]) || $parameters["code"]=="")
        {
            header("Location: ".$parameters["_url"]."/404");
            return;
        }
        $parameters["code"] = Template::MakeTextSafe($parameters["code"]);

        $results = $_system_registry->getModel()->query("SELECT Album.Code_Album as Code_Album, Album.Titre_Album as Titre_Album, Album.Année_Album as Annee_Album, Album.ASIN as ASIN FROM ALBUM WHERE Album.Code_Album = '".$parameters["code"]."'")->fetch();
        //Si l'album n'existe pas dans la base
        if($results == "")
        {
          header("Location: ".$parameters["_url"]."/404");
          return;
        }
        // Récupère les informations relatives à l'album
        $parameters["Code_Album"] = $results["Code_Album"];
        $parameters["Titre_Album"] = $results["Titre_Album"];
        $parameters["Annee_Album"] = $results["Annee_Album"];
        $parameters["Pochette"] = $parameters["_url"]."/converter/picture/album/".$results["Code_Album"];
        $parameters["ASIN"] = $results["ASIN"];

        //Récupération des informations amazon
        $details = file_get_contents(aws_signed_request("fr", array("Operation"=>"ItemLookup",
                        "ItemId"=>$parameters["ASIN"], "ResponseGroup"=>"Small"), $public, $secret, "musique04c-21"));
        $details = simplexml_load_string($details);
        $parameters["Amazon_Title"] = (string)$details->Items->Item->ItemAttributes->Title;
        $parameters["Amazon_Group"] = (string)$details->Items->Item->ItemAttributes->ProductGroup;
        $parameters["Amazon_Manu"] = (string)$details->Items->Item->ItemAttributes->Manufacturer;
        $parameters["Amazon_Creators"] = array();
        foreach ($details->Items->Item->ItemAttributes->Creator as $node) {
          $data = array();
          $data["role"] = $node->attributes()[0];
          $data["name"] = $node;
          array_push($parameters["Amazon_Creators"], $data);
        };
        $details = file_get_contents(aws_signed_request("fr", array("Operation"=>"ItemLookup",
                        "ItemId"=>$parameters["ASIN"], "ResponseGroup"=>"OfferSummary"), $public, $secret, "musique04c-21"));
        $details = simplexml_load_string($details);
        $parameters["Amazon_Price"] = (string)$details->Items->Item->OfferSummary->LowestUsedPrice->FormattedPrice;

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

        template("views/album/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("album", "/code", $album);

?>
