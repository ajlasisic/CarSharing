<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
$user_dao= new UserDao();
$user =[
  "fullName"=>"Ajla Sisic",
  "DOB"=>"2000-07-19",
  "email"=>"ajlasisic@gmail.com",
  "phoneNumber"=>"061123456",
];

$user_dao->add_user($user);
print_r($user);

require_once dirname ("__FILE__")."/dao/UserDao.class.php";

$user_dao= new UserDao();
$user=$user_dao->get_user_by_email("ajla@gmail.com");
print_r($user);

 ?>
