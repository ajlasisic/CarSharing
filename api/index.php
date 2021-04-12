<?php

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/dao/AccountDao.class.php';
require_once dirname(__FILE__).'/services/AccountService.class.php';

Flight::map('query',function($name, $default_value=NULL){
$request= Flight::request();
$query_parameter= @$request->query->getData()[$name];
$query_parameter= $query_parameter ? $query_parameter : $default_value;
return $query_parameter;
});
/*register dao layer*/
Flight::register('accountDao', 'AccountDao');

/*register Business Logic Layer services */
Flight::register('accountService', 'AccountService');

/*include all routes*/
require_once dirname(__FILE__)."/routes/accounts.php";

Flight::start();

?>
