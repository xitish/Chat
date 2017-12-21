<!DOCTYPE html>
<html>
<head>
  <title> Chat Room </title>
  <link rel="stylesheet" type="text/css" href="Assets/style.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
	<?php
		session_start();
		echo '<h2>User : '.$_SESSION['user'].'</h2>';
	?>
	You Are Now Logged In !<br/><br/>
    <a  class="homelinks" href="logout.php" > Logout </a>&nbsp &nbsp &nbsp
	<a class="homelinks" href="index.php">Home</a><br/>
	<hr style="max-width:500px;"/>
	<?php
			error_reporting(2);
			$uname="";
			$message="";
			$msg='';
			 require_once('../mysqli_connect.php');
				if(!(isset($_SESSION['user_id'])))
				{
					header("Location: login.php");
				}
				else{($uname= $_SESSION['user']);}
				if(isset($_POST['send']))
				{
					 if(empty($_POST['message'])) { $msg = 'Message Empty';} // When Message is sent
						else  
						{ 
							$message = trim($_POST['message']); 
							  $query = "INSERT INTO message (uname,message) VALUES (?,?)";
							  $stmt = mysqli_prepare($dbc, $query);
							  mysqli_stmt_bind_param($stmt, "ss",$uname, $message);
							  mysqli_stmt_execute($stmt);
							  $affected_rows = mysqli_stmt_affected_rows($stmt);
							  if($affected_rows == 1)
							{
									mysqli_stmt_close($stmt);
									mysqli_close($dbc);
							} 
							   else
								{
								  echo 'Error Occurred<br />';
								  echo mysqli_error($dbc);
								  mysqli_stmt_close($stmt);
								  mysqli_close($dbc);
								}
						}
				}
				 require('../mysqli_connect.php');
				$query = "SELECT * FROM (SELECT * FROM message ORDER BY id DESC LIMIT 10) sub ORDER BY id ASC"; // For Retriving and displaying messages
				$response = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($response) )
				{
					echo '<center><div style="background-color:#EEE2F5; margin-top:10px; padding:5px; max-width:300px; border-radius:10px; text-align:left;">';
					echo '<span style="background-color:#C586EA; padding:5px;  border-radius:10px; display:inline-block;">'.$row['uname'] .'</span>&nbsp &nbsp'.$row['message'] .'<br/><br/>';
					echo '</div></center>';
				}
	?>
		<form action="chat.php" method="POST">
		<?php if(isset($_POST['send']) && empty($_POST['message'])) : ?>
			<span  style="position:relative; top:20px; right:110px; font-size:13px; color:red;" > Message Empty </span>
		<?php endif; ?>
		  <input type="text" name="message" placeholder = "Your Message"/>
		  <input type="submit" name="send" value="Send" />
		</form>
  
</body>
</html>