<?php
require_once dirname(__FILE__)."/../config.php";

class BaseDao{
  protected $conn;
  public function __construct(){
  try {
    $this->conn = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
}

public function insert(){

}
public function update(){

}

public function query($query, $parameters){
  $stmt = $this->conn->prepare($query);
  $stmt->execute($parameters);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);


}
public function query_unique($query,$parameters){
$results=$this->query($query,$parameters);
return reset($results);
}
}
 ?>
