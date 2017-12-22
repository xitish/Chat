<!DOCTYPE html>
<html>
<head>
  <title> Chat Room </title>
  <link rel="stylesheet" type="text/css" href="Assets/style.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
  <script type="text/javascript">
   var auto_refresh = setInterval
   (
		  function ()
		  {
			 $('#refresh').load('message.php').fadeIn("slow");
		  }, 5000
	); // refresh every 10000 milliseconds
</script>

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
?>
		<div id="refresh"><?php require_once("message.php");?> </div>
		<form action="chat.php" method="POST">
		<?php if(isset($_POST['send']) && empty($_POST['message'])) : ?>
			<span  style="position:relative; top:20px; right:110px; font-size:13px; color:red;" > Message Empty </span>
		<?php endif; ?>
		  <input type="text" name="message" placeholder = "Your Message"/>
		  <input type="submit" name="send" value="Send"/>
		</form>
  
</body>
</html>