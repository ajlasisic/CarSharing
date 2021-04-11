<?php

require dirname(__FILE__).'/../vendor/autoload.php';
require dirname(__FILE__).'/dao/AccountDao.class.php';

Flight::register('accountDao', 'AccountDao');

Flight::route('GET /accounts', function(){
  Flight::json(Flight::accountDao()->get_all(0,10));
});
Flight::route('GET /accounts/@id', function($id){
    Flight::json(Flight::accountDao()->get_by_id($id));
});
Flight::route('POST /accounts', function(){
/* $request=Flight::request();
  $data=$request->data->getData();
  print_r($request);
  print_r($data);*/
  $request = Flight::request();
  $data = $request->data->getData();
  $request = Flight::request()->data->getData();
  Flight::json(Flight::accountDao()->add($data));
});
Flight::route('PUT /accounts/@id', function($id){
  $request = Flight::request();
$data = $request->data->getData();
Flight::accountDao()->update($id, $data);
$account = Flight::accountDao()->get_by_id($id);
Flight::json($account);
});
Flight::route('/hello6', function(){
    echo 'hello world6!';
});

Flight::start();

?>
