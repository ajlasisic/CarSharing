<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class VehicleDao extends BaseDao {

  public function __construct(){
    parent::__construct("vehicles");
  }

  public function get_vehicles($id, $offset, $limit, $search){
   $params = ["id" => $id];
   $query = "SELECT *
             FROM vehicles
             WHERE id = :id ";
       if (isset($search)){
            $query .= "AND ( LOWER(car_brand) LIKE CONCAT('%', :search, '%') OR LOWER(car_model) LIKE CONCAT('%', :search, '%'))";
            $params['search'] = strtolower($search);
   }

   $query .="LIMIT ${limit} OFFSET ${offset}";
   return $this->query($query, $params);
  }
  
  public function get_all_available_vehicles(){
    return $this->query("SELECT * FROM vehicles WHERE availability=:availability", ["availability" => 1]);
}
}

?>
