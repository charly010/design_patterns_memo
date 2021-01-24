<?php

require_once("DB.php");
 
class DatabaseConnection
{
  public static function get()
  {
    static $db = null;
    if ( $db == null )
      $db = new DatabaseConnection();
    return $db;
  }
 
  private $_handle = null;
 
  private function __construct()
  {
    $dsn = 'mysql://root:password@localhost/photos';
    $this->_handle =& DB::Connect( $dsn, array() );
  }
   
  public function handle()
  {
    return $this->_handle;
  }
}
 
print( "Handle = ".DatabaseConnection::get()->handle()."\n" );
print( "Handle = ".DatabaseConnection::get()->handle()."\n" );

/*
Source : https://www.ibm.com/developerworks/library/os-php-designptrns/

Le pattern est utilisé pour des questions de sécurité plus que pour de la performance
Une session, un tableau de configuration, un cookie, ont intérêt à être passé en singleton

*/