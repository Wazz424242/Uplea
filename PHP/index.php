<?php

require_once 'config.php';
require_once 'autoload.php';

try {
  $oUplea = new Uplea($aConfig);
  if ($oUplea->isConnected())
    echo "Successfully connected to your account !";
  else
    echo "Running as anonymous !";
} 
catch (Exception $exp) {
  echo $exp->getMessage();
}