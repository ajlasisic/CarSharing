<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
require_once dirname ("__FILE__")."/dao/AccountDao.class.php";
require_once dirname ("__FILE__")."/dao/VehicleDao.class.php";
$dao=new AccountDao();
//$dao->update(1,["password"=>"987654321"]);

$user=$dao->get_by_id(1);
print_r($user);

/*$accounts=[
  "username"=>"amina11",
  "password"=>"sifra",
  "userID"=>"18"
];
$dao->add($accounts);
print_r($accounts);

$dao= new VehicleDao();

$vehicles=$dao->get_all_available_vehicles();
print_r($vehicles);*/
 ?>
