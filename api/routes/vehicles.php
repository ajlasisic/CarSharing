<?php

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
