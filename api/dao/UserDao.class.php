<?php

require_once dirname(__FILE__)."/BaseDao.class.php";
class UserDao extends BaseDao {

public function get_user_by_email($email)  {

return $this->query("SELECT * FROM users WHERE email=:email", ["email" => $email]);
}

public function add_user($user) {
  $sql = "INSERT INTO users (fullName, DOB, email, phoneNumber) VALUES (:fullName, :DOB, :email, :phoneNumber)";
  $stmt= $this->conn->prepare($sql);
  $stmt->execute($user);
}

public function update_user($id,$user) {

}


}

?>
