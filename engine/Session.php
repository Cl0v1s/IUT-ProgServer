<?php

session_start();
/*
 Session

 Permet de stocker des informations de page en page.
*/

class Session
{
  public static function addEntry($name, $content)
  {
    if(isset($_SESSION[$name]))
      return false;
    $_SESSION[$name] = $content;
    return true;
  }

  public static function getEntry($name)
  {
    if(!isset($_SESSION[$name]))
      return false;
    else
      return $_SESSION[$name];
  }

  public static function removeEntry($name)
  {
    if(!isset($_SESSION[$name]))
      return false;
    unset($_SESSION[$name]);
  }

  public static function checkAccount($user, $password)
  {
    global $_system_registry;
    $credentials_valid = (count($_system_registry->getModel()->query("SELECT name, password FROM users WHERE name = '".$user."' AND password='".$password."'")->fetchall()) == 1);
    if($credentials_valid == true)
    {
      Session::saveCredentials($user, $password);
    }
    return $credentials_valid;
  }

  public static function getLoggedAccount()
  {
    $hash = Session::getEntry("credentials");
    global $_system_registry;
    if($_system_registry->getModel() == NULL)
      return false;

    $users = $_system_registry->getModel()->query("SELECT id, name, password FROM users")->fetchall();

    for($i = 0; $i <count($users); $i++)
    {
      $h = md5(md5($users[$i]["name"]).$users[$i]["password"]);
      if($hash == $h)
        return $users[$i];
    }
    return false;
  }

  public static function checkCredentials($hash)
  {
    global $_system_registry;
    $users = $_system_registry->getModel()->query("SELECT name, password FROM users")->fetchall();
    for($i = 0; $i <count($users); $i++)
    {
      $h = md5(md5($users[$i][0]).$users[$i][1]);
      if($hash == $h)
        return true;
    }
    return false;
  }

  public static function saveCredentials($user, $password)
  {
    $hash = md5(md5($user).$password);
    Session::addEntry("credentials", $hash);
  }

  public static function saveCredentials($hash)
  {
    Session::addEntry("credentials", $hash);
  }


};
?>
