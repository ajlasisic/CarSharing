<?php
/**
* @OA\Post(path="/users/register", tags={"users"},
 *   @OA\RequestBody(description="Basic users info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="test",	description="Username for the account" ),
 *    				 @OA\Property(property="password", type="string", example="password",	description="Account password" ),
 *             @OA\Property(property="email", type="string", example="email@gmail.com",	description="User email" ),
 *             @OA\Property(property="fullName", type="string", example="Name Surname",	description="User's full name"),
 *             @OA\Property(property="DOB", type="date", example="2000-01-01",	description="Date of birth"),
 *             @OA\Property(property="phoneNumber", type="int", example="123456",	description="phoneNumber")
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="User that has been added into database with ID assigned.")
 * )
 */
Flight::route('POST /users/register', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message"=>"A confirmation email has been sent. Please confirm your account."]);
});
Flight::route('GET /users/confirm/@token', function($token){
  Flight::userService()->confirm($token);
  Flight::json(["message"=>"Your account is activated."]);
});
/**
 * @OA\Post(path="/users/login", tags={"users"},
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="email", required="true", type="string", example="your-email",	description="User's email" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has been created.")
 * )
 */
Flight::route('POST /users/login', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->login($data));
});

?>
