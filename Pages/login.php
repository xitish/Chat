<?php
session_start();
if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}

require('../mysqli_connect.php');
$query = "SELECT id, uname, password FROM users";
$response = @mysqli_query($dbc, $query);
$message='';
	if(!empty($_POST['uname']) && !empty($_POST['uname']))
	{
			if($response){
				while($row = mysqli_fetch_array($response))
				{
				if($row['uname'] == $_POST['uname'] AND $_POST['password']==$row['password'])
				{
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['user'] = $_POST['uname'];
					header("Location: chat.php");
					}
				}
				$message = 'Email OR Password Do not Match. Try Again';
			}
	}
	if(isset($_POST['submit'])){echo 'Fill in all the fields';}
mysqli_close($dbc);
?>


<html>
<head>
  <title> Login </title>
  <link rel="stylesheet" type="text/css" href="Assets/style.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
  <div class="header">
    <a href="index.php"> Home </a>
  </div>
<h1>Please Log in Below</h1>
<span> or <a href="register.php"> Register </a></span>
<form action="login.php" method="POST">
  <input type="text" name="uname" placeholder = "User Name"/>
  <input type="password" name="password" placeholder = "Password"/>
  <input type="submit" name="submit" value="Log In" />
</form>
<?php echo $message; ?>
</body>
</html>
