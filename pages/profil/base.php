<?php
    //PAGE DE PROFIL ET AFFICHAGE PANIER
    $profil = function($parameters)
    {
        # Récupère l'utilisateur connecté
        $id = Session::getLoggedAccount()[0];
        $parameters["username"] = Session::getLoggedAccount()[1];
        # Récupère la liste de ses achats et leurs informations relatives
        $parameters["achat"] = $_system_registry->getModel()->query("SELECT Enregistrement.Titre as Titre, Enregistrement.Prix as Prix, Musicien.Nom_Musicien as Nom_Musicien, Musicien.Prénom_Musicien as Prénom_Musicien, Achat.Code_Achat as Code_Achat
            FROM Abonné
            INNER JOIN Achat ON Abonné.Code_Abonné = Achat.Code_Abonné
            INNER JOIN Enregistrement ON Achat.Code_Enregistrement = Enregistrement.Code_Enregistrement
            INNER JOIN Interpréter ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau
            INNER JOIN Musicien ON Interpréter.Code_Musicien = Musicien.Code_Musicien
            WHERE Abonné.Code_Abonné = '".$id."'")->fetchall();
        # Calcul du coût total en parcourant tout ses achats
        $parameters["total"] = 0;
        for($i = 0; $i <count($parameters["achat"]); $i++)
        {
            $parameters["total"] += $parameters["achat"][$i]["Prix"];
        }
        template("views/login/profil.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("profil", "", $profil, true);


    //OPERATION DE SUPRESSION D'UN ELEMENT DU PANIER
    $delete = function($parameters)
    {
        //Récupération de l'id de l'achat à supprimer
        if(!isset($_POST["id"])) //Si l'id n'est pas passé on redirige vers l'index
        {
          header("Location: /index");
          return;
        }
        $item_id = Template::MakeTextSafe($_POST["id"]);
        //On paramètre la valeur de retour de la page
        $data = array();
        $data["state"] = "NO";
        $result = $_system_registry->getModel()->exec("DELETE FROM Achat WHERE Achat.Code_Achat = '".$item_id."'");
        if($result == 1) //Si une supression a bien eu lieu
          $data["state"] = "OK";
        //Retour du resultat sous forme de json dans la page
        template_json($data);
    };
    $_system_registry->registerPage("delete", "", $delete, true);

?>
