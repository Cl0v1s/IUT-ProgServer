<?php
/*
 RegistryConfiguration

 Permet de contrôler les options et la configuration de base d'un registre.

*/
class RegistryConfiguration
{
  public $_url;
  public $_index;
  public $_database;
  public $_timezone;
  public $_others = NULL;

  public function __construct($url,$index, $database,$timezone,  $others)
  {
    $this->_timezone = $timezone;
    $this->_database = $database;
    $this->_index = $index;
    if(!is_null($others) && !is_array($others))
      throw new Exception("others must be an array");
    else {
      $this->_others = $others;
    }
    $this->_url = $url;
  }

  public function getAsArray()
  {
    $vars  = get_object_vars($this);
    unset($vars["_others"]);
    if(is_array($this->_others))
      return array_merge($vars, $this->_others);
    else
      return $vars;
  }
};


?>
