<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class VehicleDao extends BaseDao {

  public function __construct(){
    parent::__construct("vehicles");
  }
  public function get_vehicles($offset, $limit, $search, $order){
      list($order_column, $order_direction) = self::parse_order($order);
      return $this->query("SELECT *
                          FROM vehicles
                          WHERE LOWER(car_brand) LIKE CONCAT('%',:car_brand,'%')
                          ORDER BY ${order_column} ${order_direction}
                          LIMIT ${limit} OFFSET ${offset}",
                          ["car_brand"=>strtolower($search)]);
}
/*
   $query = "SELECT *
             FROM vehicles";
      if(isset($search)){
            $query .= "WHERE LOWER(car_brand) LIKE CONCAT('%', :search, '%') ";

            $parameters['search'] = strtolower($search);
   }
   $query .="ORDER BY ${order_column} ${order_direction} ";
   $query .="LIMIT ${limit} OFFSET ${offset}";
   return $this->query($query, $parameters);
 }*/

  public function get_all_available_vehicles(){
    return $this->query("SELECT * FROM vehicles WHERE availability=:availability", ["availability" => 1]);
}
}

?>
