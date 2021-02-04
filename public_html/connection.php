<?php

	class Db
	{
		private static $instance=NULL;
		
		private function __construct(){}

		private function __clone(){}
		
		public static function getConnect(){
			if (!isset(self::$instance)) {
				
self::$instance= new PDO('mysql:host=localhost;dbname=atmeccom_db2;charset=UTF8','root',''); //CLAVE  DEBE SER MODIFICADA //, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
//self::$instance= new PDO('mysql:host=localhost;dbname=mydb;','root','', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));                                
			}
			return self::$instance;
		}
	}
?>