<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class VehicleDao extends BaseDao{

  public function add_vehicle($vehicle){
   return $this->insert("accounts", $vehicle);
  }
  public function update_vehicle($id, $vehicle) {
    $this->update("accounts", $id, $vehicle);
  }
  public function get_vehicle_by_id($id)  {
        return $this->query_unique("SELECT * FROM vehicles WHERE id=:id", ["id" => $id]);
}
 //public function get_all_vehicles(){
  // return $this->query("SELECT * FROM vehicles",[]);

  public function get_all_available_vehicles(){
    return $this->query("SELECT * FROM vehicles WHERE availability=:availability", ["availability" => 1]);
}

}

?>
