<?php

Flight::route('GET /vehicles', function(){
  $id = Flight::query('id');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');

  Flight::json(Flight::vehicleService()->get_vehicles($id, $offset, $limit, $search));
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
