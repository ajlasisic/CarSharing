<?php
require_once dirname(__FILE__)."/../config.php";
/*
*the main class for interaction with database

*all DAO classes inherit this class

*@author Ajla Šišić

*/
class BaseDao{
  protected $conn;

  private $table;

  public function __construct($table){
    $this->table=$table;
  try {
    $this->conn = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
}

protected function insert($table, $entity){
  $sql="INSERT INTO ${table}(";
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
protected function execute_update($table, $id, $entity, $pk_column="id"){
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

protected function query($query, $parameters){
  $stmt = $this->conn->prepare($query);
  $stmt->execute($parameters);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);


}
protected function query_unique($query,$parameters){
$results=$this->query($query,$parameters);
return reset($results);
}


public function add($entity){
return $this->insert($this->table, $entity);
}

public function update($id, $entity){
return $this->execute_update($this->table, $id, $entity);
}
public function get_by_id($id){
  return $this->query_unique("SELECT * FROM ".$this->table." WHERE id=:id",["id"=>$id]);
}
public function get_all(){
  return $this->query("SELECT * FROM".$this->table,[]);
}

}
 ?>
