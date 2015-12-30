<?php
    //PAGE DE PROFIL
    $profil = function($parameters)
    {
        # La page requière l'authentification
        if(!isset($_POST["hash"]) || Session::checkCredentials($_POST["hash"]))
        {
          header("Location:/index");
          return;
        }
        # Récupère l'utilisateur connecté
        $parameters["username"] = Session::getLoggedAccount();
        # Récupère la liste de ses achats et leurs informations relatives
        $parameters["achat"] = $_system_registry->getModel()->query("SELECT Abonné.Login, Enregistrement.Titre, Enregistrement.Prix, Musicien.Nom_Musicien, Musicien.Prénom_Musicien
            FROM Abonné
            INNER JOIN Achat ON Abonné.Code_Abonné = Achat.Code_Abonné
            INNER JOIN Enregistrement ON Achat.Code_Enregistrement = Enregistrement.Code_Enregistrement
            INNER JOIN Interpréter ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau
            INNER JOIN Musicien ON Interpréter.Code_Musicien = Musicien.Code_Musicien
            WHERE Abonné.Login = "$parameters["username"]"")->fetchall();
        # Calcul du coût total en parcourant tout ses achats
        $parameters["total"] = 0;
        for($i = 0; $i <count($parameters["achat"]); $i++)
        {
            $parameters["total"] += $parameters["achat"][$i]["Prix"];
        }
        template("views/login/profil.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("profil", "", $profil);

    $delete = function($parameters)
    {
        $parameters["done"] = NULL;
        # Récupère l'objet désigné
        $elem = $_system_registry->getModel()->query("SELECT Abonné.Login, Achat.Code_Enregistrement
            FROM Abonné
            INNER JOIN Achat ON Abonné.Code_Abonné = Achat.Code_Abonné
            WHERE Abonné.Login = "$parameters["username"]" AND Achat.Code_Enregistrement = "$parameters["id"]"")->fetchall();
        # Teste si il existe
        if $elem != NULL
        {
            # La suppression se fait après ces vérifications
            $_system_registry->getModel()->query("DELETE FROM Achat WHERE Achat.Code_Enregistrement = "$parameters["id"]"")->fetchall();
            $parameters["done"] = json_encode("state: OK");
        }
        template("views/login/delete.tpl", $parameters, "views/base.tpl");
    };
    $_system_registry->registerPage("delete", "", $delete);

?>
