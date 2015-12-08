<?php
class DBFactory
{
  
  public static function getMysqlConnexionAvecMySQLi()
  {
    return new MySQLi('localhost', 'root', '', 'podcast');
  }
}