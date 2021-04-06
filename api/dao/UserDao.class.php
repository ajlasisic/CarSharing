<?php

require_once dirname(__FILE__)."/BaseDao.class.php";
class UserDao extends BaseDao {

public function get_user_by_email($email)  {
      return $this->query_unique("SELECT * FROM users WHERE email=:email", ["email" => $email]);
}

public function get_user_by_id($id)  {
      return $this->query_unique("SELECT * FROM users WHERE id=:id", ["id" => $id]);
}

public function add_user($user) {
  $sql = "INSERT INTO users (fullName, DOB, email, phoneNumber) VALUES (:fullName, :DOB, :email, :phoneNumber)";
  $stmt= $this->conn->prepare($sql);
  $stmt->execute($user);
  $user['id']= $this->conn->lastInsertId();
  return $user;
}

public function update_user($id, $user) {
  $sql = "UPDATE users SET fullName= :fullName, DOB= :DOB, email= :email, phoneNumber= :phoneNumber WHERE id= :id";
  $stmt= $this->conn->prepare($sql);
  $user['id']=$id;
  $stmt->execute($user);
}


}

?>
