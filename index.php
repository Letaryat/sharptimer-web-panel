<?php
require('functions.php');
require('gunwo/config.php');
//require('config.php');
require ('scripts/steamauth/steamauth.php');
require_once('views/partials/header.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('router.php');
require_once('views/partials/footer.php');