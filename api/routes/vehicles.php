<?php

Flight::route('GET /vehicles', function(){

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::vehicleService()->get_vehicles($offset, $limit, $search, $order));
});

Flight::route('GET /available_vehicles', function(){
    Flight::json(Flight::vehicleService()->get_all_available_vehicles());
});

Flight::route('POST /vehicles', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::vehicleService()->add($data));
});

Flight::route('PUT /vehicles/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::vehicleService()->update($id, $data));
});

 ?>
