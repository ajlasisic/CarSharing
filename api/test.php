<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname ("__FILE__")."/dao/UserDao.class.php";
require_once dirname ("__FILE__")."/dao/AccountDao.class.php";
require_once dirname ("__FILE__")."/dao/VehicleDao.class.php";
require_once dirname ("__FILE__")."/dao/LocationDao.class.php";

$dao=new AccountDao();

$accounts = $dao->get_all($_GET['offset'], $_GET['limit']);
echo json_encode($accounts, JSON_PRETTY_PRINT);
 ?>
