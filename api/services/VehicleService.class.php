<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/VehicleDao.class.php";


class VehicleService extends BaseService {


public function __construct(){
  $this->dao =new VehicleDao();
}

public function get_vehicles($id, $offset, $limit, $search){
    return $this->dao->get_vehicles($id, $offset, $limit, $search);
  }

public function get_all_available_vehicles(){
     return $this->dao->get_all_available_vehicles();
   }
public function add($vehicle){
         if(!isset($vehicle['licensePlate'])) throw new Exception("LicensePlate field is missing");
         return parent::add($vehicle);
   }
}
?>