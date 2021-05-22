<?php
/**
 *@OA\Get(path="/admin/locations", tags={"x-admin","location"},security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List locations from database")
 * )
 */
Flight::route('GET /admin/locations', function(){
 $offset=Flight::query('offset',0);
 $limit=Flight::query('limit',10);
 $search=Flight::query('search');
 $order=Flight::query('order',"-id");

 Flight::json(Flight::locationService()->get_locations($search, $offset, $limit, $order));
});
/**
 * @OA\Get(path="/admin/locations/{id}", tags={"x-admin","location"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual location")
 * )
 */

Flight::route('GET /admin/locations/@id', function($id){
  if (Flight::get('user')['aid'] != $id) throw new Exception("This account is not for you", 403);
    Flight::json(Flight::accountService()->get_by_id($id));
});

/**
* @OA\Post(path="/admin/locations", tags={"x-admin","location"},security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="test",	description="Name of the location"),
 *    				 @OA\Property(property="address", type="string", example="address",	description="Location address")
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Location that has been added into database with ID assigned.")
 * )
 */
Flight::route('POST /admin/accounts', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/admin/locations/{id}", tags={"x-admin","location"},security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="test",	description="Name of the location" ),
 *    				 @OA\Property(property="address", type="string", example="password",	description="Location address" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update locations based on id. Individual columns can be updated.")
 * )
 */
Flight::route('PUT /admin/accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));
});

?>
