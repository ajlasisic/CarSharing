<?php

require dirname(__FILE__).'/../vendor/autoload.php';
require dirname(__FILE__).'/dao/AccountDao.class.php';

Flight::map('query',function($name, $default_value=NULL){
$request= Flight::request();
$query_parameter= @$request->query->getData()[$name];
$query_parameter= $query_parameter ? $query_parameter : $default_value;
return $query_parameter;
});
/*register dao layer*/
Flight::register('accountDao', 'AccountDao');

/*include all routes*/
require_once dirname(__FILE__)."/routes/accounts.php";

Flight::start();

?>
