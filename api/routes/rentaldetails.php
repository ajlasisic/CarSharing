<?php
/**
 *@OA\Get(path="/user/rentaldetails", tags={"x-user","rentaldetails"},security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for vehicles. Case insensitive search."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by column_name or +column_name descending order by column_name"),
 *     @OA\Response(response="200", description="List vehicles from database")
 * )
 */
Flight::route('GET /user/rentaldetails', function(){

  $accountID = Flight::get('user')['aid'];
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');

  Flight::json(Flight::rentalDetailsService()->get_rentaldetails($accountID,$offset, $limit, $search, $order));
});


 ?>
