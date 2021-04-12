<?php
require_once dirname(__FILE__)."/../BaseService.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";

class AccountService{
private $dao;

public function __construct(){
  $this->dao =new AccountDao();
}

public function get_accounts($search,$offset,$limit){
   if($search){
     return $this->dao->get_accounts($search,$offset,$limit);
   }
   else {
     return $this->dao->get_all($offset,$limit);
   }
  }
   public function add($account){
         if(!isset($account['name'])) throw new Exception("Username missing");
         return parent::add($account);

   }
}

?>