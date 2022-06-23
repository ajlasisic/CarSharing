<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountDao extends BaseDao{

  public function __construct(){
    parent::__construct("accounts");
  }
  public function get_accounts($search, $offset, $limit, $order="-id"){
  list($order_column, $order_direction) = self::parse_order($order);
     return $this->query("SELECT *
                         FROM accounts
                         WHERE LOWER(username) LIKE CONCAT('%',:username,'%')
                         ORDER BY ${order_column} ${order_direction}
                         LIMIT ${limit} OFFSET ${offset}",
                         ["username"=>$search]);

}
}
?>
