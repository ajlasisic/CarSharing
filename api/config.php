<?php

class Config {

 const DATE_FORMAT = "Y-m-d H:i:s";

 public static function DB_HOST(){
    return Config::get_env("DB_HOST", "localhost");
  }
  public static function DB_USERNAME(){
    return Config::get_env("DB_USERNAME", "root");
  }
  public static function DB_PASSWORD(){
    return Config::get_env("DB_PASSWORD", "root123");
  }
  public static function DB_SCHEME(){
    return Config::get_env("DB_SCHEME", "freedb_carsharing");
  }
  public static function DB_PORT(){
    return Config::get_env("DB_PORT", "3306");
  }
  public static function SMTP_HOST(){
    return Config::get_env("SMTP_HOST", "in-v3.mailjet.com");
  }
  public static function SMTP_PORT(){
    return Config::get_env("SMTP_PORT", "587");
  }
  public static function SMTP_USERNAME(){
    return Config::get_env("SMTP_USERNAME", "a74739ce25663fc6944757d5976072a1");
    // 6ffe046d45b7455a5a711cfeb941fee3
  }
  public static function SMTP_PASSWORD(){
    return Config::get_env("SMTP_PASSWORD", "db8fadd39e7b310c785947e47a1d114b");
    // 5a7e059bb22a963e540f05b865806b76
  }

 //const SMTP_PASSWORD ="novasifra";

 const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
 const JWT_TOKEN_TIME = 604800;

 public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }

}
 ?>
