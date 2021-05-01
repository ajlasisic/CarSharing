<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/LocationDao.class.php";


class AccountService extends BaseService {


public function __construct(){
  $this->dao =new LocationDao();
}

public function get_accounts($search,$offset,$limit,$order){
   if($search){
     return $this->dao->get_accounts($search,$offset,$limit,$order);
   }
   else {
     return $this->dao->get_all($offset,$limit, $order);
   }
  }
   public function add($account){
         if(!isset($account['username'])) throw new Exception("Username or password are missing");
         return parent::add($account);
   }
}
?>
