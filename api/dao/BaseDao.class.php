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

public function insert($table, $entity){
  $sql="INSERT INTO ${$table}(";
    foreach ($entity as $column => $value) {
      $sql.= $column.", ";
    }
  $sql=substr($sql, 0, -2);
  $sql.=") VALUES (";
    foreach ($entity as $column => $value) {
      $sql.=":".$column.", ";
    }
    $sql=substr($sql, 0, -2);
   $sql.=")";

  $stmt= $this->conn->prepare($sql);
  $stmt->execute($entity);
  $user['id']= $this->conn->lastInsertId();
  return $user;
}
public function update($table, $id, $entity, $pk_column="id"){
  $sql = "UPDATE ${table} SET ";
  foreach ($entity as $name => $value) {
    $sql .= $name ."= :". $name. ", ";
  }
  $sql = substr($sql, 0, -2);
  $sql .= " WHERE ${pk_column}= :id";

  $stmt= $this->conn->prepare($sql);
  $entity['id']=$id;
  $stmt->execute($entity);
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
