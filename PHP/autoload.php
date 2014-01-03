<?php

function __autoload($class) {
  require_once 'class/'. $class . '.class.php';
}