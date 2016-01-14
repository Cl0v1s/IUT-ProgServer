<?php
    //OPERATIONS SUR LE PANIER
    $profil = function($parameters)
    {
        global $_system_registry;
        
        //Verification du type d'action
        if(isset($parameters["action"]) && $parameters["action"] == "delete") //Si l'action est reglée sur supprimer
        {
          //Récupération de l'id de l'achat à supprimer
          if(!isset($_POST["id"])) //Si l'id n'est pas passé on redirige vers l'index
          {
            header("Location: /index");
            return;
          }
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
          //Retour du resultat sous forme de json dans la page
          template_json(array("data" => "ok"));
          return;
        }
        else if(isset($parameters["action"]) && $parameters["action"] == "add") //Si l'action est d'ajouter un element au panier
        {
          //Récupération de l'id de l'achat à supprimer
          if(!isset($_POST["id"])) //Si l'id n'est pas passé on redirige vers l'index
          {
            header("Location: /index");
            return;
          }
          $item_id = Template::MakeTextSafe($_POST["id"]);
          //Modification du panier
          $basket = Session::getEntry("basket");
          array_push($basket, $item_id);
          Session::replaceEntry("basket", $basket);
          template_json(array("data" => "ok"));
          return;
        }

        //Sinon consultation du panier
        # Récupère l'utilisateur connecté
        $id = Session::getLoggedAccount()[0];
        $parameters["username"] = Session::getLoggedAccount()[1];
        $parameters["achat"] = false;
        # Récupère la liste de ses achats et leurs informations relatives
        $basket = Session::getEntry("basket");
        $basket = array("1","2", "3");
        if($basket != false)
        {
          $list = "'".implode("','", $basket)."'";
          $parameters["achat"] = $_system_registry->getModel()->query("SELECT Enregistrement.Titre as Titre, Enregistrement.Prix as Prix, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Enregistrement.Code_Morceau as Code_Morceau
              FROM Enregistrement
              INNER JOIN Interpréter ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau
              INNER JOIN Musicien ON Interpréter.Code_Musicien = Musicien.Code_Musicien
              WHERE Enregistrement.Code_Morceau IN ("+$list+")")->fetchall();
          # Calcul du coût total en parcourant tout ses achats
          $parameters["total"] = 0;
          for($i = 0; $i <count($parameters["achat"]); $i++)
          {
              $parameters["achat"][$i]["pair"] = "";
              if($i % 2 == 0)
                $parameters["achat"][$i]["pair"] = "pair";
              $parameters["total"] += $parameters["achat"][$i]["Prix"];
          }
        }
        template("views/profil/base.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("profil", "action", $profil, true);


?>
