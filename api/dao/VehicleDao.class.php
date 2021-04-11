<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class VehicleDao extends BaseDao {

  public function __construct(){
    parent::__construct("vehicles");
  }
  
  public function get_all_available_vehicles(){
    return $this->query("SELECT * FROM vehicles WHERE availability=:availability", ["availability" => 1]);
}
}

?>
