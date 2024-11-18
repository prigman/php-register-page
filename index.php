<?php 
	include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
		<h1>Welcome to the login page!</h1>
		username:<br>
		<input type="text" name="username"><br>
		password:<br>
		<input type="password" name="password"><br>
		<input type="submit" name="submit" value="register"><br>
	</form>
</body>
</html>

<?php 

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
		if(empty($username))
		{
			echo"Please set your username!";
		}
		elseif(empty($password))
		{
			echo"Please set yout password!";
		}
		else
		{
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
			
			try{
				mysqli_query($conn, $sql);
				echo"You are now registered!";
			}
			catch(mysqli_sql_exception){
				echo"The username is taken!";
			}
		}
	}

	mysqli_close($conn);
?>