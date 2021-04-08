<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
$user_dao= new UserDao();
$user =[
  "fullName"=>"Ajla",
  "email"=>"ajla123@gmail.com",
  "phoneNumber"=>"414124",
  "DOB"=>"1987-09-23",
];

$user_dao->add_user($user);
print_r($user);

/*require_once dirname ("__FILE__")."/dao/UserDao.class.php";

$user_dao= new UserDao();
$user=$user_dao->get_user_by_id(14);
print_r($user);
*/
 ?>
