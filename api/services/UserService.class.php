<?php
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountDao.class.php";

class UserService extends BaseService{

   protected $accountDao;
  public function __construct(){
  $this->dao =new UserDao();
  $this->accountDao=new AccountDao();
}

public function register($user){
  if(!isset($user['username'])) throw new Exception("Username field is required");
  try{
    $this->dao->beginTransaction();
    $account = $this->accountDao->add([
      "username"=>$user['username'],
      "password"=>$user['password'],
      "status"=> "PENDING"
    ]);
  $user=parent::add([
    "fullName"=> $user['fullName'],
    "DOB"=> $user['DOB'],
    "email"=> $user['email'],
    "phoneNumber"=> $user['phoneNumber'],
    "address"=> $user['address'],
    "city"=> $user['city'],
    "token"=> md5(random_bytes(16)),
    "accountID"=>$account['id']
  ]);
    $this->dao->commit();
} catch (\Exception $e) {
    $this->dao->rollBack();
 throw $e;
}
return $user;
}
public function confirm($token){
$user=$this->dao->get_user_by_token($token);
if(!isset($user['id'])) throw Exception("Invalid token");
//$this->dao->update($user['id'],["status"=>"ACTIVE"]);
$this->accountDao->update($user['accountID'],["status"=>"ACTIVE"]);

// TODO: send email to customer
}
}
?>
