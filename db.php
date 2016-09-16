<?php
 
function db_connect(){
	$dsn = 'mysql:host=mysql602.db.sakura.ne.jp;dbname=so-world_login;charset=utf8';
	$user = 'so-world';
	$password = 'drchika3232';
	
	try{
		$dbh = new PDO($dsn, $user, $password);
		return $dbh;
	}catch (PDOException $e){
	    	exit('データベース接続失敗。'.$e->getMessage());
	}
}
 
?>