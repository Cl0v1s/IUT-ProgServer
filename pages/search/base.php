<?php

  $search_artist = function($parameters)
  {
    global $_system_registry;
    //test de déclaration des paramètres
    if (!isset($parameters["type"]) || $parameters["type"] == "" || !isset($parameters["name"]) || $parameters["name"] == "")
    {
      header("Location: ".$parameters["_url"]."/404");
      return;
    }
    //on rends les paramètres innofensifs
    if($parameters["name"] == "all")
      $parameters["name"] = "";
    $parameters["type"] = Template::MakeTextSafe($parameters["type"]);
    $parameters["name"] = Template::MakeTextSafe($parameters["name"]);

    //Déclaration de la requete
    $sql = "SELECT Musicien.Code_Musicien as Code_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Photo as Photo, Musicien.Année_Naissance as Année_Naissance, Musicien.Année_Mort as Année_Mort, Pays.Nom_Pays as Nom_Pays FROM Musicien LEFT JOIN Pays ON Pays.Code_Pays = Musicien.Code_Pays ";
    //Analyse de type
    switch($parameters["type"])
    {
      case "director":
        $sql = $sql."INNER JOIN Direction ON Direction.Code_Musicien = Musicien.Code_Musicien ";
      break;
      case "performer":
        $sql = $sql."INNER JOIN Interpréter ON Interpréter.Code_Musicien = Musicien.Code_Musicien ";
      break;
      case "composer":
        $sql = $sql."INNER JOIN Composer ON Composer.Code_Musicien = Musicien.Code_Musicien ";
      break;
      default: //Cas du all et par defaut
        
      break;
    }
    //Ajout des paramètres de la recherche
    $sql = $sql."WHERE Musicien.Prénom_Musicien LIKE '%".$parameters["name"]."%' OR Musicien.Nom_Musicien LIKE '%".$parameters["name"]."%'";
    //Lancement de la requete
    $results = $_system_registry->getModel()->query($sql)->fetchall();
    //Traitements supplémentaires
    for($i = 0; $i != count($results); $i++)
    {
      $results[$i]["pair"] = "";
      //Récupération de la photo
      $results[$i]["Photo"] = $parameters["_url"]."/converter/picture/".$results[$i]["Photo"];
      //Détermination de la parité pour le design
      if($i % 2 == 0)
        $results[$i]["pair"] = "pair";
    }
    //Ajout des resultats dans les paramètres passés au template
    $parameters["results"] = $results;
    if($parameters["name"] == "all")
      $parameters["name"] = "Tout le monde";

    template("views/search/base.tpl", $parameters, "views/base.tpl");
  };
  $_system_registry->registerPage("search-artist", "/type/name", $search_artist);

?>
