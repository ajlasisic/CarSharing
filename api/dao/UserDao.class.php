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
     return $this->insert("users", $user);
}

public function update_user($id, $user) {
  $this->update("users", $id, $user);
}
public function update_user_by_phoneNumber($phoneNumber, $user) {
  $this->update("users", $phoneNumber, $user, "phoneNumber");
}
}
?>
