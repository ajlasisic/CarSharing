<?php
/* Swagger documentation */
/**
 * @OA\Info(title="Autoresponder API", version="0.1")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/carsharing/api/", description="Development Environment" ),
 *    @OA\Server(url="https://carsharing.biznet.ba/api/", description="Production Environment" )
 * ),
 *    @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication" )
 */
/**
 *@OA\Get(path="/accounts", tags={"account"},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */

Flight::route('GET /accounts', function(){
 $offset=Flight::query('offset',0);
 $limit=Flight::query('limit',10);
 $search=Flight::query('search');
 $order=Flight::query('order',"-id");

 Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));
});
/**
 * @OA\Get(path="/accounts/{id}", tags={"account"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */

Flight::route('GET /accounts/@id', function($id){
  $headers = getallheaders();
  $token = @$headers['Authentication'];
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token, "JWT SECRET", ["HS256"]);
    if ($decoded['aid'] == $id){
      Flight::json(Flight::accountService()->get_by_id($id));
    }else{
      Flight::json(["message" => "Wrong account."], 403);
    }
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
  }
});

/**
* @OA\Post(path="/accounts", tags={"account"},
 *   @OA\RequestBody(description="Basic account info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="test",	description="Username for the account" ),
 *    				 @OA\Property(property="password", type="string", example="password",	description="Account password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
 * )
 */
Flight::route('POST /accounts', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->add($data));
});

/**
 * @OA\Put(path="/accounts/{id}", tags={"account"},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic account info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="test",	description="Name of the account" ),
 *    				 @OA\Property(property="password", type="string", example="password",	description="Account status" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update accounts based on id. Individual columns can be updated.")
 * )
 */
Flight::route('PUT /accounts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::accountService()->update($id, $data));
});

 ?>
