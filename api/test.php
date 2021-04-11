<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
require_once dirname ("__FILE__")."/dao/AccountDao.class.php";
require_once dirname ("__FILE__")."/dao/VehicleDao.class.php";
require_once dirname ("__FILE__")."/dao/LocationDao.class.php";

$dao=new LocationDao();
$location=[
  "locationName"=>"Otoka",
  "locationAddress"=>"Gradacacka 32"
];
$dao->add($location);
print_r($location);

 ?>
