<?php
class Form
{
  private $_fields;
  private $_values;
  private $_table;
  private $_data;
  private $_model;

  public function __construct($table, $fields, $model)
  {
    $this->_table = $table;
    $this->_fields = $fields;
    $this->_model = $model;
  }

  public function setValuesFromArray($post)
  {
    $i = 0;
    foreach ($post as $key => $value) {
      if(in_array($key, $this->_fields))
      {
        $this->_data[$key] = Template::makeTextSafe($value);
        $this->_values[$i] = Template::makeTextSafe($value);
        $i++;
      }
    }
    if(count($this->_values) != count($this->_fields))
    {

      return false;
    }
    return true;
  }

  public function getData()
  {
    return $this->_data;
  }

  public function getValues()
  {
    return $this->_values;
  }

  public function getFields()
  {
    return $this->_fields;
  }

  public function update($id)
  {
    if(count($this->_values) <= 0)
      return false;
    $sql = "UPDATE $this->_table SET ";
    foreach ($this->_data as $key => $value)
    {
      $sql =$sql." $key = '$value',";
    }
    $sql = substr($sql, 0, -1);
    $sql = $sql." WHERE id = '$id'";
    $result = $this->_model->exec($sql);
    return ($result !== false);
  }

  public function insert()
  {
    if(count($this->_values) <= 0)
      return false;
    $sql ="INSERT INTO $this->_table(";
    foreach ($this->_fields as $value) {
      $sql = $sql."$value, ";
    }
    $sql = substr($sql, 0, -2).") VALUES (";
    foreach ($this->_values as $value) {
      $sql = $sql."'$value', ";
    }
    $sql = substr($sql, 0, -2).")";
    $result = $this->_model->exec($sql);
    return ($result == 1);
  }
}

 ?>
