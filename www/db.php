<?php
	function dbconn($query){
		try{ // connect to mysql

		$db = new mysqli('127.0.0.1','2bn','106r2bn!!','ybg');

		//$db = new mysqli('yebi.com','2bn','106r2bn!!','ybg'); // host , user , password , db 

		if(mysqli_connect_errno()) // check server connect
			throw new Exception("Can not connect to db server", 1); 
		
		else
				return $db->query($query);

		} catch(exception $e) { 
		echo "Exception ". $e->getCode(). ": ". $e->getMessage()."<br />". " in ". $e->getFile(). " on line ". $e->getLine(). "<br />"; 
		}
	}

	function dbconnc($query_column,$check){
			$query = "select ".$query_column." from success where ".$query_column."='".$check."' order by 조";
		$result = dbconn($query);
		return $result->num_rows;
	}

	function dbconnc2($query_column,$check){
			$query = "select 조 from success where ".$query_column."='".$check."' order by 조";
		$result = dbconn($query);

		return $result;

	}

	function dbconnc3($query_column){
			$query = "select 조 from success where ".$query_column." order by 조";
		$result = dbconn($query);

		return $result;

	}

	function dbcolumn($index){
			
		$result = dbconn($query);
		return mysql_fieldname($result,$index);
	}
?>
