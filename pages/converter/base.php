<?php

	//Convertit les données BLOB transmise en fichier dont le type MIME est précisé par le paramètre type
	$converter = function($parameters)
	{
		//on arrete tout si les données requises ne sont pas transmises
		if(!isset($parameters["type"]) || $parameters["type"] == "" || !isset($parameters["blob"]) || $parameters["blob"])
		{
			header("Location: ".$parameters["_url"]."/index");
			return;
		}
		//on rends les paramètres innofensifs
		$parameters["type"] = Template::makeTextSafe($parameters["type"]);
		//On ne touche pas a blob pour ne pas risquer d'altérer les données
		
		switch($parameters["type"])
		{
			case "picture": //on traite le cas de la photo
				//TODO: parser le blob pour détecter le type de l'image
				header('Content-Type: image/jpeg');
				$image  = imagecreatefromstring($parameters["blob"]);
				imagejpeg($image);
				return;
			break;
			case "audio":
				//TODO: gérer le cas de l'audio, je ne peux le faire pour le moment, j'ai besoin de voir la tête d'un blob 
				//voir ici: http://stackoverflow.com/questions/4910813/how-to-get-and-play-wav-file-stored-as-mysql-blob
			break;
		}
			
	};
	$_system_registry->registerPage("converter", "/type/blob", $converter);

?>