<?php
session_start();
$uname="";
$message="";
if (isset($_SESSION['user_id']))
{
	require_once('../mysqli_connect.php');

	$query = "SELECT id, uname, password FROM users";

	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response))
		{
			if($row['id']==$_SESSION['user_id'] )
			{
				$uname = $row['uname'];
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title> Welcome to Chat</title>
  <link rel="stylesheet" type="text/css" href="Assets/style.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body style="text-align:center;">
  <h2> Welcome to Rapid Chat </h2>
  <?php if(isset($_SESSION['user_id'])): ?>
	<?php echo 'User : '.$uname.'.'; ?>
    <br/><br/>You Are Now Logged In !<br/><br/>
    <a  class="homelinks" href="logout.php" > Logout </a> &nbsp &nbsp &nbsp
	<a class="homelinks" href="chat.php">Chat</a><br/><br/><br/>
  <?php else: ?>
    <h3> Please Log In or Register </h3>
    <a class="homelinks" href="login.php">Login</a> OR
    <a class="homelinks" href="register.php">Register</a><br/><br/><br/>
  <?php endif; ?>
  <img src="chat.jpg" style="max-width:80%"/>
  <p> Developed by : <b> Pukar Ghimire </b></p>
</body>
</html>
