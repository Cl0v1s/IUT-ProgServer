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
    $sql = "SELECT DISTINCT Musicien.Code_Musicien as Code_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Année_Naissance as Année_Naissance, Musicien.Année_Mort as Année_Mort, Pays.Nom_Pays as Nom_Pays FROM Musicien LEFT JOIN Pays ON Pays.Code_Pays = Musicien.Code_Pays ";
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
    $sql = $sql."WHERE Musicien.Prénom_Musicien LIKE '".$parameters["name"]."%' OR Musicien.Nom_Musicien LIKE '".$parameters["name"]."%' ORDER BY Musicien.Nom_Musicien ASC";
    //Lancement de la requete
    $results = $_system_registry->getModel()->query($sql)->fetchall();
    //Traitements supplémentaires
    for($i = 0; $i != count($results); $i++)
    {
      $results[$i]["pair"] = "";
      //Récupération de la photo
      $results[$i]["Photo"] = $parameters["_url"]."/converter/picture/artist/".$results[$i]["Code_Musicien"];
      //Détermination de la parité pour le design
      if($i % 2 == 0)
        $results[$i]["pair"] = "pair";
      $results[$i]["Prenom_Musicien"] = $results[$i][utf8_decode("Prénom_Musicien")];
      $results[$i]["Annee_Naissance"] = $results[$i][utf8_decode("Année_Naissance")];
      if($results[$i]["Annee_Naissance"] == "" || !isset($results[$i]["Annee_Naissance"]))
        $results[$i]["Annee_Naissance"] = "Inconnu";
      $results[$i]["Annee_Mort"] = $results[$i][utf8_decode("Année_Mort")];
      if($results[$i]["Annee_Mort"] == "" || !isset($results[$i]["Annee_Mort"]))
        $results[$i]["Annee_Mort"] = "Inconnu";
      if($results[$i]["Nom_Pays"] == "" || !isset($results[$i]["Nom_Pays"]))
        $results[$i]["Nom_Pays"] = "Inconnu";


    }
    //Ajout des resultats dans les paramètres passés au template
    $parameters["results"] = $results;
    if($parameters["name"] == "")
      $parameters["name"] = "Tout le monde";
    if($parameters["type"] == "all")
      $parameters["type"] = "Partout";
    template("views/search/base.tpl", $parameters, "views/base.tpl");
  };
  $_system_registry->registerPage("search-artist", "/type/name", $search_artist);

?>
