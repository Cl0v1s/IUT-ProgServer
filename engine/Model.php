<?php

class Model
{
    private $_chain;
    private $_user;
    private $_password;

    public function __construct($chain, $user, $password)
    {
        $this->_chain = $chain;
        $this->_user = $user;
        $this->_password = $password;
    }

    public function create()
    {
        return new PDO($this->_chain, $this->_user, $this->_password);
    }

};

?>
