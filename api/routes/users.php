<?php
/**
* @OA\Post(path="/register", tags={"login"},
 *   @OA\RequestBody(description="Basic users info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="test",	description="Username for the account" ),
 *    				 @OA\Property(property="password", type="string", example="password",	description="Account password" ),
 *             @OA\Property(property="email", type="string", example="email@gmail.com",	description="User email" ),
 *             @OA\Property(property="full_name", type="string", example="Name Surname",	description="User's full name"),
 *             @OA\Property(property="DOB", type="date", example="2000-01-01",	description="Date of birth"),
 *             @OA\Property(property="phone_number", type="int", example="123456",	description="phoneNumber")
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="User that has been added into database with ID assigned.")
 * )
 */
Flight::route('POST /register', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message"=>"A confirmation email has been sent. Please confirm your account."]);
});
/**
 * @OA\Get(path="/confirm/{token}", tags={"login"},
 *     @OA\Parameter(type="string", in="path", name="token", description="Temporary token for activating account"),
 *     @OA\Response(response="200", description="Message upon successfull activation.")
 * )
 */
Flight::route('GET /confirm/@token', function($token){
  Flight::json(Flight::jwt(Flight::userService()->confirm($token)));
});
/**
 * @OA\Post(path="/login", tags={"login"},
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
Flight::route('POST /login', function(){
  Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
});
/**
 *   @OA\Post(path="/forgot", tags={"login"}, description="Send recovery link to user's email",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="email", required="true", type="string", example="your-email",	description="User's email")
 *       )
 *      )
 *     ),
 *  @OA\Response(response="200", description="Message that recovery link has been sent.")
 * )
 */
Flight::route('POST /forgot', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->forgot($data));
  Flight::json(["message" => "Recovery link has been sent to your email"]);
});
/**
 * @OA\Post(path="/reset", tags={"login"}, description="Reset users password using recovery token",
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="token", required="true", type="string", example="123",	description="Recovery token" ),
 *    				 @OA\Property(property="password", required="true", type="string", example="123",	description="New password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has changed password.")
 * )
 */
Flight::route('POST /reset', function(){
  Flight::json(Flight::jwt(Flight::userService()->reset(Flight::request()->data->getData())));
  Flight::json(["message" => "Your password has been changed"]);
});
?>
