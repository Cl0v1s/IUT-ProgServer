<?php



class Template
{
  private $_file = " ";
  private $_parameters = array();
  private $_text = " ";

  public function __construct($file, $parameters)
  {
    $this->_file = $file;
    $this->_parameters = $parameters;
  }

  public static function makeTextUnsafe($text)
  {
    $text = str_replace("&#34;", "\"", $text);
    $text = str_replace("&#39;", "''", $text);
    return $text;
  }


  public static function makeTextSafe($text, $html = true)
  {
    $text = str_replace("\"", "&#34;", $text);
    $text = str_replace("'", "&#39;", $text);
    if($html)
    {
      $text = str_replace("<", "&lt;", $text);
      $text = str_replace(">", "&gt;", $text);
    }
    return $text;
  }

  public function setParameters($parameters)
  {
    $this->$_parameters = $parameters;
  }

  public function load()
  {
    $this->_text = file_get_contents($this->_file);
    if($this->_text === "")
      return "";
      foreach ($this->_parameters as $key => $value)
      {
        //zone booléennes
        if(is_array($value) == false)
        {
            if($value === false || $value==="false")
            {
              $this->_text = preg_replace("#\[\[".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "", $this->_text);
              $this->_text = preg_replace("#\[\[!".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "$1", $this->_text);
            }
            else if($value === true || $value==="true")
            {
              $this->_text = preg_replace("#\[\[".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "$1", $this->_text);
              $this->_text = preg_replace("#\[\[!".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "", $this->_text);
            }
        }
        else //listes et itérations
        {
            if(count($value) > 0 && is_array($value[0]) && count($value[0]) >0)
            {
              $match = array();
              //Récupération des champs demandés
              preg_match_all("#\[\[".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", $this->_text, $match);
              for($u = 0; $u < count($match[0]); $u++)
              {
                $replace = "";
                $holder = "";
                //Suppression des bornes
                $replace = str_replace("[[".$key."]]", "", $match[0][$u]);
                $replace = str_replace("[[/".$key."]]", "", $replace);
                //Copie des champs
                for($i = 0; $i < count($value); $i++)
                {
                  $r = $replace;
                  foreach ($value[$i] as $k => $v) {
                    $r = str_replace("{{".$k."}}", $v, $r);
                  }
                  $holder = $holder.$r;
                }
                $this->_text = str_replace($match[0][$u], $holder, $this->_text);
                $this->_text = preg_replace("#\[\[!".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "", $this->_text);
              }
            }
            else {
              $this->_text = preg_replace("#\[\[".$key."\]\]\s*(.+)\s*\[\[/".$key."\]\]#", "", $this->_text);
            }
        }
        //remplacement des valaurs par des variables
        if(is_array($value) == false)
          $this->_text = str_replace("{{".$key."}}", $value, $this->_text);
      }
    //test de l'existence de liste non complétées
    $match = array();
    preg_match_all("#\[\[(.+)\]\]#", $this->_text, $match);
    for($p = 0; $p < count($match[0]); $p++)
    {
      $this->_text = str_replace($match[0][$p], "", $this->_text);
    }
  }


  public function getHTML()
  {
    return $this->_text;
  }

}

/* template
* Raccourcis permettant de directement obtenir la valeur final de retour d'un template
* et de l'afficher
*/
function template($file, $parameters, $parent = NULL)
{
  if(is_null($parent))
  {
    $tpl = new Template($file, $parameters);
    $tpl->load();
    echo $tpl->getHTML();
  }
  else {
    $tpl = new Template($file, $parameters);
    $tpl->load();
    $child = $tpl->getHTML();
    $parameters["__CHILD__"] = $child;
    $tpl = new Template($parent, $parameters);
    $tpl->load();
    echo $tpl->getHTML();

  }
}

/* json
* Raccourcis permettant d'afficher directement la représentation json des données passées en paramètrue
*/
function template_json($data)
{
  header('Content-Type: application/json');
  $data = json_encode($data);
  echo $data;
}

?>
