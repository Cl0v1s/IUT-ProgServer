<?php

  $index = function($parameters)
  {
    template("views/index/base.tpl", $parameters, "views/base.tpl");
  };
  $_system_registry->registerPage("index","",$index);
