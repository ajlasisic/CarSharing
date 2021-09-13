<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/VehicleDao.class.php";


class VehicleService extends BaseService {

public function __construct(){
  $this->dao =new VehicleDao();
}

public function get_vehicles($offset, $limit, $search,$order){
    if($search){
        return $this->dao->get_vehicles($offset, $limit, $search,$order);
    }
    else {
      return $this->dao->get_all($offset,$limit, $order);
  }
}
public function get_all_available_vehicles(){
     return $this->dao->get_all_available_vehicles();
   }
public function add($vehicle){
        // if(!isset($vehicle['licensePlate'])) throw new Exception("License plate field is missing");
         return parent::add($vehicle);
   }
public function get_distribution($offset, $limit, $search, $order){
  return $this->dao->get_distribution($offset, $limit, $search, $order);
}
}
?>
