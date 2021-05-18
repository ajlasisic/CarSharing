<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class RentalDetailsDao extends BaseDao {

  public function __construct(){
    parent::__construct("rentalDetails");
  }
  public function get_rentaldetails($accountID, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);
    
    $parameters = [];
    $query = "SELECT rd.*, a.username AS username, v.licensePlate AS plateNumber
              FROM rentaldetails rd JOIN
                   accounts a ON a.id = rd.accountID JOIN
                   vehicles v ON v.id = rd.vehicleID
              WHERE 1 = 1 ";

    if ($accountID){
      $parameters["accountID"] = $accountID;
      $query .= "AND rd.accountID = :accountID ";
    }

    if (isset($search)){
      $query .= "AND ( LOWER(a.username) LIKE CONCAT('%', :search, '%') OR
                       LOWER(v.licensePlate) LIKE CONCAT('%', :search, '%'))";
      $parameters['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $parameters);
  }
}

?>
