<?php
	require_once("display_all.php");
	session_start();

	$id = $_POST['id'];
	$password = $_POST['password'];
	if($_POST['logout']=="log out")
		unset($_SESSION['valid_user']);
	function login($id,$pw){
		$query = "select * from user where id='".$id."'&& password=sha1(\"".$pw."\")";
		$result = dbconn($query);
		if(!$result->num_rows)
			throw new Exception("Sorry, You could not logged in!");
		$result->close();
		return true;
	}
	display_header('admin',0);
	try{
		if(empty($_SESSION['valid_user'])&&!empty($id)&&login($id,$password))
			$_SESSION['valid_user']=$id;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	if(empty($_SESSION['valid_user'])){
?>
	
	<form action="" method="post">
		<label for="id">id</label>
		<input name='id' type='text'>
		<label for='password'>password</label>
		<input name='password' type='password'>
		<input type='submit' value="log in">
	</form>
<?php } else { 
	$levy = $_POST['levy'];

	if(is_numeric($levy)){
		$query = "do add_levy(".$levy.")";
		dbconn($query);
	} else if(empty($levy)) {
	} else{
		echo "input was not number";
	}
	echo $_FILES['userfile']['type'];
	
	
?>
	<form action="" method="post">
		<input type='submit' name="logout" value="log out"><br>
		<labe for='levy'>add levy!</label>
		<input type='text' name="levy"><br>
		<input type='submit'><br>
	</form>
	<form enctype="multipart/form-data" action="upload.php" method=post>
		<input type='hidden' name='MAX_SIZE' value='10000000'> 
		<input type='file' name='file'>
		<input type='submit' value='send file'>
	</form>
	
<?php } ?>
