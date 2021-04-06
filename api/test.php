<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
$user_dao= new UserDao();
$user =[
  "fullName"=>"Ajla Sisic",
  "DOB"=>"2000-07-19",
  "email"=>"ajlasisic19@gmail.com",
  "phoneNumber"=>"6342747",
];

$user_dao->update_user(14, $user);
print_r($user);

/*require_once dirname ("__FILE__")."/dao/UserDao.class.php";

$user_dao= new UserDao();
$user=$user_dao->get_user_by_id(14);
print_r($user);
*/
 ?>
