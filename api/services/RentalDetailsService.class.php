<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/RentalDetailsDao.class.php";


class RentalDetailsService extends BaseService {


public function __construct(){
  $this->dao =new RentalDetailsDao();
}

public function get_rentaldetails($accountID,$search,$offset,$limit,$order){
    return $this->dao->get_rentaldetails($accountID,$search,$offset,$limit,$order);
   }
}

?>
