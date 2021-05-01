<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/services/AccountService.class.php';
require_once dirname(__FILE__).'/services/UserService.class.php';
require_once dirname(__FILE__).'/services/VehicleService.class.php';

Flight::set('flight.log_errors',TRUE);
/*error handling for API*/
Flight::map('error', function(Exception $ex){
  Flight::json(["message"=> $ex->getMessage()], $ex->getCode());
});

Flight::map('query',function($name, $default_value=NULL){
$request= Flight::request();
$query_parameter= @$request->query->getData()[$name];
$query_parameter= $query_parameter ? $query_parameter : $default_value;
return $query_parameter;
});

/*register Business Logic Layer services */
Flight::register('accountService', 'AccountService');
Flight::register('userService', 'UserService');
Flight::register('vehicleService', 'VehicleService');

/*include all routes*/
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/vehicles.php";

Flight::start();


?>
