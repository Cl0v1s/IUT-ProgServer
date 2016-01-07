<?php
/*
 Registry

 Joue le rôle de registre en associant un url à une fonction (de récupération des données) et à une page.
 Lors de l'appel de showPage, le registre cherche si l'url demandé est présent et le cas échéant
 Appelle la fonction de récupération des donées en lui passant en pramètre le template ainsi que les paramètres de
 la requète envoyé par l'utilisateur.
*/

class Registry
{
  private $_configuration;
  private $_functions = array();
  private $_datasheme = array();
  private $_requireAuth = array();
  private $_model;

  public function __construct(RegistryConfiguration $configuration)
  {
    $this->_configuration = $configuration;
    date_default_timezone_set($configuration->_timezone);
    if($configuration->_database != false)
      $this->_model = new PDO($configuration->_database) or die("Impossible d'accéder à la base de données.");
    else
      unset($this->_model);
  }

  public function registerPage($url,$datasheme,$function, $requireAuth = false)
  {
    $this->_functions[$url] = $function;
    $this->_datasheme[$url] = $datasheme;
    $this->_requireAuth[$url] = $requireAuth;
  }

  public function examine()
  {
    //$url = explode("/", "$_SERVER[REQUEST_URI]")[1] ;
    $url = explode("/", "$_SERVER[REQUEST_URI]");
    if(count($url) >= 6)
        $url = $url[5];
    else
        $url = $this->_configuration->_index;
    //Lecture de la requête de l'utilisateur
    if($url != "")
    {
      $this->showPage($url);
    }
    else {
      $this->showPage($this->_configuration->_index, array());
    }
  }

  public function showPage($url)
  {
    //Gestion de l'affichage/transmission des données
    $parameters = $this->_configuration->getAsArray();
    $parameters["_current_page"] = $url;
    $parameters["_error"] = false;
    $parameters["_logged"] = (Session::getLoggedAccount() != false);
    if(isset($this->_datasheme["404"]) == false)
      throw new Exception("Vous devez définir la fonction 404.");
    if(isset($this->_datasheme["refused"]) == false)
      throw new Exception("Vous devez définir la fonction accès refusé.");
    if(isset($this->_datasheme[$url]))
    {
      $data_url = str_replace ( "/".$url , "" , "$_SERVER[REQUEST_URI]");
      $data_url = explode("/", $data_url);
      $data_sheme = explode("/", $this->_datasheme[$url]);
      //Suppression des valeurs inutiles afin d'assouplir le système
      for($i = 1; $i < count($data_url); $i++)
      {
        if($data_url[$i] == "")
          unset($data_url[$i]);
      }
      //affectation des paramètres
      for($i = 1; $i<count($data_sheme); $i++)
      {
        if(isset($data_url[$i]))
          $parameters[$data_sheme[$i]] = $data_url[$i];
      }
      if($this->_requireAuth[$url] == false || ($this->_requireAuth[$url] == true && isset($_SESSION["credentials"]) == true && $this->checkCredentials($_SESSION["credentials"]) == true ) )
      {
        $this->_functions[$url]($parameters);
      }
      else {
        $parameters["_error"] = true;
        $this->_functions["refused"]($parameters);
      }
    }
    else
    {
      $parameters["_error"] = true;
      $this->_functions["404"]($parameters);
    }
  }

  public function getModel()
  {
    if(isset($this->_model) == false)
      return NULL;
    return $this->_model;

  }

  public static function CompressURL($url)
  {
    $shorturl= file_get_contents("http://to.ly/api.php?longurl=".urlencode($url));
    return $shorturl;
  }


}



?>
