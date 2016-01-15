<?php
    //OPERATIONS SUR LE PANIER
    $profil = function($parameters)
    {
        global $_system_registry;
        //Verification du type d'action
        if(isset($parameters["action"]) && $parameters["action"] == "delete" && isset($_POST["id"])) //Si l'action est reglée sur supprimer
        {
          $item_id = Template::MakeTextSafe($_POST["id"]);
          //Modification du panier
          $basket = Session::getEntry("basket");
          $i = 0;
          while($i != count($basket) && $basket[$i] != $item_id)
            $i ++;
          if($i != count($basket))
            array_splice($basket, $i, 1);
          //Enregistrement du nouveau panier
          Session::replaceEntry("basket", $basket);
        }
        else if(isset($parameters["action"]) && $parameters["action"] == "add" && isset($_POST["id"]) && isset($_POST["callback"])) //Si l'action est d'ajouter un element au panier
        {
          $item_id = Template::MakeTextSafe($_POST["id"]);
          $parameters["callback"] = $_POST["callback"];
          $parameters["added"] = false;
          //Modification du panier
          $basket = Session::getEntry("basket");
          if(!in_array($item_id,$basket))
          {
            array_push($basket, $item_id);
            $parameters["added"] = true;
            Session::replaceEntry("basket", $basket);
          }
          template("views/profil/add.tpl", $parameters, "views/base.tpl");
          return;
        }

        //Sinon consultation du panier
        # Récupère l'utilisateur connecté
        $id = Session::getLoggedAccount()[0];
        $parameters["username"] = Session::getLoggedAccount()[1];
        # Récupère la liste de ses achats et leurs informations relatives
        $basket = Session::getEntry("basket");
        $parameters["achat"] = array();
        $parameters["total"] = 0;
        if($basket != false)
        {
          $list = "'".implode("','", $basket)."'";
          $sql = "SELECT Enregistrement.Code_Morceau as Code_Morceau, Enregistrement.Titre as Titre, Enregistrement.Prix as Prix, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prenom_Musicien, Enregistrement.Code_Morceau as Code_Morceau
              FROM Enregistrement
              LEFT JOIN Interpréter ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau
              LEFT JOIN Musicien ON Interpréter.Code_Musicien = Musicien.Code_Musicien
              WHERE Enregistrement.Code_Morceau IN (".$list.")";
          $parameters["achat"] = $_system_registry->getModel()->query($sql)->fetchall();
          # Calcul du coût total en parcourant tout ses achats
          $parameters["total"] = 0;
          for($i = 0; $i <count($parameters["achat"]); $i++)
          {
              if(isset($parameters["achat"]["Nom_Musicien"]) && $parameters["achat"]["Nom_Musicien"] !="")
                $parameters["achat"]["Nom_Musicien"] = "de ".$parameters["achat"]["Nom_Musicien"];

              $parameters["achat"][$i]["pair"] = "";
              if($i % 2 == 0)
                $parameters["achat"][$i]["pair"] = "pair";
                $parameters["achat"][$i]["Extrait"] = $parameters["_url"]."/converter/sound/record/".$parameters["achat"][$i]["Code_Morceau"];
              $parameters["total"] += $parameters["achat"][$i]["Prix"];
          }
        }
        template("views/profil/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("profil", "/action", $profil, true);


?>
