<?php
/**
 *@OA\Get(path="/user/vehicles", tags={"x-user","vehicle"},security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for vehicles. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List vehicles from database")
 * )
 */
Flight::route('GET /user/vehicles', function(){

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::vehicleService()->get_vehicles($offset, $limit, $search, $order));
});
/**
 *@OA\Get(path="/user/available_vehicles", tags={"x-user","vehicle"},security={{"ApiKeyAuth": {}}},
 *     @OA\Response(response="200", description="List all available vehicles from database")
 * )
 */
Flight::route('GET /user/available_vehicles', function(){
    Flight::json(Flight::vehicleService()->get_all_available_vehicles());
});
/**
* @OA\Post(path="/admin/vehicles", tags={"x-admin","vehicle"},security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="car_brand", required="true", type="string", example="brand",	description="Brand of the car"),
 *    				 @OA\Property(property="car_model", type="string", example="model",	description="Car model"),
 *	           @OA\Property(property="availability", required="true", type="tinyint", example="1",	description="Current availability of the car"),
 *	           @OA\Property(property="license_plate", required="true", type="string", example="137A25M",	description="License plate number"),
 *	           @OA\Property(property="price_per_hour", required="true", type="double", example="3.55",	description="Price per hour")
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Vehicle that has been added into database with ID assigned.")
 * )
 */
Flight::route('POST /admin/vehicles', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::vehicleService()->add($data));
});
/**
 * @OA\Put(path="/admin/vehicles/{id}", tags={"x-admin","vehicle"},security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *           @OA\Property(property="car_brand", type="string", example="brand",	description="Brand of the car"),
 *    				 @OA\Property(property="car_model", type="string", example="model",	description="Car model"),
 *	           @OA\Property(property="availability",type="tinyint", example="1",	description="Current availability of the car"),
 *	           @OA\Property(property="license_plate", type="string", example="137A25M",	description="License plate number"),
 *	           @OA\Property(property="price_per_hour",type="double", example="3.55",	description="Price per hour")
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update vehicles based on id. Individual columns can be updated.")
 * )
 */
Flight::route('PUT /admin/vehicles/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::vehicleService()->update($id, $data));
});
/**
 * @OA\Get(path="/admin/vehicles/{id}", tags={"x-admin","vehicle"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of vehicle"),
 *     @OA\Response(response="200", description="Fetch individual vehicle")
 * )
 */

Flight::route('GET /admin/vehicles/@id', function($id){
    Flight::json(Flight::vehicleService()->get_by_id($id));
});

/**
 *@OA\Get(path="/user/distribution", tags={"x-user","vehicle"},security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for vehicles. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List vehicles from database")
 * )
 */
  Flight::route('GET /user/distribution', function(){

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');


  Flight::json(Flight::vehicleService()->get_distribution($offset, $limit, $search, $order));
});
 ?>
