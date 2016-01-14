<?php

	//Convertit les données BLOB transmise en fichier dont le type MIME est précisé par le paramètre type
	$converter = function($parameters)
	{
		global $_system_registry;
		//on arrete tout si les données requises ne sont pas transmises
		if(!isset($parameters["type"]) || $parameters["type"] == "" || !isset($parameters["table"]) || $parameters["table"] == "" || !isset($parameters["id"]) || $parameters["id"] == "")
		{
			header("Location: ".$parameters["_url"]."/index");
			return;
		}
		//on rends les paramètres innofensifs
		$parameters["type"] = Template::makeTextSafe($parameters["type"]);
		$parameters["table"] = Template::makeTextSafe($parameters["table"]);
		$parameters["id"] = Template::makeTextSafe($parameters["id"]);

		//On ne touche pas a blob pour ne pas risquer d'altérer les données

		switch($parameters["type"])
		{
			case "picture": //on traite le cas de la photo
				$sql ="";
				if($parameters['table'] == "artist")
					$sql = "SELECT Photo as picture FROM Musicien WHERE Musicien.Code_Musicien = '".$parameters["id"]."'";
				else if($parameters["table"] == "album")
					$sql = "SELECT Pochette as picture FROM Album WHERE Album.Code_Album = '".$parameters["id"]."'";
				$result = $_system_registry->getModel()->query($sql)->fetch();
				//TODO: parser le blob pour détecter le type de l'image
				header('Content-Type: image/jpeg');
				$image  = pack("H*", $result["picture"]);
				echo $image;
				return;
			break;
			case "audio":
				//TODO: gérer le cas de l'audio, je ne peux le faire pour le moment, j'ai besoin de voir la tête d'un blob
				//voir ici: http://stackoverflow.com/questions/4910813/how-to-get-and-play-wav-file-stored-as-mysql-blob
			break;
		}

	};
	$_system_registry->registerPage("converter", "/type/table/id", $converter);

?>
